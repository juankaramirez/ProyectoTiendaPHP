<?php
include_once '../admin/devadmin.php';
session_start();
session_destroy();
header('location:index.php');
?>
