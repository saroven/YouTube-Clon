<?php
require 'ButtonProvider.php';
class Comment
{
    private $conn, $sqlData, $userLoggedInObj, $videoId;
    public function __construct($conn, $input, $userLoggedInObj, $videoId)
    {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->videoId = $videoId;

        if (is_array($input)){
            $this->sqlData = $input;
        }else{
            $query = $this->conn->prepare("SELECT * FROM comments WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }


    }
    public function create()
    {
        $body = $this->sqlData['body'];
        $postedBy = $this->sqlData['postedBy'];
        $profileButton = ButtonProvider::createUserProfileButton($this->conn, $postedBy);
        $timespan = "";
        return "<div class='itemContainer'>
                    <div class='comment'>
                        $profileButton
                        <div class='mainContainer'>
                            <div class='commentHeader'>
                                <a href='profile.php?username=$postedBy'>
                                    <span class='username'>$postedBy</span>
                                </a>
                                <span class='timestamp'>$timespan</span>
                            </div>
                            <div class='body'>
                                $body
                            </div>
                        </div>
                    </div>
                </div>";
    }
}