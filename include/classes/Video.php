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
        return $this->sqlData['uploadBy'];
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
        $date = $this->sqlData['uploadDate'];
        return date("M j, Y", strtotime($date));
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

    public function like()
    {
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUserName();
        if ($this->wasLikedBy()){
            //user is already liked
            $query = $this->conn->prepare("DELETE FROM likes WHERE username= :username AND videoId=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $id);
            $query->execute();
            $result = array(
                'likes' => -1,
                'dislikes' => 0
            );
            return json_encode($result);
        }else{
            //user not liked
            $query = $this->conn->prepare("DELETE FROM dislikes WHERE username= :username AND videoId=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $id);
            $query->execute();

            $count = $query->rowCount();

            $query = $this->conn->prepare("INSERT INTO likes(username, videoId) VALUES (:username, :videoId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $id);
            $query->execute();

            $result = array(
                'likes' => 1,
                'dislikes' => 0 - $count
            );
            return json_encode($result);
        }
    }
    public function dislike()
    {
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUserName();
        if ($this->wasDislikedBy()){
            //user is already liked
            $query = $this->conn->prepare("DELETE FROM dislikes WHERE username= :username AND videoId=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $id);
            $query->execute();
            $result = array(
                'likes' => 0,
                'dislikes' => -1
            );
            return json_encode($result);
        }else{
            //user not liked
            $query = $this->conn->prepare("DELETE FROM likes WHERE username= :username AND videoId=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $id);
            $query->execute();

            $count = $query->rowCount();

            $query = $this->conn->prepare("INSERT INTO dislikes(username, videoId) VALUES (:username, :videoId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $id);
            $query->execute();

            $result = array(
                'likes' => 0 - $count,
                'dislikes' => 1
            );
            return json_encode($result);
        }
    }
    public function wasLikedBy(){
        $username = $this->userLoggedInObj->getUserName();
        $id = $this->getId();
        $query = $this->conn->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
        $query->bindParam(":username", $username);
        $query->bindParam(":videoId", $id);
        $query->execute();
        return $query->rowCount() > 0;
    }
    public function wasDislikedBy(){
        $username = $this->userLoggedInObj->getUserName();
        $id = $this->getId();
        $query = $this->conn->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
        $query->bindParam(":username", $username);
        $query->bindParam(":videoId", $id);
        $query->execute();
        return $query->rowCount() > 0;
    }

    public function getNumberOfComment()
    {
        $videoId = $this->getId();
        $query = $this->conn->prepare("SELECT * FROM comments WHERE videoId=:videoId");
        $query->bindParam(":videoId", $videoId);
        $query->execute();

        return $query->rowCount();
    }
    public function getComments(){
        $videoId = $this->getId();
        $query = $this->conn->prepare("SELECT * FROM comments WHERE videoId=:videoId AND responseTo=0 ORDER BY datePosted DESC");
        $query->bindParam(":videoId", $videoId);
        $query->execute();
        $comments = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $comment = new Comment($this->conn,$row, $this->userLoggedInObj, $videoId);
            array_push($comments, $comment);
        }
        return $comments;
    }

}