<?php

class ButtonProvider
{
    public static $signInFunction = "notSignedIn()";

    public static function createLink($link){
        return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }
    public static function createButton($text, $imgSrc, $action, $class){
        //change if needed
        $img = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";
//        $action = ButtonProvider::createLink($action);
        return "<button class='$class' onclick='$action'>
                $img
                <span class='text'>$text</span>
                </button>";
    }
    public static function createHyperLinkButton($text, $imgSrc, $href, $class){
        //change if needed
        $img = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";

        return "<a href='$href'>
                    <button class='$class'>
                    $img
                    <span class='text'>$text</span>
                    </button>
                </a>";
    }
    public static function createUserProfileButton($conn, $username){
        $userObj = new User($conn, $username);

        $profilePic = $userObj->getProfilePic();
        $link = "profile.php?username=$username";
        return "<a href='$link'>
                    <img src='$profilePic' class='profilePic'>
                </a>";
    }
    public static function createEditVideoButton($videoId){
        $href = "editVideo.php?videoId=$videoId";
        $button = ButtonProvider::createHyperLinkButton("EDIT VIDEO",null, $href, "edit button");
        return "<div class='editVideoButtonContainer'>
                    $button
                </div>";
    }

    public static function createSubscriberButton($conn, $userObj, $userLoggedInObj){
        $userTo = $userObj->getUserName();
        $userLoggedIn = $userLoggedInObj->getUserName();

        $isSubscribeTo = $userLoggedInObj->isSubscribedTo($userTo);
        $buttonText = $isSubscribeTo ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .=" ".$userObj->getSubscriberCount();
        $buttonClass = $isSubscribeTo ? "unsubscribe button" : "subscribe button";
        $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

        $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);
        return "<div class='subscriberButtonContainer'>$button</div>";

    }

}