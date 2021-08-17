<?php

class VideoProcessor
{
    private $conn;
    private $sizeLimit = 500000000;
    private $allowedTypes = array('mp4', 'flv', 'webm', 'mkv',  'vob', 'avi', 'wmv', 'mov', 'mpeg', 'mpg');
    private $ffmpegPath;
    private $ffprobePath;
    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->ffmpegPath = "\"ffmpeg\\bin\\ffmpeg.exe\"";
        $this->ffprobePath = "\"ffmpeg\\bin\\ffprobe.exe\"";
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
            if (!$this->generateThumbnails($finalFilePath)){
                echo "Thumbnail generation failed\n";
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

    public function generateThumbnails($filePath)
    {
        $thumbnailSize = "210x118";
        $numbThumbnails = 3;
        $pathToThumbnails = "uploads/videos/thumbnails";
        $duration = $this->videoDuration($filePath);
        $videoId = $this->conn->LastInsertId();
        if (!$this->updateVideoDuration($duration, $videoId)){
            return false;
        }else{
            return true;
        }

    }
    private function videoDuration($filePath)
    {
        $ffprobe = escapeshellcmd($this->ffprobePath);
        return shell_exec("$ffprobe -v error -select_streams v:0 -show_entries stream=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }
    private function updateVideoDuration($duration, $videoId)
    {
        $duration = (int)$duration;
        $hour = floor($duration / 3600);
        $mins = floor($duration - ($hour * 3600) / 60);
        $secs  = floor($duration % 60);

        $hour = ($hour < 1) ? "" : $hour . "";
        $mins = ($mins < 10) ? "0".$mins.":" : $mins . ":";
        $secs = ($secs < 10) ? "0".$secs : $secs;
        $duration = $hour.$mins.$secs;
        $query  = $this->conn->prepare("UPDATE videos SET duration=:duration WHERE id=:videoId");
        $query->bindParam(":duration", $duration);
        $query->bindParam(":videoId", $videoId);
        if (!$query->execute()){
            return false;
        }else{
            return true;
        }

    }

}
