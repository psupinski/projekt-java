<?php


    session_start();
    include_once("connect.php");
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SESSION['stanowisko'] != "Kierownik") {
        header("Location: login.php");
    }

    $zapytanie = "SELECT w.ilosc, w.dzien, w.godzina, p.nazwa FROM wycieczki w INNER JOIN pakiety p ON w.id_pakietu = p.id";
    $wynik = $conn->query($zapytanie);



?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezerwacje</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-secondary navbar-expand-sm">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-center" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_kiero.php">Lista pracowników</a></li>
                    <li class="nav-item"><a class="nav-link" href="dodaj_zadanie.php">Dodaj zadanie</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_zadan.php">Lista zadań</a></li>
                    <li class="nav-item"><a class="nav-link" href="rezerwacja.php">Rezerwacje</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Panel pracowników</a></li>
                    <li class="nav-item"><a class="nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="table-responsive text-center offset-md-3 col-md-6 offset-md-3 mt-5">
                    <?php
                    if ($wynik->num_rows > 0) {
                    echo '<table class="table table-bordered table-light">
                    <tr>
                    <td><b>Ilość osób</b></td>
                    <td><b>Dzień</b></td>
                    <td><b>Godzina</b></td>
                    <td><b>Nazwa pakietu</b></td>
                    
                    </tr>';
                    while ($row = $wynik->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ilosc'] . "</td>";
                        echo "<td>" . $row['dzien'] . "</td>";
                        echo "<td>" . $row['godzina'] . "</td>";
                        echo "<td>" . $row['nazwa'] . "</td>";
 

                        echo "</tr>";
                    }
                    echo "</table>";
                    } else {
                        echo '<div class="alert alert-dark text-center" role="alert">';
                            echo "BRAK REZERWACJI!";
                            echo '</div>';
                    }
                    ?>
                    </div>
                </div>
            </div>
        </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>