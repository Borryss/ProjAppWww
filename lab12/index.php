<?php
// Włączenie raportowania błędów, z wyłączeniem NOTICE i WARNING
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Ładowanie pliku konfiguracyjnego
include('cfg.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Borys Kutsenko" />
    <title>Największe budynki świata</title>
    <!-- Ładowanie zewnętrznych plików JS i CSS -->
    <link rel="stylesheet" type="text/css" href="css/CSS.css">
    <script src="js/kolorujtlo.js"></script>
    <script src="js/timedate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body onload="startclock()">

<!-- Nawigacja główna -->
<div class="topnav">
    <a href="index.php?idp=StronaG">Strona Główna</a>
    <a href="index.php?idp=BurjKhalifa">Burj Khalifa</a>
    <a href="index.php?idp=Merdeka118">Merdeka 118</a>
    <a href="index.php?idp=ShanghaiTower">Shanghai Tower</a>
    <a href="index.php?idp=MakkahRoyalClockTower">Makkah Royal Clock Tower</a>
    <a href="index.php?idp=Kontakt">Kontakt</a>
    <a href="index.php?idp=filmy">Filmy</a>
</div>

<!-- Sekcje zegarka -->
<div style="margin-top: 20px;
            margin-bottom: 20px;" id="zegarek"></div>
<div style="margin-top: 20px;
            margin-bottom: 20px;" id="data"></div>




<div id="animacjaTestowa1" class="test-block">kliknij, a sie powieksze</div>

<!-- Animacja przy kliknięciu -->
<script>
    $("#animacjaTestowa1").on("click", function() {
        $(this).animate({
            width: "500px",
            opacity: 0.4,
            fontSize: "3em",
            borderWidth: "10px"
        }, 1500);
    });
</script>

<div id="animacjaTestowa2" class="test-block">Najedz kursorem, a sie powiekszy</div>

<!-- Animacja przy najechaniu kursorem -->
<script>
    $("#animacjaTestowa2").on({
        "mouseover" : function() {
            $(this).animate({
                width: 300
            }, 800);
        },
        "mouseout" : function() {
            $(this).animate({
                width: 200
            }, 800);
        }
    });
</script>

<div id="animacjaTestowa3" class="test-block">Klikaj, abym urosl</div>

<!-- Animacja przy kliknięciu (rozmiar i przezroczystość) -->
<script>
    $("#animacjaTestowa3").on("click", function(){
        if (!$(this).is(":animated")) {
            $(this).animate({
                width: "+=" + 50,
                height: "+=" + 10,
                opacity: "-=" + 0.1,
                duration: 3000
            });
        }
    });
</script>

<!-- Formularz do zmiany tła -->
<form style="border: none;" method="post" name="background">
    <input style="margin-left: -640px;" class="btn_koncz" type="button" value="yelow" onclick="changeBackground('#FFF000')">
</form>

<!-- Ładowanie dynamicznej treści z pliku 'showpage.php' -->
<div class="content">
    <?php include('showpage.php'); ?>
</div>

<!-- Wyświetlenie danych autora -->
<?php
    $nr_indeksu = '170271';
    $nrGrupy = '4';
    echo 'Autor: Borys Kutsenko ' . $nr_indeksu . ' grupa ' . $nrGrupy . '<br /><br />';
?>

<h2 class="span"></h2>

<!-- Stopka strony -->
<div class="footer">
    <p>&copy; 2024 170271</p>
</div>

</body>
</html>

