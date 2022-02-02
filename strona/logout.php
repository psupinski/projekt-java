<?php
ob_start();
session_start();
if(isset($_SESSION['id']))
{
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['psw']);
    unset($_SESSION['stanowisko']);
    unset($_SESSION['imie']);
    unset($_SESSION['nazwisko']);
    unset($_SESSION['email']);
    header("Location: login.php");
}
else
{
    header("Location: login.php");
}
?>