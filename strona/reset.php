<?php

session_start();
include_once("connect.php");
if($_SESSION['stanowisko'] === "Admin")
{
$id = $_GET['id'];
$zapytanie = "SELECT * FROM users WHERE id = '$id'";
$wynik = $conn->query($zapytanie);
$row = $wynik->fetch_assoc();
$new_psw = $row['login'];
$zapytanie2 = "UPDATE users SET psw = '$new_psw' WHERE id = '$id'";
$wynik2 = $conn->query($zapytanie2);

header("Location: lista.php");
}
else{
    header("Location: login.php");
}

?>