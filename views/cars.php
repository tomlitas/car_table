<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
include '../layout/header.php';
require_once("../connection.php");
$userid = $_SESSION['userid'];
if ($_GET) {
    $_SESSION['car_user_id'] = $_GET['userid'];
}
$car_user_id = $_SESSION['car_user_id'];
try {
    $sql = "SELECT * FROM  car  WHERE owener_id='$car_user_id'";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
} catch (PDOException $e) {
    echo "Select failed: " . $e->getMessage();
}

?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">
                    Hello,
                    <!-- <?php echo $_SESSION['username']; ?> -->
                </div>
                <?php if ($_SESSION['userid'] == $car_user_id) { ?>
                    <div class="card-footer text-muted">
                        <div class="container py-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card bg-light mb-8">
                                        <div class="card-header">Upload a car model</div>
                                        <div class="card-body">
                                            <form action="../script/car_upload.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Brand" name="brand">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Model" name="model">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Color" name="color">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Registration number" name="registr_num">
                                                </div>
                                                <input type='hidden' name='userid' value="<?= $userid ?>">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="card-body">
                    <h5 class="card-title">Owner cars</h5>
                    <table class="table table-striped">
                        <tr>

                            <th>Brand</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Registration number</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <?php if ($_SESSION['userid'] == $car_user_id) { ?>
                                <th>Action</th>
                            <?php } ?>

                        </tr>
                        <?php
                        foreach ($result as $user) {
                            echo "<tr><td>" . $user['brand'] . "</td><td>" . $user['model'] . "</td><td>" . $user['color'] . "</td><td>" . $user['registr_num'] . "</td><td>" . $user['created'] . "</td><td>" . $user['updated'] . "</td>" ?><?php if ($_SESSION['userid'] == $car_user_id) { ?> <td> <?php } ?>
                    <?php
                            if ($_SESSION['userid'] == $car_user_id) {
                                echo "<a class='btn btn-warning m-1' href='car_edit.php?userid=" . $user['id'] . "'>Edit</a>" . "<a class='btn btn-danger' href='../script/car_delete.php?userid=" . $user['id'] . "'>Delete</a>" . "</td></tr>";
                            }
                        }

                    ?>
                    </table>
                </div>
                <div class="card-footer text-muted">

                </div>
            </div>
        </div>


    </div>
</div>