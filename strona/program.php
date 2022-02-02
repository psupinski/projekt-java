<?php

session_start();
include_once("connect.php");

$zapytanie = "SELECT * FROM pakiety";
$wynik = $conn->query($zapytanie);

$zapytanie1 = "SELECT * FROM godziny";
$wynik1 = $conn->query($zapytanie1);


if (isset($_POST['ilosc'])) {
    $ilosc = $_POST['ilosc'];
    $id_pakietu = $_POST['pakiet'];
    $dzien = $_POST['termin'];
    $godzina = $_POST['godzina'];
    $zapytanie3 = "SELECT * FROM wycieczki WHERE dzien = '" . $dzien . "' AND godzina = '" . $godzina . "'";
    $wynik3 = $conn->query($zapytanie3);
    $tmp = mysqli_query($conn, $zapytanie3);
    if (mysqli_num_rows($tmp) > 0) {
        $info = "TERMIN JEST JUŻ ZAREZERWOWANY";
    } else {
        $zapytanie2 = "INSERT INTO wycieczki (id_pakietu, ilosc, dzien, godzina) 
                VALUES ('$id_pakietu', '$ilosc', '$dzien', '$godzina')";
        if (mysqli_query($conn, $zapytanie2)) {
            $success_msg = "ZAREZERWOWANO";
        } else {
            $error_msg = "BŁĄD";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Program wycieczek</title>
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
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm text-center mt-5">
                    <div class="card">
                        <img src="img/sawanna.jpg" class="card-img-top" alt="Sawanna">
                        <div class="card-body">
                            <h5 class="card-title">Zwierzęta Sawanny</h5>
                            <p class="card-text">Możliwość oglądania zwierząt sawanny takich jak zebry, lwy, gepardy, słonie i wiele innych</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm text-center mt-5">
                    <div class="card">
                        <img src="img/arktyka.jpg" class="card-img-top" alt="Arktyka">
                        <div class="card-body">
                            <h5 class="card-title">Zwierzęta Arktyki</h5>
                            <p class="card-text">Zobacz zwierzęta żyjące w mroźnym klimacie, takie jak niedźwiedź polarny, pingwin, mors i wiele innych.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm text-center mt-5">
                    <div class="card">
                        <img src="img/zoo.jpg" class="card-img-top" alt="Zoo">
                        <div class="card-body">
                            <h5 class="card-title">Cały ogród zoologiczny</h5>
                            <p class="card-text">Możliwość obejrzenia całego ogrodu zoologicznego i wszystkich dostępnych zwierząt.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm text-center mb-3 mt-3">
                    <p class="h1">Zarezerwuj wycieczkę z przewodnikiem po naszym ZOO!</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="formularz">
                        <form action="program.php" method="post">
                            <div class="mb-3">
                                <label for="ilosc" class="form-label">Ilość osób</label>
                                <input type="number" min = "10" max = "50" class="form-control" name="ilosc" id="ilosc" required>
                            </div>
                            <div class="mb-3">
                                <label for="pakiet" class="form-label">Wybierz pakiet</label>
                                <select class="form-select" name="pakiet" id="pakiet">
                                    <?php
                                    while ($row = $wynik->fetch_assoc()) {
                                        echo "<option value =" . $row['id'] . ">" . $row['nazwa'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="termin" class="form-label">Termin</label>
                                <input type="date" class="form-control" name="termin" id="termin" required>
                            </div>
                            <div class="mb-3">
                                <label for="godzina" class="form-label">Wybierz godzinę</label>
                                <select class="form-select" name="godzina" id="godzina" required>
                                    <option value="" disabled selected hidden>Dostępne godziny</option>
                                    <?php
                                    while ($row = $wynik1->fetch_assoc()) {
                                        echo "<option value =" . $row['godziny'] . ">" . $row['godziny'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg">REZERWUJ</button>
                            </div> <br>
                            <?php if (isset($success_msg)) {
                                echo '<div class="alert alert-success text-center" role="alert">';
                                echo $success_msg;
                                echo '</div>';
                            }
                            if (isset($error_msg)) {
                                echo '<div class="alert alert-danger text-center" role="alert">';
                                echo $error_msg;
                                echo '</div>';
                            }
                            if (isset($info)) {
                                echo '<div class="alert alert-danger text-center" role="alert">';
                                echo $info;
                                echo '</div>';
                            }
                            ?>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </main>
    <script>
        var today = new Date();
        var dd = today.getDate() + 1;
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("termin").setAttribute("min", today);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>