<?php 
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
}
require_once '../connection.php';

if($_POST){
    try {
        $userid = $_POST['carid'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $color = $_POST['color'];
        $registr_num = $_POST['registr_num'];
        $update = $_POST['update'];

        $sql = "UPDATE car SET brand = '$brand', model = '$model', color = '$color',registr_num = '$registr_num', updated = '$update'  WHERE id='$userid'";
        $query = $conn->prepare($sql);
        $result = $query->execute();
        if($result){
            header("Location: ../views/cars.php");
        }

    } catch(PDOException $e) {
        echo "Update failed: ". $e->getMessage();
    }
} else {
    header("Location: ../");
}
