<!--
BK-Coding.net
file: hashmdp.php
author: Bastien Kilian
 -->

<?php
$title = "hashmdp";
include('parts/header.php');
?>
<div class="bodycontent">

<fieldset class="categoryajout">
    <legend>Crypter un mot de passe</legend>
    <form method="post">
        <input type="text" name="password" placeholder="Entrer votre mot de passe">
        <input type="submit" value="Crypter">
    </form>
</fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])){
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo "<script>alert('Votre mot de passe haché est : " . json_encode($hashedPassword) . "');</script>";
    }
    else {
        echo "<script>alert('Veuillez entrer un mot de passe.');</script>";
    }
}
?>

</div>
<?php include('parts/footer.php'); ?>