<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $student_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $student_id);
    $status = $db->delete('students');
    
    if ($status) 
    {
        $_SESSION['info'] = "Student Application deleted successfully!";
        header('location: index.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete Student Application";
    	header('location: index.php');
        exit;

    }
    
}