<?php

spl_autoload_register(function ($filename){
    if(file_exists("./dao/".$filename.".php")){
        require_once "./dao/".$filename.".php";
    }elseif(file_exists("./model/".$filename.".php")){
        require_once "./model/".$filename.".php";
    }elseif(file_exists("./service/".$filename.".php")){
        require_once "./service/".$filename.".php";
    }elseif(file_exists("./config/".$filename.".php")){
        require_once "./config/".$filename.".php";
    }elseif(file_exists("./utils/".$filename.".php")){
        require_once "./utils/".$filename.".php";
    } 
});
    