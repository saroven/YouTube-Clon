<?php

class VideoProcessor
{
    private $conn;
    private $sizeLimit = 500000000;
    private $allowedTypes = array('mp4', 'flv', 'webm', 'mkv',  'vob', 'avi', 'wmv', 'mov', 'mpeg', 'mpg');
    private $ffmpegPath;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->ffmpegPath = "\"ffmpeg\\bin\\ffmpeg.exe\"";
    }

    public function upload($videoUploadData)
    {
        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        $tempFilePath = $targetDir.uniqid().basename($videoData['name']);
        $tempFilePath = str_replace(" ", "_", $tempFilePath);

        $isValidData = $this->processData($videoData, $tempFilePath);
        if (!$isValidData){
            return false;
        }
        if (move_uploaded_file($videoData["tmp_name"], $tempFilePath)){

            $finalFilePath = $targetDir. uniqid().".mp4";
            if (!$this->insertVideoData($videoUploadData, $finalFilePath)){
                echo "Insert Query failed";
                return false;
            }
            if (!$this->convertVideoToMp4($tempFilePath, $finalFilePath)){
                echo "Converting failed\n";
                return false;
            }
            if (!$this->deleteFile($tempFilePath)){
                echo "Converting failed\n";
                return false;
            }
        }
    }
    private function processData($data, $filePath)
    {
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);
        if(!$this->isValidSize($data)){
            echo "File too large! Can't be more than " . $this->sizeLimit. " bytes";
            return false;
        } else if (!$this->isValidType($videoType)){
            echo "Invalid file type!";
            return false;
        } else if($this->hasError($data)){
            echo "Error code: ". $data['error'];
            return false;
        }
        return true;
    }

    private function isValidSize($data)
    {
        return $data['size'] <= $this->sizeLimit;
    }

    private function isValidType($type)
    {
        $lowerCased = strtolower($type);
        return in_array($lowerCased, $this->allowedTypes);
    }

    private function hasError($data)
    {
        return $data["error"] != 0;
    }

    private function insertVideoData($uploadData, $filePath)
    {
        $query = $this->conn->prepare("INSERT INTO videos(title, uploadBy, description, privacy, category, filePath) VALUES (:title, :uploadBy, :description, :privacy, :category, :filePath)");
        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadBy", $uploadData->uploadBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
    }
    public function convertVideoToMp4($tempFilePath, $finalFilePath){
        $cmd = "$this->ffmpegPath";
        
        $outputLog = array();
        exec(escapeshellcmd($cmd)." -i $tempFilePath -c copy $finalFilePath 2>&1", $outputLog, $returnCode);
        if ($returnCode != 0){
            //command failed
            foreach ($outputLog as $line){
                echo $line . "<br>";
            }
            return false;
        }
        return true;
    }

    private function deleteFile($filePath)
    {
        if (!unlink($filePath)){
            echo "Could not deleted file.\n";
            return false;
        }
        return true;
    }
}
