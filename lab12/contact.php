<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/**
 * Formularz kontaktowy
 *
 * Funkcja wyświetla formularz kontaktowy dla użytkownika.
 */
function PokazKontakt() {
    echo '
    <form method="POST" action="">
        <label for="temat">Temat:</label>
        <input type="text" name="temat" required>

        <label for="tresc">Treść wiadomości:</label>
        <textarea name="tresc" required></textarea>

        <label for="email">Twój email:</label>
        <input type="email" name="email" required>

        <input type="submit" name="wyslij" value="Wyślij wiadomość">
    </form>
    ';
}

/**
 * Formularz przypomnienia hasła
 *
 * Funkcja wyświetla formularz do przypomnienia hasła.
 */
function PokazPrzypomnienieHasla() {
    echo '
    <form method="POST" action="">
        <label for="email">Podaj swój email do przypomnienia hasła:</label>
        <input type="email" name="email" required>

        <input type="submit" name="przypomnij_haslo" value="Przypomnij hasło">
    </form>
    ';
}

/**
 * Funkcja wysyłania maila kontaktowego
 *
 * Funkcja sprawdza, czy wszystkie pola formularza są wypełnione, a następnie wysyła wiadomość email za pomocą PHPMailer.
 * Zabezpiecza dane przed wstrzyknięciem kodu i atakami typu XSS.
 */
function WyslijMailKontakt() {
    // Sprawdzanie, czy wszystkie pola zostały wypełnione
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo "Proszę wypełnić wszystkie pola.";
        PokazKontakt();
    } else {
        // Odbiorca wiadomości
        $odbiorca = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanityzacja emaila

        $mail = new PHPMailer(true);

        try {
            // Konfiguracja PHPMailera
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bosfos42@gmail.com';
            $mail->Password = 'glyv pnku qtev qgwj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Ustawienia nadawcy i odbiorcy
            $mail->setFrom('your-email@gmail.com', 'Formularz Kontaktowy');
            $mail->addAddress($odbiorca); // Dodanie odbiorcy

            // Treść wiadomości
            $mail->isHTML(true);
            $mail->Subject = htmlspecialchars($_POST['temat']); // Sanityzacja tematu
            $mail->Body    = htmlspecialchars($_POST['tresc']); // Sanityzacja treści

            // Wysyłanie wiadomości
            $mail->send();
            echo 'Wiadomość została wysłana.';
        } catch (Exception $e) {
            echo "Wystąpił błąd podczas wysyłania wiadomości. Error: {$mail->ErrorInfo}";
        }
    }
}

/**
 * Funkcja przypomnienia hasła
 *
 * Funkcja sprawdza, czy formularz przypomnienia hasła jest wypełniony, a następnie wysyła email z hasłem.
 * Zabezpiecza dane przed wstrzyknięciem kodu.
 */
function PrzypomnijHaslo($adminEmail) {
    // Sprawdzanie, czy pole email zostało wypełnione
    if (empty($_POST['email'])) {
        echo "Proszę podać swój email.";
    } else {
        // Wiadomość z przypomnieniem hasła
        $adminPassword = "adminpassword";
        $message = "Twoje hasło do panelu administracyjnego: " . $adminPassword;

        $mail = new PHPMailer(true);

        try {
            // Konfiguracja PHPMailera
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bosfos42@gmail.com';
            $mail->Password = 'glyv pnku qtev qgwj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Ustawienia nadawcy i odbiorcy
            $mail->setFrom('no-reply@domain.com', 'Przypomnienie Hasla');
            $mail->addAddress(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)); // Sanityzacja emaila

            // Treść wiadomości
            $mail->Subject = 'Przypomnienie hasła';
            $mail->Body    = $message;

            // Wysyłanie wiadomości
            $mail->send();
            echo 'Wiadomość z przypomnieniem hasła została wysłana.';
        } catch (Exception $e) {
            echo "Wystąpił błąd podczas wysyłania przypomnienia. Error: {$mail->ErrorInfo}";
        }
    }
}

// Obsługa formularzy po wysłaniu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdzanie, który formularz został wysłany
    if (isset($_POST['wyslij'])) {
        WyslijMailKontakt();
    } elseif (isset($_POST['przypomnij_haslo'])) {
        PrzypomnijHaslo('bosfos42@gmail.com');
    }
} else {
    // Wyświetlanie formularzy
    PokazKontakt();
    PokazPrzypomnienieHasla();
}

?>

