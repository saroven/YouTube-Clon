<?php

class FormValidation
{
    public static function sanitizeFormString($input){
        $input = strip_tags($input);
        $input = str_replace(" ", "", $input);
        $input = strtolower($input);
        return ucfirst($input);
    }
    public static function sanitizeFormUsername($input){
        $input = strip_tags($input);
        $input = str_replace(" ", "", $input);
        return strtolower($input);
    }
    public static function sanitizeFormPassword($input){
        return strip_tags($input);
    }
    public static function sanitizeFormEmail($input){
        $input = strip_tags($input);
        $input = str_replace(" ", "", $input);
        return strtolower($input);
    }
}