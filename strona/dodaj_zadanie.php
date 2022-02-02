<?php



session_start();
include_once("connect.php");

$imie = $_SESSION['imie'];
$nazwisko = $_SESSION['nazwisko'];
$email = $_SESSION['email'];
$stanowisko = $_SESSION['stanowisko'];



$zapytanie = "SELECT * FROM users";
$wynik = $conn->query($zapytanie);




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $zapytanie = "SELECT * FROM users WHERE id = '$id'";
    $wynik = $conn->query($zapytanie);
}

if (isset($_POST['zadanie'])) {
    $id_prac = $_POST['id_prac'];
    $zadanie = $_POST['zadanie'];
    $zapytanie2 = "INSERT INTO zadania (id_prac, zadanie)
    VALUES ('$id_prac', '$zadanie')";
    if (mysqli_query($conn, $zapytanie2)) {
        $success_msg = "DODANO ZADANIE";
    } else {
        $error_msg = "BŁĄD!";
    }
}

if ($_SESSION['stanowisko'] != "Kierownik") {
    header("Location: login.php");
}



?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dodaj zadanie</title>
    <meta name="description" content="">
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
    <br><br>

    <main>
        
            <div class="contaier">

                <div id="formularz">
                    <form action="dodaj_zadanie.php" method="post">
                        <label for="id_prac">Pracownik: </label><br>
                        <select name="id_prac" id="id_prac" required>
                            <?php
                            if (isset($_GET['id'])) {
                                $row = $wynik->fetch_assoc();
                                echo "<option value =" . $_GET['id'] . ">" . $row['imie'] . " " . $row['nazwisko'] . " " . $row['stanowisko'] . "</option>";
                            }

                            while ($row = $wynik->fetch_assoc()) {
                                echo "<option value =" . $row['id'] . ">" . $row['imie'] . " " . $row['nazwisko'] . " " . $row['stanowisko'] . "</option>";
                            }


                            ?>
                        </select> <br><br>
                        <textarea name="zadanie" id="tresc" cols="30" rows="10" required></textarea>
                        <br>


                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg">DODAJ</button>
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
                        }
                    ?>
                </div>
            </div>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>