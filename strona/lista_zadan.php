<?php
session_start();
include_once("connect.php");

$id = $_SESSION['id'];
$imie = $_SESSION['imie'];
$nazwisko = $_SESSION['nazwisko'];
$email = $_SESSION['email'];
$stanowisko = $_SESSION['stanowisko'];

if ($_SESSION['stanowisko'] != "Kierownik") {
    $zapytanie = "SELECT * FROM zadania WHERE id_prac = $id";
    $wynik = $conn->query($zapytanie);
} else {
    $zapytanie = "SELECT z.id, u.imie, u.nazwisko, u.stanowisko, z.zadanie FROM zadania z INNER JOIN users u ON z.id_prac = u.id";
    $wynik = $conn->query($zapytanie);
}



?>


<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista zadań</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    
</head>

<body>

    <?php
    if ($_SESSION['stanowisko'] === "Admin") {
        echo '<header>
        <nav class="navbar navbar-dark bg-secondary navbar-expand-sm">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item"><a class="nav-link" href="dodaj.php">Dodaj pracownika</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista.php">Lista pracowników</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_zadan.php">Lista zadań</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Panel pracowników</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
        </header>';
    } elseif ($_SESSION['stanowisko'] === "Kierownik") {
        echo '<header>
        <nav class="navbar navbar-dark bg-secondary navbar-expand-sm">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" 
            aria-controls="menu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="menu">
                <ul class = "navbar-nav">
                    <li class = "nav-item"><a class = "nav-link" href="index.php">Strona główna</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="lista_kiero.php">Lista pracowników</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="dodaj_zadanie.php">Dodaj zadanie</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="lista_zadan.php">Lista zadań</a></li>
                    <li class="nav-item"><a class="nav-link" href="rezerwacja.php">Rezerwacje</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="login.php">Panel pracowników</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
    </header>';
    } else {
        echo '<header>
        <nav class="navbar navbar-dark bg-secondary navbar-expand-sm">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" 
            aria-controls="menu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="menu">
                <ul class = "navbar-nav">
                    <li class = "nav-item"><a class = "nav-link" href="index.php">Strona główna</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="lista_zadan.php">Lista zadań</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="login.php">Panel pracowników</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
    </header>';
    }




    ?>

    <br><br>
    <div class="table-responsive text-center offset-md-3 col-md-6 offset-md-3">
        <?php
        if ($_SESSION['stanowisko'] != "Kierownik") {
            if ($wynik->num_rows > 0) {
                echo '<table class="table table-bordered table-light">
            <tr>
            <td><b>Zadanie</b></td>
            <td><b>Wykonano</b></td>
            
            </tr>';
                while ($row = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['zadanie'] . "</td>";
                    echo "<td><a href=\"wykonaj_zadanie.php?id=" . $row['id'] . "\"><i class='material-icons' style='color:#0d6efd;'>done</i></a></td>";

                    echo "</tr>";
                }
                echo "</table>";
            } else {
                    echo '<div class="alert alert-dark text-center" role="alert">';
                    echo "BRAK ZADAŃ DO WYKONANIA!";
                    echo '</div>';
                
            }
        } else { 
            if ($wynik->num_rows > 0) {
                echo '<table class="table table-bordered table-light">
                <tr>
                <td><b>Imie</b></td>
                <td><b>Nazwisko</b></td>
                <td><b>Stanowisko</b></td>
                <td><b>Zadanie</b></td>
                <td><b>Edytuj</b></td>
                <td><b>Usuń</b></td>
                
                </tr>';
                while ($row = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['imie'] . "</td>";
                    echo "<td>" . $row['nazwisko'] . "</td>";
                    echo "<td>" . $row['stanowisko'] . "</td>";
                    echo "<td>" . $row['zadanie'] . "</td>";
                    echo "<td><a href=\"edytuj_zadanie.php?id=" . $row['id'] . "\"><i class='material-icons' style='color:#0d6efd;'>edit</i></a></td>";
                    echo "<td><a href=\"usun_zadanie.php?id=" . $row['id'] . "\"><i class='material-icons' style='color:#0d6efd;'>delete</i></a></td>";

                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo '<div class="alert alert-dark text-center" role="alert">';
                    echo "BRAK ZADAŃ DO WYKONANIA!";
                    echo '</div>';
            }
        }


        ?>

    </div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>