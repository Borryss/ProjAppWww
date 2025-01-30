<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny</title>
    <link rel="stylesheet" href="../css/CSS.css">  <!-- Dołączenie pliku CSS -->
</head>
<body>

<?php

// end_session();
// =======================================
// Dołączenie konfiguracji oraz uruchomienie sesji
// =======================================
include('../cfg.php');  // Dołączenie pliku konfiguracyjnego
session_start();  // Uruchomienie sesji, aby przechować informacje o zalogowaniu


// =======================================
// Logowanie użytkownika - obsługa formularza logowania
// =======================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_email'], $_POST['login_pass'])) {
    // Sprawdzanie, czy podany email i hasło są zgodne z zapisanymi w konfiguracji
    if ($_POST['login_email'] === $login && $_POST['login_pass'] === $pass) {
        $_SESSION['is_logged_in'] = true;  // Ustalenie, że użytkownik jest zalogowany
    } else {
        // Jeżeli dane logowania są błędne, wyświetlamy formularz logowania
        echo "<p>Błędny login lub hasło</p>";
        echo FormularzLogowania();  // Wywołanie funkcji formularza logowania
        exit;
    }
}

// =======================================
// Sprawdzenie, czy użytkownik jest zalogowany
// =======================================
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Jeżeli użytkownik nie jest zalogowany, wyświetlamy formularz logowania
    echo FormularzLogowania();
    exit;
}

// =======================================
// Panel administracyjny - linki nawigacyjne
// =======================================
echo '<h1>Panel Administracyjny</h1>';
echo '<a href="admin.php?action=add">Dodaj Podstronę</a><br>';
echo '<a href="admin.php?action=list">Lista Podstron</a><br>';

// Linki do zarządzania kategoriami
echo '<h2>Zarządzanie Kategoriami</h2>';
echo '<a href="admin.php?action=add_category">Dodaj Kategorię</a><br>';
echo '<a href="admin.php?action=list_categories">Lista Kategorii</a><br>';

echo '<h2>Zarządzanie Produktami</h2>';
echo '<a href="admin.php?action=add_product">Dodaj Produkt</a><br>';
echo '<a href="admin.php?action=list_products">Lista Produktów</a><br>';

echo '<h2 class="spanik"></h2><br>';



// =======================================
// Funkcja generująca formularz logowania
// =======================================
function FormularzLogowania() {
    // Zwraca formularz logowania HTML
    return '

        <h1 class="heading">Panel CMS:</h1>

            <form style="border: none;" method="post" name="LoginForm" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
                <table class="logowanie">
                    <tr><td class="log4_t">Email</td><td><input type="text" name="login_email" class="logowanie" /></td></tr>
                    <tr><td class="log4_t">Haslo</td><td><input type="password" name="login_pass" class="logowanie" /></td></tr>
                    <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="logowanie" value="Zaloguj" /></td></tr>
                </table>
            </form>

    ';
}



// =======================================
// Funkcja wyświetlająca listę podstron
// =======================================
function ListaPodstron() {
    global $conn;
    $query = "SELECT id, page_title FROM page_list ORDER BY id ASC";  // Zapytanie do bazy danych
    $result = mysqli_query($conn, $query);  // Wykonanie zapytania

    // Wyświetlanie wyników w tabeli HTML
    echo '<h2>Lista Podstron</h2>';
    echo '<table style="border: 1px solid #00ff00; border-collapse: collapse;" border="1" cellspacing="0" cellpadding="7">';
    echo '<tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        // Iteracja po wynikach zapytania i wyświetlanie każdej podstrony
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['page_title'] . '</td>';
        echo '<td>
                <a href="admin.php?action=edit&id=' . $row['id'] . '"style="color: #bc02fd; text-decoration: none;  ">Edytuj</a> |
                <a href="admin.php?action=delete&id=' . $row['id'] . '"style="color: #fd0202; text-decoration: none;" >Usuń</a>
              </td>';
        echo '</tr>';
    }

    echo '</table>';
}

