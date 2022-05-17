<?php
include "comp/config.php";
if(isset($_COOKIE['id'])){
    setcookie('id',2,54);
    header("Location: login.php");
}
?>