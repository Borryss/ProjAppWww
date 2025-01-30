<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty z koszykiem</title>
    <link rel="stylesheet" href="css/CSS.css">
    <style>
        .cart-container {
            display: none;
            margin-top: 20px;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .cart-table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Lista Produktów</h1>

    <button id="toggle-cart" class="btn_koncz" style=" margin-left: 92%; margin-bottom: 50px; margin-top: 10px;">Koszyk</button>
    <div class="cart-container" id="cart-container" style="<?= isset($_GET['show_cart']) && $_GET['show_cart'] == 1 ? 'display: block;' : 'display: none;' ?>">

        <h2 >Twój koszyk</h2>
        <?php
        session_start();
        include('cfg.php');

        // Funkcja wyświetlająca koszyk
        function showCart($conn) {
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo '<p style=" margin-left: 40px; margin-bottom: 40px; margin-top: 20px;">Koszyk jest pusty</p>';
                return;
            }

            echo '<table border="1" cellpadding="6" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
            echo '<tr>
                <th>ID produktu</th>
                <th>Nazwa</th>
                <th>Ilość</th>
                <th>Cena netto za sztuke</th>
                <th>Podatek VAT</th>
                <th>Cena brutto za wszystko</th>
                <th>Akcje</th>
              </tr>';

            $total = 0;

            foreach ($_SESSION['cart'] as $key => $item) {
                $query = "SELECT * FROM produkty WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $item['id_prod']);
                $stmt->execute();
                $result = $stmt->get_result();
                $product = $result->fetch_assoc();

                if ($product) {
                    $cena_netto = $product['cena_netto'];
                    $vat = $product['podatek_vat'];
                    $cena_brutto = $cena_netto + ($cena_netto * $vat / 100);
                    $subtotal = $cena_brutto * $item['ile_sztuk'];

                    echo '<tr>';
                    echo '<td style=" text-align: center;">' . $item['id_prod'] . '</td>';
                    echo '<td style=" text-align: center;">' . htmlspecialchars($product['tytul']) . '</td>';
                    echo '<td>
                            <form class="form_2" method="post" style=" text-align: center;" action="product.php?action=update&key=' . $key . '">
                                <input type="number" name="nowa_ilosc" value="' . $item['ile_sztuk'] . '" min="1" style="width: 50px;">
                                <button class="btn_koncz" type="submit">Zmień</button>
                            </form>
                          </td>';
                    echo '<td style=" text-align: center;">' . number_format($cena_netto, 2) . ' PLN</td>';
                    echo '<td style=" text-align: center;">' . $vat . '%</td>';
                    echo '<td style=" text-align: center;">' . number_format($subtotal, 2) . ' PLN</td>';
                    echo '<td style=" text-align: center; "><a style="  color: #fd0202;" href="product.php?action=remove&key=' . $key . '">Usuń</a></td>';
                    echo '</tr>';

                    $total += $subtotal;
                }
            }

            echo '</table>';
            echo '<p>Łączna wartość produktów: <strong>' . number_format($total, 2) . ' PLN</strong></p>';
        }

        // Obsługa akcji koszyka
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'add':
                    if (isset($_POST['id_prod'], $_POST['ile_sztuk'])) {
                        $id_prod = (int)$_POST['id_prod'];
                        $ile_sztuk = (int)$_POST['ile_sztuk'];

                        // Sprawdź, czy produkt istnieje w bazie
                        $query = "SELECT * FROM produkty WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id_prod);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $product = $result->fetch_assoc();
                            if ($ile_sztuk <= $product['sztuk_w_magazynie']) {
                                // Zmniejsz ilość w magazynie
                                $update_query = "UPDATE produkty SET sztuk_w_magazynie = sztuk_w_magazynie - ? WHERE id = ?";
                                $update_stmt = $conn->prepare($update_query);
                                $update_stmt->bind_param("ii", $ile_sztuk, $id_prod);
                                $update_stmt->execute();

                                // Dodaj do koszyka
                                $_SESSION['cart'][] = [
                                    'id_prod' => $id_prod,
                                    'ile_sztuk' => $ile_sztuk
                                ];
                            } else {
                                echo '<p style="color: red;">Brak wystarczającej ilości produktu w magazynie.</p>';
                            }
                        } else {
                            echo '<p style="color: red;">Produkt nie istnieje.</p>';
                        }

                    }
                    break;

                case 'update':
                    if (isset($_GET['key'], $_POST['nowa_ilosc'])) {
                        $key = (int)$_GET['key'];
                        $nowa_ilosc = (int)$_POST['nowa_ilosc'];

                        if (isset($_SESSION['cart'][$key])) {
                            $id_prod = $_SESSION['cart'][$key]['id_prod'];
                            $stara_ilosc = $_SESSION['cart'][$key]['ile_sztuk'];

                            // Zaktualizuj ilość w magazynie
                            $roznica = $nowa_ilosc - $stara_ilosc;
                            $update_query = "UPDATE produkty SET sztuk_w_magazynie = sztuk_w_magazynie - ? WHERE id = ?";
                            $update_stmt = $conn->prepare($update_query);
                            $update_stmt->bind_param("ii", $roznica, $id_prod);
                            $update_stmt->execute();

                            // Zaktualizuj ilość w koszyku
                            $_SESSION['cart'][$key]['ile_sztuk'] = $nowa_ilosc;
                            header('Location: product.php?show_cart=1');
                            exit;
                        }
                    }
                    break;

                case 'remove':
                    if (isset($_GET['key'])) {
                        $key = (int)$_GET['key'];
                        if (isset($_SESSION['cart'][$key])) {
                            $id_prod = $_SESSION['cart'][$key]['id_prod'];
                            $ilosc = $_SESSION['cart'][$key]['ile_sztuk'];

                            // Przywróć ilość do magazynu
                            $update_query = "UPDATE produkty SET sztuk_w_magazynie = sztuk_w_magazynie + ? WHERE id = ?";
                            $update_stmt = $conn->prepare($update_query);
                            $update_stmt->bind_param("ii", $ilosc, $id_prod);
                            $update_stmt->execute();

                            // Usuń z koszyka
                            unset($_SESSION['cart'][$key]);
                            header('Location: product.php?show_cart=1');
                            exit;
                        }
                    }

                    break;
            }
        }

        // Wyświetl koszyk
        showCart($conn);
        ?>
    </div>

    <?php
    // Wyświetl produkty
    $query = "SELECT id, tytul, cena_netto, zdjecie, sztuk_w_magazynie FROM produkty";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<div style="display: flex; flex-wrap: wrap; gap: 40px; margin-left: 40px;">';
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = htmlspecialchars($row['tytul']);
            $price = number_format($row['cena_netto'], 2);
            $image = "admin/" . htmlspecialchars($row['zdjecie']);
            $sztuk_w_magazynie = number_format($row['sztuk_w_magazynie'], 0);

            echo '<div class="product-item" style="border: 1px solid #000000; padding: 10px; width: 200px; text-align: center;">';
            echo '<img src="' . $image . '" alt="' . $title . '" style="max-width: 100%; height: auto;">';
            echo '<h3>' . $title . '</h3>';
            echo '<h3>Ilośc produktu w magazynie:' . $sztuk_w_magazynie . '</h3>';
            echo '<p>Cena: ' . $price . ' PLN</p>';
            if ($sztuk_w_magazynie > 0) {
            echo '<form class="form_3" method="post" action="product.php?action=add" style="margin-top: 10px;">';
            echo '<input type="hidden" name="id_prod" value="' . $id . '">';
            echo '<label for="ile_sztuk_' . $id . '">Ilość:</label>';
            echo '<input type="number" name="ile_sztuk" id="ile_sztuk_' . $id . '" value="1" min="1" style="width: 60px;">';
            echo '<br>';
            echo '<button class="btn_koncz" style="margin-top: 20px" type="submit">Dodaj do koszyka</button>';
            echo '</form>';
            }
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Brak produktów w bazie danych.</p>';
    }
    ?>

    <script>
        document.getElementById('toggle-cart').addEventListener('click', function () {
            const cartContainer = document.getElementById('cart-container');
            if (cartContainer.style.display === 'none' || cartContainer.style.display === '') {
                cartContainer.style.display = 'block';
            } else {
                cartContainer.style.display = 'none';
            }
        });
    </script>
</body>
</html>