// =======================================
// Funkcja edytująca podstronę na podstawie ID
// =======================================
function EdytujPodstrone($id) {
    global $conn;
    $query = "SELECT * FROM page_list WHERE id = $id LIMIT 1";  // Zapytanie do bazy danych
    $result = mysqli_query($conn, $query);  // Wykonanie zapytania
    $row = mysqli_fetch_assoc($result);  // Pobranie danych podstrony

    // Formularz edycji podstrony
    echo '<h2>Edytuj Podstrone</h2>';
    echo '<form method="post" action="admin.php?action=save&id=' . $id . '">';
    echo '<label>Tytuł:</label><input type="text" name="page_title" value="' . htmlspecialchars($row['page_title']) . '" /><br>';
    echo '<label>Treść:</label><textarea name="page_content">' . htmlspecialchars($row['page_content']) . '</textarea><br>';
    echo '<label>Aktywna:</label><input type="checkbox" name="status" ' . ($row['status'] == 1 ? 'checked' : '') . ' /><br>';
    echo '<input type="submit" value="Zapisz">';
    echo '</form>';
}

// =======================================
// Funkcja dodająca nową podstronę
// =======================================
function DodajNowaPodstrone() {
    global $conn;
    // Formularz dodawania nowej podstrony
    echo '<h2>Dodaj Nowa Podstrone</h2>';
    echo '<form method="post" action="admin.php?action=add">';
    echo '<label>Tytuł:</label><input type="text" name="page_title" /><br>';
    echo '<label>Treść:</label><textarea name="page_content"></textarea><br>';
    echo '<label>Aktywna:</label><input type="checkbox" name="status" /><br>';
    echo '<input type="submit" value="Dodaj">';
    echo '</form>';
}

// =======================================
// Pokaz Kategorie
// =======================================
function PokazKategorie() {
    global $conn;

    // Zapytanie SQL do pobrania kategorii
    $query = "SELECT * FROM kategorki WHERE matka = 0 ORDER BY id ASC LIMIT 50"; // Wyświetlamy kategorie główne
    $result = mysqli_query($conn, $query);

    echo '<h2>Lista Kategorii</h2>';
    echo '<table style="border: 1px solid #00ff00; border-collapse: collapse;" border="1" cellspacing="0" cellpadding="1">';
    echo '<tr ">
            <th style="padding: 8px;">ID</th>
            <th style="padding: 8px;">Nazwa</th>
            <th style="padding: 8px;">Akcje</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr >';
        echo '<td style="padding: 8px;">' . htmlspecialchars($row['id']) . '</td>';
        echo '<td style="padding: 8px;">' . htmlspecialchars($row['nazwa']) . '</td>';
        echo '<td style="padding: 8px;">
                <a href="admin.php?action=edit_category&id=' . intval($row['id']) . '" style="color: #bc02fd; text-decoration: none;">Edytuj</a> |
                <a href="admin.php?action=delete_category&id=' . intval($row['id']) . '" style="color: #fd0202; text-decoration: none;">Usuń</a> |
                <a href="admin.php?action=view_subcategories&id=' . intval($row['id']) . '" style="color: #39FF14; text-decoration: none;"></a>
              </td>';
        echo '</tr>';

        // Wypisanie podkategorii (dzieci)
        $query2 = "SELECT * FROM kategorki WHERE matka = " . $row['id'] . " ORDER BY id ASC";
        $result2 = mysqli_query($conn, $query2);
        while ($sub_row = mysqli_fetch_assoc($result2)) {
            echo '<tr >';
            echo '<td style="padding: 8px;">&nbsp;&nbsp;&nbsp;' . htmlspecialchars($sub_row['id']) . '</td>';
            echo '<td style="padding: 8px;">' . htmlspecialchars($sub_row['nazwa']) . '</td>';
            echo '<td style="padding: 8px;">
                    <a href="admin.php?action=edit_category&id=' . intval($sub_row['id']) . '" style="color: #bc02fd; text-decoration: none;">Edytuj</a> |
                    <a href="admin.php?action=delete_category&id=' . intval($sub_row['id']) . '" style="color: #fd0202; text-decoration: none;">Usuń</a>
                  </td>';
            echo '</tr>';
        }


    }

    echo '</table>';
}


function DodajKategorie() {
    // Wyświetlanie formularza
    echo '<h2>Dodaj Nową Kategorię</h2>';
    echo '<form method="post" action="admin.php?action=add_category">';
    echo '<label>Nazwa:</label><input type="text" name="nazwa" required /><br>';
    echo '<label>Matka (ID kategorii głównej):</label><input type="number" name="matka" value="0" /><br>';
    echo '<input type="submit" value="Dodaj kategorię">';
    echo '</form>';
}

