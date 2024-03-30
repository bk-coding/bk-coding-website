<?php
$title = "hashmdp";
include('parts/header.php');
?>
<div class="bodycontent">

<?php
$password = "Test";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>

</div>
<?php include('parts/footer.php'); ?>