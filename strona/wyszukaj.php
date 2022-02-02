<style>
    #tabela {
    border: 1px solid black;
    border-collapse: collapse;
    margin:auto;
 }

 #tabela td {
    border: 1px solid black;
    padding: 5px;
 }


</style>

<?php

session_start();
include_once("connect.php");

$kolumna = $_POST['kolumna'];
$wartosc = $_POST['szukaj'];

if($kolumna == "imie")
{
    $zapytanie = "SELECT * FROM users WHERE imie = '$wartosc'";
    $wynik = $conn->query($zapytanie);
    
    if ($wynik->num_rows > 0) {
        echo "<table id='tabela'>
        <tr>
        <td><b>Imię</b></td>
        <td><b>Nazwisko</b></td>
        <td><b>Adres e-mail</b></td>
        <td><b>Login</b></td>
        <td><b>Stanowisko</b></td>
        <td><b>Resetuj hasło</b></td>
        <td><b>Usuń</b></td>
        </tr>";
        while($row = $wynik->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['imie'] . "</td>";
            echo "<td>" . $row['nazwisko'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['login'] . "</td>";
            echo "<td>" . $row['stanowisko'] . "</td>";
            echo "<td><a href=\"reset.php?id=".$row['id']."\">Reset</a></td>" ;
            echo "<td><a href=\"usun.php?id=".$row['id']."\">Usuń</a></td>" ;
            echo "</tr>";
    }
        echo "</table>";
    } else {
    echo "0 wyników";
    }
}
?>
