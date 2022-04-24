<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Quản lý sinh viên</title>
		<link rel="stylesheet" href="public/vendor/bootstrap-4.5.3-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="public/vendor/fontawesome-free-5.15.1-web/css/all.min.css">
		<link rel="stylesheet" href="public/css/style.css">
	</head>
	<body>
		<?php 
		global $c;
		?>
		<div class="container" style="margin-top:20px;">
			<a href="/" class="<?=$c== 'student' ?'active' : ''?> btn btn-info">Students</a>
			<a href="?c=subject" class="<?=$c == 'subject' ?'active' : ''?> btn btn-info">Subject</a>
			<a href="?c=register" class=" <?=$c == 'register' ?'active' : ''?> btn btn-info">Register</a>
			<div style="height:40px; margin-top:20px">
				<div class="error bg-danger container-fluid text-center">
				</div>
				<div class="message bg-primary container-fluid text-center">
				</div>
			</div>
			
			<?php 

$message = "";
if (!empty($_SESSION['success'])){ // phần tử có key success có không
   $message = $_SESSION['success'];
    unset($_SESSION['success']); // xóa phần tử có key là success
	$class = "alert-success";
}
else if (!empty($_SESSION['error'])){
    $message = $_SESSION['error'];
    unset($_SESSION['error']);
	$class = "alert-danger";
}
if (!empty($message)) {
?>
	<div class="alert <?=$class?>"><?=$message?> </div>
<?php 
}	 
?>
