<?php
include_once("connect.php");


$id = $_GET['id'];

$zapytanie = "DELETE FROM zadania WHERE id = $id";
$wynik = $conn->query($zapytanie);
header("Location: lista_zadan.php");



?>