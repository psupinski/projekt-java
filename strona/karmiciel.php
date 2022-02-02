<?php
    session_start();
    include_once("connect.php");
    if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        exit();
    }

    if($_SESSION['stanowisko'] != "Karmiciel")
    {
        header("Location: login.php");
    }

    $id = $_SESSION['id'];
    $zapytanie = "SELECT * FROM users WHERE id = $id";
    $wynik = $conn->query($zapytanie);
?>
<!DOCTYPE html>
<html lang = "pl">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel pracownika</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">

</head>

<body>
<header>
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
    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
                
                    <p class="h1 text-center mb-3">Informacje o pracowniku</p>
                    <table class="table  table-bordered table-light">
                        <tr>
                            <td><b>Imie i nazwisko</b></td>
                            <td><b>Stanowisko</b></td>
                            <td><b>Login</b></td>
                            <td><b>Adres e-mail</b></td>

                        </tr>
                        <?php 
                            while ($row = $wynik->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['imie'] . " " . $row['nazwisko'] . "</td>";
                                echo "<td>" . $row['stanowisko'] . "</td>";
                                echo "<td>" . $row['login'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
         
        
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <p class="h2 text-center"><?php shell_exec("javac Data.java"); 
                        echo shell_exec("java Data");?></p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" 
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" 
    crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>