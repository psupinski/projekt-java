<?php
session_start();
include_once("connect.php");

if($_SESSION['stanowisko'] === "Admin")
{
    $id = $_GET['id'];

    $zapytanie = "DELETE FROM users WHERE id = $id";
    $wynik = $conn->query($zapytanie);
    header("Location: lista.php");
    
}
else{
    header("Location: login.php");
}

?>