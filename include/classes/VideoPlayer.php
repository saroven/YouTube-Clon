<?php

class VideoPlayer
{
    private $video;

    public function __construct($video)
    {
        $this->video = $video;
    }

    public function create($autoPlay)
    {
        if($autoPlay){
            $autoPlay =  "AutoPlay";
        }else{
            $autoPlay = "";
        }
        $filePath = $this->video->getFilePath();

        return "<video class='videoPlayer' controls $autoPlay>
                <source src='$filePath' type='video/mp4'>
                Your Browser does not support video tag
                </video>";
    }
}