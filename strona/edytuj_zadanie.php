<?php
session_start();
include_once("connect.php");


if ($_SESSION['stanowisko'] === "Kierownik") {



    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $zapytanie = "SELECT * FROM zadania WHERE id = '$id'";
        $wynik = $conn->query($zapytanie);
    }

    if (isset($_POST['tresc'])) {
        $id = $_POST['id'];
        $tresc = $_POST['tresc'];
        $zapytanie = "UPDATE zadania SET zadanie = '$tresc' WHERE id = $id";
        $wynik = $conn->query($zapytanie);
        header("Location: lista_zadan.php");
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
    <title>Edycja zadania</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                    <li class="nav-item"><a class="nav-link" href="login.php">Panel pracowników</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <br><br>
    <main>
        <section>
            <div class="contaier">
                <div id="formularz">
                    <form action="edytuj_zadanie.php" method="post">
                        <select name="id" id="login" style="visibility:hidden;" required>
                            <?php
                            if (isset($_GET['id'])) {
                                $row = $wynik->fetch_assoc();
                                echo "<option value =" . $_GET['id'] . "></option>";
                            }
                            ?>
                        </select>
                        <textarea name="tresc" id="login" cols="30" rows="10" required></textarea>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">ZATWIERDŹ</button>
                        </div> <br>



                    </form>
                </div>
            </div>
        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>