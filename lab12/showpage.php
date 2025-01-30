<?php
include('cfg.php');

$idp = isset($_GET['idp']) ? $_GET['idp'] : 'glowna';
$idp = $conn->real_escape_string($idp);

$sql = "SELECT page_content FROM page_list WHERE page_title = '$idp' AND status = 1 LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['page_content'];
} else {
    echo "Page not found.";
}
?>