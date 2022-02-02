<?php
session_start();
include_once("connect.php");
if (isset($_SESSION['id']) != "") {
    if ($_SESSION['stanowisko'] === 'Admin') {
        header("Location: welcome.php");
    } elseif ($_SESSION['stanowisko'] === 'Kierownik') {
        header("Location: kierownik.php");
    } elseif ($_SESSION['stanowisko'] === "Przewodnik") {
        header("Location: przewodnik.php");
    } elseif ($_SESSION['stanowisko'] === "Weterynarz") {
        header("Location: weterynarz.php");
    } elseif ($_SESSION['stanowisko'] === "Karmiciel") {
        header("Location: karmiciel.php");
    }
}
if (isset($_POST['login'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $psw = mysqli_real_escape_string($conn, $_POST['psw']);
    $zapytanie = "SELECT * FROM users WHERE login = '$login' AND psw = '$psw'";
    if ($wynik = $conn->query($zapytanie)) {
        if ($wynik->num_rows > 0) {
            $row = $wynik->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['imie'] = $row['imie'];
            $_SESSION['nazwisko'] = $row['nazwisko'];
            $_SESSION['login'] = $row['login'];
            $_SESSION['psw'] = $row['psw'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['stanowisko'] = $row['stanowisko'];

            if ($_SESSION['stanowisko'] == "Admin") {
                if ($_SESSION['login'] === $_SESSION['psw']) {
                    header("Location: zmien_haslo.php");
                } else {
                    header("Location: welcome.php");
                }
            } elseif ($_SESSION['stanowisko'] == "Kierownik") {
                if ($_SESSION['login'] === $_SESSION['psw']) {
                    header("Location: zmien_haslo.php");
                } else {
                    header("Location:kierownik.php");
                }
            } elseif ($_SESSION['stanowisko'] == "Przewodnik") {
                if ($_SESSION['login'] === $_SESSION['psw']) {
                    header("Location: zmien_haslo.php");
                } else {
                    header("Location: przewodnik.php");
                }
            } elseif ($_SESSION['stanowisko'] === "Weterynarz") {
                if ($_SESSION['login'] === $_SESSION['psw']) {
                    header("Location: zmien_haslo.php");
                } else {
                    header("Location: weterynarz.php");
                }
            } elseif ($_SESSION['stanowisko'] === "Karmiciel") {
                if ($_SESSION['login'] === $_SESSION['psw']) {
                    header("Location: zmien_haslo.php");
                } else {
                    header("Location: karmiciel.php");
                }
            }



            $wynik->free_result();
        } else {
            $error_msg = "LOGIN LUB HASŁO JEST NIEPRAWIDŁOWE!";
        }
    }




}




?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zaloguj sie</title>
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
                    <li class="nav-item"><a class="nav-link" href="program.php">Program wycieczek</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Panel pracowników</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <br><br>
    <main>

        <div class="contaier">
            <div id="formularz">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="login">Login</label><br>
                        <input type="text" placeholder="Podaj swój login" name="login" id="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="psw">Hasło</label><br>
                        <input type="password" placeholder="Podaj swoje hasło" name="psw" id="psw" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">ZALOGUJ</button>
                    </div>
                    <br>
                    <?php
                    if(isset($error_msg)) {
                        echo '<div class="alert alert-danger text-center" role="alert">';
                        echo $error_msg;
                        echo '</div>';
                    }
                    ?>
                </form>
                

            </div>
        </div>

    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>