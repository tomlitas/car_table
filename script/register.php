<?php
session_start();
$_SESSION['reg_errors'] = [];
require_once("../connection.php");

if (!$_POST) {
    header("Location: ../views/register.php");
}

if(!(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])  && isset($_POST['password']) && isset($_POST['confPassword'])&& isset($_POST['license_date']))){
    echo "Something went wrong, please contact system admin";
}


$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$email = $_POST['email'];
$license_date = $_POST['license_date'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if (($firstName=="" || $lastName=="" || $email=="" || $password=="" || $confirmPassword==""|| $license_date=="")) {
    array_push($_SESSION['reg_errors'], "Please fill all fields!");
    
} 

if(strlen($firstName)>50){
    array_push($_SESSION['reg_errors'], "First Name is too long. MAX 50 symbols");
}

if(strlen($lastName)>50){
    array_push($_SESSION['reg_errors'], "Last Name is too long. MAX 50 symbols");
}

if(strlen($email)>50){
    array_push($_SESSION['reg_errors'], "Email is too long. MAX 50 symbols");
}

if(strlen($license_date)>10){
    array_push($_SESSION['reg_errors'], "License date is too long.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($_SESSION['reg_errors'], "Email format is invalid");
}

if($password==$confirmPassword){
    $password = password_hash($password, PASSWORD_BCRYPT);
} else {
    array_push($_SESSION['reg_errors'], "Passwords do not match!");
}

if(!empty($_SESSION['reg_errors'])){
    header("Location: ../views/register.php");
    die;
}

try {
    $sql = "INSERT INTO owner (first_name, last_name, email, driving_license_date, password) VALUES ('$firstName', '$lastName', '$email','$license_date', '$password')";
    $query = $conn->prepare($sql);
    $query->execute();
    header("Location: ../views/login.php");
} catch (PDOException $e) {
    echo "Insert failed: " . $e->getMessage();
}
