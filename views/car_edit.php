<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
require_once '../connection.php';
include '../layout/header.php';

if ($_GET) {
    try {
        $userid = $_GET['userid'];
        $sql = "SELECT * FROM car WHERE id='$userid'";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch();
    } catch (PDOException $e) {
        echo "Selelct failed: " . $e->getMessage();
    }
}



?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-light mb-8">
                <div class="card-header">Car Edit</div>
                <div class="card-body">
                    <form action="../script/car_edit.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Brand" name="brand" value="<?php echo $result['brand']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Model" name="model" value="<?php echo $result['model']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Color" name="color" value="<?php echo $result['color']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Registration number" name="registr_num" value="<?php echo $result['registr_num']; ?>">
                        </div>
                        <input type="hidden" name="update" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <input type="hidden" name="carid" value="<?php echo $result['id']; ?>">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include '../layout/footer.php' ?>