function EdytujKategorie($id) {
    global $conn;
    $query = "SELECT * FROM kategorki WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    echo '<h2>Edytuj Kategorię</h2>';
    echo '<form method="post" action="admin.php?action=save_category&id=' . intval($id) . '">';
    echo '<label>Nazwa:</label><input type="text" name="nazwa" value="' . htmlspecialchars($row['nazwa']) . '" required /><br>';
    echo '<label>Matka (ID kategorii głównej):</label><input type="number" name="matka" value="' . intval($row['matka']) . '" /><br>';
    echo '<input type="submit" value="Zapisz">';
    echo '</form>';
}
// =======================================
// Funkcja DodajProdukt
// =======================================

function DodajProdukt() {
    global $conn;

    // Formularz dodawania produktu
    echo '<h2>Dodaj Produkt</h2>';
    echo '<form method="post" enctype="multipart/form-data">
            <label>Tytuł:</label><input type="text" name="tytul" required><br>
            <label>Opis:</label><textarea name="opis" required></textarea><br>
            <label style="margin-bottom: 5px;">Data wygaśnięcia:</label><input type="date" name="data_wygasniecia" required><br>
            <label style="margin-top: 5px;">Cena netto:</label><input type="number" step="0.01" name="cena_netto" required><br>
            <label style="margin-top: 5px;">Podatek VAT (%):</label><input type="number" step="0.01" name="podatek_vat" required><br>
            <label style="margin-top: 5px;">Ilość sztuk:</label><input type="number" name="ilosc_sztuk" required><br>
            <label style="margin-top: 5px;">Status dostępności:</label><input type="checkbox" name="status_dostepnosci"><br>
            <label>Kategoria ID:</label><input type="number" name="kategoria" required><br>
            <label style="margin-top: 5px;">Gabaryt:</label><input type="text" name="gabaryt" required><br>
            <label>Link do zdjęcia:</label><input type="file" name="zdjecie" required><br>

            <input style="margin-top: 30px" type="submit" value="Dodaj Produkt">
          </form>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Pobieranie danych z formularza
        $tytul = mysqli_real_escape_string($conn, $_POST['tytul']);
        $opis = mysqli_real_escape_string($conn, $_POST['opis']);
        $data_wygasniecia = $_POST['data_wygasniecia'];
        $cena_netto = $_POST['cena_netto'];
        $podatek_vat = $_POST['podatek_vat'];
        $ilosc_sztuk = $_POST['ilosc_sztuk'];
        $status_dostepnosci = isset($_POST['status_dostepnosci']) ? 1 : 0;
        $kategoria = $_POST['kategoria'];
        $gabaryt = mysqli_real_escape_string($conn, $_POST['gabaryt']);

        // Obsługa pliku zdjęcia
        if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['error'] === UPLOAD_ERR_OK) {
            $img_dir = 'img/'; // Folder docelowy
            $file_tmp = $_FILES['zdjecie']['tmp_name'];
            $file_name = basename($_FILES['zdjecie']['name']);
            $file_path = $img_dir . $file_name;

            // Przenoszenie pliku do folderu 'img'
            if (!is_dir($img_dir)) {
                mkdir($img_dir, 0777, true); // Tworzenie folderu, jeśli nie istnieje
            }

            if (move_uploaded_file($file_tmp, $file_path)) {
                $zdjecie = $file_path; // Zapisujemy ścieżkę do bazy
            } else {
                echo "<p style='color:red;'>Błąd podczas zapisywania pliku.</p>";
                return;
            }
        } else {
            echo "<p style='color:red;'>Wystąpił błąd z plikiem: " . $_FILES['zdjecie']['error'] . "</p>";
            return;
        }

        // Sprawdzenie, czy kategoria istnieje
        $check_kategoria_query = "SELECT id FROM kategorki WHERE id = ?";
        $stmt_kat = mysqli_prepare($conn, $check_kategoria_query);
        mysqli_stmt_bind_param($stmt_kat, "i", $kategoria);
        mysqli_stmt_execute($stmt_kat);
        $result_kat = mysqli_stmt_get_result($stmt_kat);

        if (mysqli_num_rows($result_kat) == 0) {
            echo "<p style='color:red;'>Nie ma takiej kategorii w bazie danych. Proszę wybrać istniejącą kategorię.</p>";
            return;
        }

        // Przygotowanie dat
        $data_utworzenia = date('Y-m-d');
        $data_modyfikacji = date('Y-m-d');

        // Dodanie produktu
        $query = "INSERT INTO produkty (tytul, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, cena_netto,
        podatek_vat, sztuk_w_magazynie, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssdiiiiss",
            $tytul, $opis, $data_utworzenia, $data_modyfikacji, $data_wygasniecia,
            $cena_netto, $podatek_vat, $ilosc_sztuk, $status_dostepnosci, $kategoria,
            $gabaryt, $zdjecie
        );

        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Produkt został dodany.</p>";
        } else {
            echo "<p style='color:red;'>Wystąpił błąd podczas dodawania produktu: " . mysqli_error($conn) . "</p>";
        }
    }
}


