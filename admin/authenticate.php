<?php 
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = filter_input(INPUT_POST, 'username');
    $passwd = filter_input(INPUT_POST, 'passwd');

    $passwd=  md5($passwd);
   	
    //Get DB instance. function is defined in config.php
    $db = getDbInstance();

    $db->where ("user_name", $username);
    $db->where ("passwd", $passwd);
    $row = $db->get('admin_accounts');
     
    if ($db->count >= 1) {
        $_SESSION['user_logged_in'] = TRUE;

       
        header('Location:index.php');
        exit;
    } else {
        $_SESSION['login_failure'] = "Invalid user name or password";
        header('Location:login.php');
        exit;
    }
  
}