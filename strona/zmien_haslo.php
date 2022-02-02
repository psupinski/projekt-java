<?php
session_start();
include_once("connect.php");

if (isset($_POST['haslo']) && isset($_POST['powtorz_haslo'])) {
    $id = $_SESSION['id'];
    $psw = $_POST['haslo'];
    $psw2 = $_POST['powtorz_haslo'];

    if ($psw === $psw2) {
        $zapytanie = "UPDATE users SET psw = '$psw' WHERE id = '$id'";
        $wynik = $conn->query($zapytanie);
        $success_msg = "Hasło zostało zmienione";
        
        
    } else {
        $error_msg = "Podane hasła się róznią";
    }
}

?>





<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zmień hasło</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
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
    <main>
        
            <div class="contaier">
                <br><br>
                <div id="formularz">
                    <form action="zmien_haslo.php" method="post">
                        <label for="login">Nowe hasło: </label><br>
                        <input type="password" id="login" name="haslo" required><br>
                        <label for="psw">Powtórz hasło: </label><br>
                        <input type="password" id="psw" name="powtorz_haslo" required><br>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">ZMIEŃ HASŁO</button>
                        </div> <br>




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
                    }?>
                </div>
            </div>
       
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>