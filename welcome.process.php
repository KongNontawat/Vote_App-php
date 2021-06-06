<?php
session_start();
require 'classes/Vote.class.php';
$votes = new Vote();

if (isset($_GET['path_img'])) {
  $path = ["path_img" => "Image/" . $_FILES['path_img']['name']];
  if (!file_exists($path['path_img'])) {
    move_uploaded_file($_FILES['path_img']['tmp_name'], $path['path_img']);
  } else {
    header('location: welcome.php?error=Error_image_exists');
    exit;
  }
  $result = $votes->upload_img($path);
  if($result) {
    $data = $votes->show_img($path);
    header("location: welcome.php?id=" . $data['id'] ."&path=" . $data['path_img']);
  } else {
    header('location: welcome.php?upload_path=failed');
  }
} 


if (isset($_POST['submit_login'])) {
  unset($_POST['submit_login']);
  $pass = $votes->login($_POST);
  if ($pass) {
    $_SESSION['login'] = true;
    $_SESSION['my_id_show'] = $_POST['id'];
    header('location: index.php');
  }
}