// =======================================
// Funkcja EdytujProdukt
// =======================================
function EdytujProdukt($id) {
    global $conn;

    // Sprawdzenie, czy ID produktu istnieje w bazie
    $query = "SELECT * FROM produkty WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($result)) {
        echo "<p style='color:red;'>Nie znaleziono produktu o podanym ID.</p>";
        return;
    }

    // Formularz edycji produktu z istniejącymi danymi
    echo '<h2>Edytuj Produkt</h2>';
    echo '<form method="post" enctype="multipart/form-data">
        <label>Tytuł:</label><input type="text" name="tytul" value="' . htmlspecialchars($row['tytul']) . '" required><br>
        <label>Opis:</label><textarea name="opis">' . htmlspecialchars($row['opis']) . '</textarea><br>
        <label>Data wygaśnięcia:</label><input type="date" name="data_wygasniecia" value="' . $row['data_wygasniecia'] . '"><br>
        <label style="margin-top: 5px;">Cena netto:</label><input type="number" step="0.01" name="cena_netto" value="' . $row['cena_netto'] . '"><br>
        <label style="margin-top: 5px;">Podatek VAT (%):</label><input type="number" step="0.01" name="podatek_vat" value="' . $row['podatek_vat'] . '"><br>
        <label style="margin-top: 5px;">Sztuk w magazynie:</label><input type="number" name="sztuk_w_magazynie" value="' . $row['sztuk_w_magazynie'] . '"><br>
        <label style="margin-top: 5px;">Status dostępności:</label>
        <input type="checkbox" name="status_dostepnosci" ' . ($row['status_dostepnosci'] ? 'checked' : '') . '><br>
        <label style="margin-top: 5px;">Kategoria:</label><input type="number" name="kategoria" value="' . htmlspecialchars($row['kategoria']) . '"><br>
        <label style="margin-top: 5px;">Gabaryt produktu:</label><input type="text" name="gabaryt_produktu" value="' . htmlspecialchars($row['gabaryt_produktu']) . '"><br>
        <input type="hidden" name="zdjecie" value="' . htmlspecialchars($row['zdjecie']) . '"><br>
        <label>Wybierz zdjęcie:</label><input type="file" name="plik_zdjecia"><br>
        <input style="margin-top: 40px;" type="submit" value="Zapisz zmiany">
      </form>';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobieranie danych z formularza
    $tytul = mysqli_real_escape_string($conn, $_POST['tytul']);
    $opis = mysqli_real_escape_string($conn, $_POST['opis']);
    $data_wygasniecia = $_POST['data_wygasniecia'];
    $cena_netto = $_POST['cena_netto'];
    $podatek_vat = $_POST['podatek_vat'];
    $sztuk_w_magazynie = $_POST['sztuk_w_magazynie'];
    $status_dostepnosci = isset($_POST['status_dostepnosci']) ? 1 : 0;
    $kategoria = $_POST['kategoria'];
    $gabaryt_produktu = mysqli_real_escape_string($conn, $_POST['gabaryt_produktu']);
    $zdjecie = mysqli_real_escape_string($conn, $_POST['zdjecie']);
    $data_modyfikacji = date('Y-m-d'); // Aktualna data

    // Sprawdzenie, czy plik został przesłany
    if (isset($_FILES['plik_zdjecia']) && $_FILES['plik_zdjecia']['error'] == 0) {
        $target_dir = "img/"; // Folder, gdzie pliki będą zapisane
        $target_file = $target_dir . basename($_FILES['plik_zdjecia']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Sprawdzamy, czy plik jest obrazkiem
        $check = getimagesize($_FILES['plik_zdjecia']['tmp_name']);
        if ($check !== false) {
            // Sprawdzamy, czy plik istnieje
            if (file_exists($target_file)) {
                echo "<p style='color:red;'>Plik o tej nazwie już istnieje.</p>";
            } else {
                // Przenosimy plik do folderu img
                if (move_uploaded_file($_FILES['plik_zdjecia']['tmp_name'], $target_file)) {
                    echo "<p></p>";
                    // Zapisujemy ścieżkę do pliku w bazie danych
                    $zdjecie = $target_file;
                } else {
                    echo "<p style='color:red;'>Wystąpił błąd podczas przesyłania pliku.</p>";
                }
            }
        } else {
            echo "<p style='color:red;'>Plik nie jest obrazem.</p>";
        }
    }

    // Sprawdzenie, czy kategoria istnieje
    $check_kategoria_query = "SELECT id FROM kategorki WHERE id = ?";
    $stmt_kat = mysqli_prepare($conn, $check_kategoria_query);
    mysqli_stmt_bind_param($stmt_kat, "i", $kategoria);
    mysqli_stmt_execute($stmt_kat);
    $result_kat = mysqli_stmt_get_result($stmt_kat);

    if (mysqli_num_rows($result_kat) == 0) {
        echo "<p style='color:red;'>Nie ma takiej kategorii. Proszę wybrać istniejącą kategorię.</p>";
        return;
    }

    // Aktualizacja danych produktu
    $update_query = "UPDATE produkty SET
                        tytul = ?, opis = ?, data_wygasniecia = ?, cena_netto = ?, podatek_vat = ?,
                        sztuk_w_magazynie = ?, status_dostepnosci = ?, kategoria = ?,
                        gabaryt_produktu = ?, zdjecie = ?, data_modyfikacji = ?
                     WHERE id = ?";

    $stmt_update = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt_update, "ssssdiissssi",
        $tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat,
        $sztuk_w_magazynie, $status_dostepnosci, $kategoria,
        $gabaryt_produktu, $zdjecie, $data_modyfikacji, $id
    );

    if (mysqli_stmt_execute($stmt_update)) {
        echo "<p>Produkt został zaktualizowany.</p>";
    } else {
        echo "<p style='color:red;'>Wystąpił błąd podczas aktualizacji: " . mysqli_error($conn) . "</p>";
    }
}
}

