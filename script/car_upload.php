<?php

require_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $color = $_POST['color'];
    $registr_num = $_POST['registr_num'];
    $userid = $_POST['userid'];
} else {
    header("Location: ../views/login.php");
    die;
}

try {
    $sql = "INSERT INTO car (brand, model, color, registr_num,owener_id) VALUES ('$brand', '$model', '$color','$registr_num','$userid')";
    $query = $conn->prepare($sql);
    $query->execute();
    header("Location: ../views/cars.php");
} catch (PDOException $e) {
    echo "Insert failed: " . $e->getMessage();
}
