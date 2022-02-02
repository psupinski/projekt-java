<?php
session_start();
include_once("connect.php");

if ($_SESSION['stanowisko'] === "Kierownik") {
    $id = $_GET['id'];

    $zapytanie = "DELETE FROM zadania WHERE id = '$id'";
    $wynik = $conn->query($zapytanie);
    header("Location: lista_zadan.php");
} else {
    header("Location: login.php");
}
