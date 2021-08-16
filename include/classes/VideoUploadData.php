<?php

class VideoUploadData
{
    public $videoDataArray, $title, $description, $privacy, $category, $uploadedBy;
    public function __construct($videoDataArray, $title, $description, $privacy, $category, $uploadBy){
    $this->videoDataArray = $videoDataArray;
    $this->title = $title;
    $this->description = $description;
    $this->privacy = $privacy;
    $this->category = $category;
    $this->uploadBy = $uploadBy;
    }
}