/// =======================================
// Funkcja PokazProdukty
// =======================================
function PokazProdukty() {
    global $conn;

    $query = "SELECT * FROM produkty ORDER BY data_utworzenia DESC";
    $result = mysqli_query($conn, $query);

    echo '<table style="border: 1px solid #00ff00; border-collapse: collapse; width: 100%;" border="1" cellspacing="0" cellpadding="6">';
    echo '<tr>
            <th>ID</th>
            <th style="max-width: 100px; word-wrap: break-word;">Tytuł</th>
            <th style="max-width: 200px; word-wrap: break-word;">Opis</th>
            <th style="max-width: 100px; word-wrap: break-word;">Data utworzenia</th>
            <th style="max-width: 100px; word-wrap: break-word;">Data modyfikacji</th>
            <th style="max-width: 100px; word-wrap: break-word;">Data wygaśnięcia</th>
            <th style="max-width: 90px; word-wrap: break-word;">Cena netto</th>
            <th style="max-width: 100px; word-wrap: break-word;">Podatek VAT</th>
            <th style="max-width: 80px; word-wrap: break-word;">Sztuk w magazynie</th>
            <th style="max-width: 100px; word-wrap: break-word;">Status dostępności</th>
            <th style="max-width: 150px; word-wrap: break-word;">Kategoria</th>
            <th style="max-width: 120px; word-wrap: break-word;">Gabaryt produktu</th>
            <th style="max-width: 200px; word-wrap: break-word;">Zdjęcie produktu</th>
            <th >Akcje</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status_dostepnosci'] ? 'Dostępny' : 'Niedostępny';
        $category_query = "SELECT nazwa FROM kategorki WHERE id = " . $row['kategoria'];
        $category_result = mysqli_query($conn, $category_query);
        $category_row = mysqli_fetch_assoc($category_result);
        $category_name = $category_row ? $category_row['nazwa'] : 'Brak kategorii';

        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td style="max-width: 100px; word-wrap: break-word;">' . htmlspecialchars($row['tytul']) . '</td>';
        echo '<td style="max-width: 200px; word-wrap: break-word;">' . htmlspecialchars($row['opis']) . '</td>';
        echo '<td style="max-width: 100px; word-wrap: break-word;">' . $row['data_utworzenia'] . '</td>';
        echo '<td style="max-width: 100px; word-wrap: break-word;">' . $row['data_modyfikacji'] . '</td>';
        echo '<td style="max-width: 100px; word-wrap: break-word;">' . $row['data_wygasniecia'] . '</td>';
        echo '<td style="max-width: 90px; word-wrap: break-word;">' . $row['cena_netto'] . ' PLN</td>';
        echo '<td style="max-width: 100px; word-wrap: break-word;">' . $row['podatek_vat'] . '%</td>';
        echo '<td style="max-width: 80px; word-wrap: break-word;">' . $row['sztuk_w_magazynie'] . '</td>';
        echo '<td style="max-width: 100px; word-wrap: break-word;">' . $status . '</td>';
        echo '<td style="max-width: 150px; word-wrap: break-word;">' . $category_name . '</td>';
        echo '<td style="max-width: 120px; word-wrap: break-word;">' . htmlspecialchars($row['gabaryt_produktu']) . '</td>';
        echo '<td style="max-width: 200px; text-align: center;">
        <img src="' . htmlspecialchars($row['zdjecie']) . '" alt="Zdjęcie produktu" style="max-width: 200px; height: auto;"/>
        </td>';

        echo '<td>
                <a href="admin.php?action=edit_product&id=' . $row['id'] . '" style="color: #bc02fd; text-decoration: none;">Edytuj</a> |
                <a href="admin.php?action=delete_product&id=' . $row['id'] . '" style="color: #fd0202; text-decoration: none;">Usuń</a>
              </td>';
        echo '</tr>';

    }

    echo '</table>';
}



