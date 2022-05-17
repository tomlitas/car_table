<?php 
session_start();
$_SESSION['login_errors'] = [];
require_once("../connection.php");

try{
    $sql="SELECT * FROM owner";
    $query=$conn->prepare($sql);
    $query->execute();
    $users=$query->fetchAll();
} catch (PDOException $e){
    echo "Select for users failed: ". $e->getMessage();
}

if(!$_POST){
    header("Location: ../views/login.php");
}

if(!isset($_POST['email']) || !isset($_POST['password'])){
    echo "Something went wrong, please contact you admin!";
}


$email = $_POST['email'];
$password = $_POST['password'];


if($email==""){
    array_push($_SESSION['login_errors'], "Please enter your email");
}

if($password==""){
    array_push($_SESSION['login_errors'], "Please enter your password");
}

$email_exists = 0;
foreach ($users as $user){
   if(array_search($email, $user)){
       $email_exists +=1;
   }
}

if($email_exists===0){
    array_push($_SESSION['login_errors'], "Email does not exist");
}

foreach ($users as $user){
    if($user['email']==$email){
        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['first_name'];
            $_SESSION['user_id'] = $user['id'];
            //header("Location: ../views/owner.php");
            //die;
        } else {
            $_SESSION['login_count'] += 1;
            if($_SESSION['login_count'] === 3) {
                array_push($_SESSION['login_errors'], "Login locked");
            } else {
                array_push($_SESSION['login_errors'], "Please check your password");
            }
            
        }

    }
}

try {
    $sql ="SELECT * FROM owner WHERE email='$email'";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetch();
} catch (PDOException $e){
    echo "Select failed: ". $e->getMessage();
}

if ($result){
    $dbPasswordHash = $result['password'];
    if(password_verify($password, $dbPasswordHash)){
        $_SESSION['userid'] = $result['id'];
        // echo "Login successful";
        header("Location: ../views/owner.php");
    } else {
        echo "Password is incorrect";
    }
} else {
    echo "Email does not exist";
}

if(!empty($_SESSION['login_errors'])){
    header("Location: ../views/login.php");
}
