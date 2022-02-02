<?php
session_start();
include_once("connect.php");

if ($_SESSION['stanowisko'] === "Kierownik") {

    if (isset($_POST['szukaj'])) {
        $kolumna = $_POST['kolumna'];
        $wartosc = $_POST['szukaj'];

        if ($kolumna == "imie") {
            $zapytanie = "SELECT * FROM users WHERE imie = '$wartosc'";
            $wynik = $conn->query($zapytanie);
        } elseif ($kolumna == "nazwisko") {
            $zapytanie = "SELECT * FROM users WHERE nazwisko = '$wartosc'";
            $wynik = $conn->query($zapytanie);
        } elseif ($kolumna == "email") {
            $zapytanie = "SELECT * FROM users WHERE email = '$wartosc'";
            $wynik = $conn->query($zapytanie);
        } elseif ($kolumna == "stanowisko") {
            $zapytanie = "SELECT * FROM users WHERE stanowisko = '$wartosc'";
            $wynik = $conn->query($zapytanie);
        }
    } else {
        $imie = $_SESSION['imie'];
        $nazwisko = $_SESSION['nazwisko'];
        $email = $_SESSION['email'];
        $stanowisko = $_SESSION['stanowisko'];

        $zapytanie = "SELECT * FROM users";
        $wynik = $conn->query($zapytanie);
    }
} else {
    header("Location: login.php");
}
?>




<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista pracowników</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                    <li class = "nav-item"><a class = "nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <br><br>

    <main>
        
            <div class="contaier">

                <div id="formularz">
                    <form action="lista_kiero.php" method="post">
                        <div class="mb-3">
                            <label for="lista" class="form-label">Szukaj według: </label>
                            <select name="kolumna" id="lista" class="form-select">
                                <option value="imie">Imie</option>
                                <option value="nazwisko">Nazwisko</option>
                                <option value="email">Email</option>
                                <option value="stanowisko">Stanowisko</option>
                            </select> <br>
                            <div class="mb-3">
                                <input type="text" id="szukaj" name="szukaj">
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg">WYSZUKAJ</button>
                            </div>

                        </div>


                    </form>
                </div>
                <br><br>
                <div class="table-responsive text-center offset-md-3 col-md-6 offset-md-3">
                    <?php
                    if ($wynik->num_rows > 0) {
                        echo '<table class="table table-bordered table-light">
                        <tr>
                        <td><b>Imię</b></td>
                        <td><b>Nazwisko</b></td>
                        <td><b>Adres e-mail</b></td>
                        <td><b>Login</b></td>
                        <td><b>Stanowisko</b></td>
                        <td><b>Dodaj zadanie</b></td>
                        
                        </tr>';
                        while ($row = $wynik->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['imie'] . "</td>";
                            echo "<td>" . $row['nazwisko'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['login'] . "</td>";
                            echo "<td>" . $row['stanowisko'] . "</td>";
                            echo "<td><a href=\"dodaj_zadanie.php?id=" . $row['id'] . "\"><i class='material-icons' style='color:#0d6efd;'>add</i></a></td>";

                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    else{
                        echo '<div class="alert alert-dark text-center" role="alert">';
                        echo "BRAK OSÓB O PODANYCH PARAMETRACH";
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        
    </main>
    <br><br>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>