<?php

    $nr_indeksu = '170271';
    $nrGrupy = 'ISI4';

    echo 'Borys Kutsenko' . $nr_indeksu . '<br/>' . 'grupa' . $nrGrupy . '<br/>';

    echo 'Zastosowanie metody include() <br/ >';

    // Zadanie 2a: include() oraz require_once()
    echo '2a) Demonstracja include() oraz require_once(): <br />';
    include('testik.php'); // dołącz plik PHP
    require_once('testik.php'); // wymaga pliku tylko raz
    echo 'Dołączono pliki przy pomocy include() oraz require_once(). <br /><br />';

    // Zadanie 2b: Warunki if, else, elseif, switch
    echo '2b) Przykłady if, else, elseif, switch: <br />';
    $liczba = 10;

    if ($liczba < 5) {
        echo 'Liczba jest mniejsza niż 5 <br />';
    } elseif ($liczba == 5) {
        echo 'Liczba jest równa 5 <br />';
    } else {
        echo 'Liczba jest większa niż 5 <br />';
    }

    switch ($liczba) {
        case 5:
            echo 'Liczba wynosi 5 <br />';
            break;
        case 10:
            echo 'Liczba wynosi 10 <br />';
            break;
        default:
            echo 'Liczba nie jest ani 5, ani 10 <br />';
            break;
    }

    // Zadanie 2c: Pętla while i for
    echo '2c) Pętla while oraz for: <br />';
    $i = 0;
    while ($i < 5) {
        echo 'Iteracja while: ' . $i . '<br />';
        $i++;
    }

    for ($j = 0; $j < 5; $j++) {
        echo 'Iteracja for: ' . $j . '<br />';
    }

    // Zadanie 2d: Typy zmiennych $_GET, $_POST, $_SESSION
    echo '2d) Typy zmiennych $_GET, $_POST, $_SESSION: <br />';
    echo '$_GET i $_POST to zmienne superglobalne używane do przesyłania danych. <br />';

    // W przykładzie $_GET oraz $_POST, zakładamy przesłanie wartości np. ?imie=Jan&nazwisko=Kowalski
    if (isset($_GET['imie']) && isset($_GET['nazwisko'])) {
    echo 'Dane z $_GET: ' . $_GET['imie'] . ' ' . $_GET['nazwisko'] . '<br />';
    } 
    else {
    echo 'Dane z $_GET: brak danych <br />';
    }
    
    // Przykład użycia $_SESSION wymaga wcześniejszego uruchomienia sesji
    session_start();
    $_SESSION['nazwa'] = 'Jan Kowalski';
    echo 'Dane z $_SESSION: ' . $_SESSION['nazwa'] . '<br />';


?>