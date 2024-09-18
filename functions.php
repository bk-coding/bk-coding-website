<!--
BK-Coding.net
file: functions.php
author: Bastien Kilian
 -->

<?php

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>