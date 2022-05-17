<?php 
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
}
require_once '../connection.php';

if($_POST){
    try {
        $userid = $_POST['userid'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email = $_POST['email'];
        $driv_licen = $_POST['driv_licen'];
        $update = $_POST['update'];
        echo $update;

        $sql = "UPDATE owner SET first_name = '$firstName', last_name = '$lastName', email = '$email', updated = '$update'  WHERE id='$userid'";
        $query = $conn->prepare($sql);
        $result = $query->execute();
        if($result){
            header("Location: ../views/owner.php");
        }

    } catch(PDOException $e) {
        echo "Update failed: ". $e->getMessage();
    }
} else {
    header("Location: ../");
}
