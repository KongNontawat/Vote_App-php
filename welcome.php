<?php include 'components/header_welcome.php'; ?>
<?php
require 'classes/Vote.class.php';
$votes = new Vote();
if(isset($_SESSION['logout'])) {
// $votes->clear_table();
session_destroy();
header('location: welcome.php');
}
?>
<div class="container">
	<div class="brands d-flex flex-column align-items-center">
		<img class="vote_icon" src="Image/vote_icon.svg">
		<img class="logo" src="Image/logo.png">
	</div>

	<form id="form" action="welcome.process.php?path_img" method="POST" class="mt-5" enctype="multipart/form-data">
		<div class="file-upload mx-auto">
			<?php if (isset(($_GET['path']))) : ?>
				<img src="<?php echo $_GET['path']; ?>" class="img_profile" alt="">
			<?php endif; ?>
			<?php if (!isset(($_GET['id']))) : ?>
				<input type="file" id="upload_img" name="path_img">
				<i class="fas fa-camera"></i>
			<?php endif; ?>
		</div>
	</form>

	<form action="welcome.process.php" method="POST" class="" enctype="multipart/form-data">
		<div class="input_name mt-5 d-flex flex-column align-items-center">
			<?php if (isset(($_GET['id']))) : ?>
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
			<?php endif; ?>
			<input type="text" class="form-control" name="name" placeholder="กรอกชื่อของคุณ">
			<?php if (isset(($_GET['path']))) : ?>
				<input type="hidden" name="path_img" value="<?php echo $_GET['path']; ?>">
			<?php endif; ?>
			<button type="submit" name="submit_login" class="btn mt-3 text-white">เริ่มโหวด</button>
		</div>
		<p class="text-danger text-center mt-4">อัพโหลดรูปโปรไฟล์ และกรอกชื่อ เพื่อเริ่มใข้งาน</p>
	</form>
</div>

<?php unset($_SESSION['row']); ?>
<?php unset($_SESSION['login']); ?>

<?php include 'components/footer_welcome.php'; ?>