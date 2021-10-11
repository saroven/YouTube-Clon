<?php

class SearchResultsProvider
{
    private $conn, $userLoggedInObj;
    public function __construct($conn, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

}