// =======================================
// Funkcja UsunProdukt
// =======================================
function UsunProdukt($id) {
    global $conn;
    $query = "DELETE FROM produkty WHERE id = $id";
    mysqli_query($conn, $query);

}

// =======================================
// Obsługa akcji dla produktów
// =======================================
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'add_product') {
        DodajProdukt();
    } elseif ($_GET['action'] === 'list_products') {
        PokazProdukty();
    } elseif ($_GET['action'] === 'edit_product' && isset($_GET['id'])) {
        EdytujProdukt(intval($_GET['id']));
    } elseif ($_GET['action'] === 'delete_product' && isset($_GET['id'])) {
        UsunProdukt(intval($_GET['id']));
        PokazProdukty();
        echo '<h2 class="spanik"></h2><br>';
        echo "<p>Produkt został usunięty.</p>";

    }
}


// =======================================
// Obsługa różnych akcji (dodawanie, edytowanie, usuwanie) na podstawie parametru 'action'
// =======================================

if (isset($_GET["action"])) {
    // Jeżeli akcja to 'add', wywołujemy funkcję dodania nowej podstrony



if ($_GET['action'] === 'add' ) {
    // Jeżeli akcja to 'add', wywołujemy funkcję dodania nowej podstrony
    DodajNowaPodstrone();
}

if ($_GET['action'] === 'edit' && isset($_GET['id'])) {
    // Jeżeli akcja to 'edit' i istnieje parametr 'id', wywołujemy funkcję edytowania podstrony
    EdytujPodstrone(intval($_GET['id']));
}

if ($_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Jeżeli akcja to 'delete' i istnieje parametr 'id', usuwamy podstronę
    $id = intval($_GET['id']);  // Zabezpieczenie ID przed SQL Injection
    $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";  // Zapytanie SQL do usunięcia podstrony
    mysqli_query($conn, $query);  // Wykonanie zapytania SQL
    ListaPodstron();
    echo '<h2 class="spanik"></h2><br>';
    echo "Podstrona została usunięta.";  // Informacja o usunięciu
}

// =======================================
// Zapisywanie zmian (aktualizacja) w podstronie
// =======================================
if ($_GET['action'] === 'save' && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobieranie danych z formularza edycji
    $id = intval($_GET['id']);  // Zabezpieczenie ID przed SQL Injection
    $title = mysqli_real_escape_string($conn, $_POST['page_title']);  // Ochrona przed SQL Injection
    $content = mysqli_real_escape_string($conn, $_POST['page_content']);  // Ochrona przed SQL Injection
    $status = isset($_POST['status']) ? 1 : 0;  // Ustawienie statusu podstrony

    // Zapytanie do bazy danych w celu aktualizacji podstrony
    $query = "UPDATE page_list SET page_title = '$title', page_content = '$content', status = $status WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "Podstrona została zaktualizowana.";  // Potwierdzenie sukcesu
    } else {
        echo "Błąd podczas aktualizacji: " . mysqli_error($conn);  // Błąd, jeżeli zapytanie nie zostało wykonane poprawnie
    }
}

}

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'list') {
        ListaPodstron();  // Wywołanie funkcji wyświetlającej listę podstron
    } elseif ($_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obsługa dodawania nowej podstrony
        $title = $_POST['page_title'];
        $content = $_POST['page_content'];
        $status = isset($_POST['status']) ? 1 : 0;

        // Zapytanie SQL do dodania nowej podstrony
        $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$content', $status)";
        mysqli_query($conn, $query);  // Wykonanie zapytania
        echo "Podstrona została dodana.";  // Potwierdzenie dodania
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        // Usuwanie podstrony
        $id = intval($_GET['id']);
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
        mysqli_query($conn, $query);  // Wykonanie zapytania
        echo "";  // Potwierdzenie usunięcia
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'save_category' && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_GET['id']);
    $nazwa = mysqli_real_escape_string($conn, $_POST['nazwa']);
    $matka = intval($_POST['matka']);

    $query = "UPDATE kategorki SET nazwa = '$nazwa', matka = $matka WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "Kategoria została zaktualizowana.";
    } else {
        echo "Błąd podczas aktualizacji: " . mysqli_error($conn);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete_category' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM kategorki WHERE id = $id LIMIT 1";
    if (mysqli_query($conn, $query)) {
        PokazKategorie();
        echo '<h2 class="spanik"></h2><br>';
        echo "Kategoria została usunięta.";
    } else {
        PokazKategorie();
        echo '<h2 class="spanik"></h2><br>';
        echo "Błąd podczas usuwania: " . mysqli_error($conn);
    }

    $query = "DELETE FROM kategorki WHERE matka = $id";
    if (mysqli_query($conn, $query)) {
        echo "";
    } else {
        echo "";
    }



}

