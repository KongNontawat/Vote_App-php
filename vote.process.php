<?php
require 'classes/Vote.class.php';
$votes = new Vote();



// if (isset($_GET['id'])) {
//   header("location:index.php?userid=" . $_GET['id'] . "&username=" . $_GET['name']);
// }

if (isset($_GET['vote_submit'])) {
  unset($_GET['vote_submit']);
  $result = $votes->up_vote($_GET);
  if($result) {
    $status = $votes->my_status($_GET);
    if($status) {
      header("location:index.php?up_vote_success");
    } else {
      header("location:index.php?up_status_Failed");
    }
  } else {
    header("location:index.php?up_vote_Fail");
  }
}
