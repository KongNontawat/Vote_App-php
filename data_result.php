<?php
require 'classes/Vote.class.php';
$votes = new Vote();
$result = $votes->get_result();
?>
<style>
.reward img{
    position: absolute;
    bottom: -3%;
    width: 150px;
}
</style>
<div class="brands d-flex flex-column align-items-center">
  <img class="vote_icon" src="Image/vote_icon.svg">
  <img class="logo" src="Image/logo.png">
</div>

<div class="label">
  <h3 class="text-center mt-5">ผู้ที่ชนะการโหวด :</h3>
</div>

<div class="result d-flex flex-column align-items-center">
  <img src="<?= $result['path_img'] ?>" class="mt-3">
  <h5 class="mt-3"> <?= $result['name'] ?> </h5>
  <h6 class="mt-3">คะแนนที่ได้ : <?= $result['Vote_Score'] ?> </h6>
</div>

<div class="reward">
  <img src="Image/fireworks.svg" alt="">
</div>