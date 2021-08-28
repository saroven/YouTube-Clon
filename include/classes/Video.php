<?php
class Video
{
    private $conn, $sqlData, $userLoggedInObj;
    public function __construct($conn, $input, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
        if (is_array($input)){
            $this->sqlData = $input;
        }else{
            $query = $this->conn->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }


    }

    public function getId()
    {
        return $this->sqlData['id'];
    }
    public function getUploadedBy()
    {
        return $this->sqlData['uploadedBy'];
    }
    public function getTitle()
    {
        return $this->sqlData['title'];
    }
    public function getDescription()
    {
        return $this->sqlData['description'];
    }
    public function getPrivacy()
    {
        return $this->sqlData['privacy'];
    }
    public function getFilePath()
    {
        return $this->sqlData['filePath'];
    }
    public function getCategory()
    {
        return $this->sqlData['category'];
    }
    public function getUploadDate()
    {
        return $this->sqlData['uploadDate'];
    }
    public function getDuration()
    {
        return $this->sqlData['duration'];
    }
    public function getViews()
    {
        return $this->sqlData['views'];
    }
    public function incrementViews()
    {
        $videoId = $this->getId();
        $query = $this->conn->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindParam(":id", $videoId);
        $query->execute();
        $this->sqlData['views'] = $this->sqlData['views'] + 1;

    }
    public function getLikes(){
        $query = $this->conn->prepare("SELECT count(*) as 'count' FROM likes WHERE videoId = :id");
        $videoId = $this->getId();
        $query->bindParam(":id", $videoId);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['count'];
    }
    public function getDislikes(){
        $query = $this->conn->prepare("SELECT count(*) as 'count' FROM dislikes WHERE videoId = :id");
        $videoId = $this->getId();
        $query->bindParam(":id", $videoId);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['count'];
    }

}