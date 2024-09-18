<?php
$title = "hashmdp";
include('parts/header.php');
?>
<div class="bodycontent">

<form method="post">
    <input type="password" name="password" placeholder="Entrer votre mot de passe :" required>
    <input type="submit" value="Hasher">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["password"])) {
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "<script>alert('Votre mot de passe haché est : " . addslashes($hashedPassword) . "');</script>";
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script>alert('Veuillez entrer un mot de passe.');</script>";
}
?>

</div>
<?php include('parts/footer.php'); ?>