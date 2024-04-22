<?php
$title = "hashmdp";
include('parts/header.php');
?>
<div class="bodycontent">

<form method="post">
<input type="password" name="password" placeholder="Entrer votre mot de passe :">
<input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "Votre mot de passe haché est: " . $hashedPassword;
}
?>

</div>
<?php include('parts/footer.php'); ?>