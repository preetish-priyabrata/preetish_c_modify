<?php
session_start();
// $_SESSION['MSG']="you are logged out";
session_destroy();
session_start();
require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $msg->success('Success-Fully Logged Out');
header('Location:../index.php');
exit;