<?php
session_start();
$_SESSION['status']=false;

function goBack()
{
header('Location: ' . $_SERVER['HTTP_REFERER']);	
}

goBack();
?>