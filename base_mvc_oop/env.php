<?php

const DBNAME = "wd20301_php2";
const DBUSER = "root";
const DBPASS = "";
const DBHOST = "localhost";
const DBCHARSET = "utf8";

const BASE_URL = "http://localhost/wd20301_php2/base_mvc_oop/";

function route($url){
    return BASE_URL.$url;
}

function flash($key, $msg, $route){
    $_SESSION[$key] = $msg;
    switch ($key){
        case 'success':
            unset($_SESSION['errors']);
            break;
        case 'errors':
            unset($_SESSION['success']);
            break;
    }
    header('location:'.BASE_URL.$route.'?msg='.$key);
    die;
}