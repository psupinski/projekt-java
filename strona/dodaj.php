<?php

session_start();
include_once("connect.php");
if (isset($_POST['imie'])) {

    $error = false;
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $stanowisko = $_POST['stanowisko'];
    $login = $_POST['login'];
    $psw = $_POST['login'];

    $wynik = $conn->query("select id from users");
    $id = $wynik->num_rows + 1;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "PODAJ POPRAWNY ADRES EMAIL";
    }

    if (!$error) {
        $zapytanie = "INSERT INTO users (id, imie, nazwisko, email, stanowisko, login, psw)
    VALUES ('$id', '$imie', '$nazwisko', '$email', '$stanowisko', '$login', '$psw')";
        if (mysqli_query($conn, $zapytanie)) {
            $success_msg = "DODANO PRACOWNIKA";
        } else {
            $error_msg = "BŁĄD! ";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dodaj pracownika</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <li class="nav-item"><a class="nav-link" href="dodaj.php">Dodaj pracownika</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista.php">Lista pracowników</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_zadan.php">Lista zadań</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Panel pracowników</a></li>
                    <li class="nav-item"><a class="nav-link" href="zmien_haslo.php">Zmień hasło</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj się</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <br><br>
    <main>

        <div class="contaier">
            <div id="formularz">
                <form action="dodaj.php" method="post">
                    <div class="mb-3">
                        <label for="imie" class="form-label">Imię</label>
                        <input type="text" class="form-control" id="imie" name="imie" required>
                    </div>
                    <div class="mb-3">
                        <label for="nazwisko" class="form-label">Nazwisko</label>
                        <input type="text" class="form-control" id="nazwisko" name="nazwisko" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adres e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-3 ">
                        <label for="stanowisko" class="form-label">Stanowisko</label>
                        <select class="form-select" id="stanowisko" name="stanowisko" required>
                            <option value="" disabled selected hidden>Stanowiska</option>
                            <option value="Kierownik">Kierownik</option>
                            <option value="Przewodnik">Przewodnik</option>
                            <option value="Karmiciel">Karmiciel</option>
                            <option value="Weterynarz">Weterynarz</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">DODAJ</button>
                    </div>
                    <br>



                </form>
                <?php
                if(isset($error_msg)) {
                        echo '<div class="alert alert-danger text-center" role="alert">';
                        echo $error_msg;
                        echo '</div>';
                    }
                if(isset($success_msg)) {
                        echo '<div class="alert alert-success text-center" role="alert">';
                        echo $success_msg;
                        echo '</div>';
                    }
                    ?>
            </div>






        </div>
    </main>










    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>