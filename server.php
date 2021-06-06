<?php
session_start();
require 'classes/Vote.class.php';
$votes = new Vote();
$all_status = $votes->get_all_status();

if (isset($_POST['submit_login'])) {
    unset($_POST['submit_login']);
    $pass = $votes->login($_POST);
    if ($pass) {
        $_SESSION['my_id_show'] = $_POST['id'];
        unset($_POST);
        header('location:index.php');
    }
}

if (isset($_SESSION['my_id_show'])) {
    $result = $votes->show_my_info($_SESSION['my_id_show']);
    $User = $votes->all_user();
}

?>

<?php if (isset($User)): ?>
  <?php foreach ($User as $key => $value): ?>
    <div class="col-4 mt-2 d-flex justify-content-center">
      <button type="button" id="vote" class="user border border-white bg-white d-flex flex-column align-items-center" onclick="<?php

if ($result['status'] == 1) {
    echo "my_alert_error()";
} else {
    echo "my_alert(" . $result['id'] . "," . $value['id'] . ")";
}

?>">
        <img src="<?=$value['path_img']?>" class="<?php
if ($result['id'] == $value['id'] && $result['status'] == 1 || $value['status'] == 1) {
    echo "border border-4 border-success";
    if ($result['id'] == $value['id'] && $result['status'] == 1) {
        $_SESSION['check_result_btn'] = true;
        $_SESSION['result_id'] = $result['id'];
    }
}
?>">
        <h6 class="fw-normal text-center mt-1"><?=$value['name']?></h6>
      </button>
    </div>
    <?php

?>
  <?php endforeach;?>

<?php endif;?>
<?php
$row = $key + 1;
if ($row) {
    $_SESSION['row'] = $row;
}
?>

<?php if ($all_status[0]['COUNT(status)'] == $_SESSION['row']): ?>

  <div class='row justify-content-center w-100 mt-5'>
    <div class='col-10 mt-2'>
      <a href='result.php' class='btn col-12 btn-outline-success' id="load_index">ดูผลโหวด</a>
    </div>
  </div>

<?php endif;?>