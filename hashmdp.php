<?php
$title = "hashmdp";
include('parts/header.php');
?>
<div class="bodycontent">

<?php
echo "Veuillez entrer votre mot de passe: ";
$password = readline();
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "Votre mot de passe haché est: " . $hashedPassword;
?>

</div>
<?php include('parts/footer.php'); ?>