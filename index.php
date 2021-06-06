<?php
session_start();
error_reporting(0);

require 'classes/Vote.class.php';
$votes = new Vote();


if (isset($_SESSION['my_id_show'])) {
  $result = $votes->show_my_info($_SESSION['my_id_show']);
}

$User = $votes->all_user();


if (!isset($_SESSION['login'])) {
  header('location: welcome.php');
}

?>
<?php include 'components/header.php'; ?>
<style>
  .container {
    max-width: 600px;
  }
</style>
<div class="header_top">
  <div class="mycontainer">
    <a href="welcome.php" class="logo">
      <img src="Image/logo2.png" alt="">
    </a>

    <?php if (isset($result)) : ?>
      <h5 class="text-center text-white fw-normal mt-2"><?= $result['name'] ?></h5>
    <?php endif; ?>


    <div class="profile">
      <?php if (isset($result)) : ?>
        <img src="<?= $result['path_img'] ?>" class="">
      <?php else : ?>
        <img src="Image/dummy-img.jpg" class="">
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="container d-flex flex-column align-items-center">
  <h4 class="fw-normal mt-4 ms-2 align-self-start">เริ่มโหวดกันเลย!!</h4>
  <h6 class="fw-normal mt-1 text-danger ms-2 align-self-start">คลิกเลือกคนที่ต้องการจะโหวด</h6>

  <div class="row justify-content-start mt-1 w-100" id="row">

  </div>




  <?php include 'components/footer.php'; ?>

  <script>
    function loadXMLDoc() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("row").innerHTML =
            this.responseText;
        }
      };
      xhttp.open("GET", "server.php", true);
      xhttp.send();
    }

    setInterval(function() {
      loadXMLDoc();
    }, 2000);

    window.onload = loadXMLDoc();

    function load_index() {
      window.location.href = 'index.php'
    }

    function my_alert(my_id, id) {
      Swal.fire({
        title: 'my id' + my_id,
        text: "ไอดีของคนที่คุณต้องการจะโหวด " + id,
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "vote.process.php?vote_submit&my_id=" + my_id + "&vote_id=" + id;
          } else if(result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = "index.php";
        }
      });
    }

    function my_alert_error() {
      Swal.fire({
        icon: 'error',
        title: 'Oops... ไม่สามารถโหวดซ้ำได้',
        text: 'คุณได้ทำการโหวดไปแล้ว ไม่สามารถโหวดซ้ำได้อีก'
      })
    }
  </script>