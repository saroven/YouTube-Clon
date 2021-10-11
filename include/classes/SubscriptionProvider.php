<?php

class SubscriptionProvider
{
    private $conn, $userLoggedInObj;
    public function __construct($conn, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos()
    {
        $videos = array();
        $subscriptions = $this->userLoggedInObj->getSubscriptions();
        if (sizeof($subscriptions) > 0){

        }
        return $videos;
    }
}