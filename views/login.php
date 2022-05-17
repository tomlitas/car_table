<?php

session_start();
$errors = [];
if(isset($_SESSION['login_errors'])){
    $errors = $_SESSION['login_errors'];
    $_SESSION['login_errors'] = [];
}

$locked = false;

if(isset($_SESSION['login_count'])){
    if($_SESSION['login_count']===3){
        $locked=true;
    }
} else {
    $_SESSION['login_count'] = 0;
}

include "../layout/header.php";
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-light mb-8">
                <div class="card-header">Log In</div>
                <div style="background-color: aqua;" class="card"><?php foreach($errors as $error){echo "<p>$error</p>";}?></div>
                <div class="card-body">
                    <form action="../script/login.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="your@email.com" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary" <?php if($locked){echo "disabled";} ?>>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







<?php
include "../layout/footer.php";
?>