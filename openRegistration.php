<?php
session_start();
$_SESSION['status']=true;

function goBack()
{
header('Location: ' . $_SERVER['HTTP_REFERER']);	
}

goBack();
?>