if (isset($_GET['action']) && $_GET['action'] === 'add_category') {
    DodajKategorie();

    if (isset($_GET['action']) && $_GET['action'] === 'add_category') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pobieranie danych z formularza
            global $conn;
            $nazwa = mysqli_real_escape_string($conn, $_POST['nazwa']);
            $matka = intval($_POST['matka']);

            // Sprawdzanie czy matka = 0 lub istnieje w kolumnie id
            if ($matka != 0) {
                $query = "SELECT COUNT(*) AS liczba FROM kategorki WHERE id = $matka AND matka = 0";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                if ($row['liczba'] == 0) {
                    echo "Błąd: Podana kategoria nie istnieje!" . mysqli_error($conn) ;
                    exit; // Zakończ dalsze wykonanie
                }
            }

            // Wstawianie danych do bazy
            $query = "INSERT INTO kategorki (nazwa, matka) VALUES ('$nazwa', $matka)";
            if (mysqli_query($conn, $query)) {
                echo "Kategoria została dodana.";
            } else {
                echo "Błąd podczas dodawania kategorii: " . mysqli_error($conn);
            }
    }
}



}

if (isset($_GET['action']) && $_GET['action'] === 'list_categories') {
    PokazKategorie();
}

if (isset($_GET['action']) && $_GET['action'] === 'edit_category') {
    EdytujKategorie(intval($_GET['id']));
}







?>

</body>   
</html>   