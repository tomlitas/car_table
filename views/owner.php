<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
include '../layout/header.php';
require_once("../connection.php");


try {
    $sql = "SELECT * FROM  owner ";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
} catch (PDOException $e) {
    echo "Select failed: " . $e->getMessage();
}

$userid = $_SESSION['userid'];

?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">
                    Hello,
                    <!-- <?php echo $_SESSION['username']; ?> -->
                </div>
                <div class="card-body">
                    <h5 class="card-title">Owners</h5>
                    <table class="table table-striped">
                        <tr>

                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Driving license date</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach ($result as $user) {
                            echo "<tr><td>" . "<a href='./cars.php?userid=" . $user['id']."'>{$user['first_name']}</a>" . "</td><td>" . $user['last_name'] . "</td><td>" . $user['email'] . "</td><td>" . $user['driving_license_date'] . "</td><td>" . $user['created'] . "</td><td>" . $user['updated'] . "</td><td>";
                            if ($_SESSION['userid'] == $user['id']) {
                                echo "<a class='btn btn-warning m-1' href='owner_edit.php?userid=" . $user['id'] . "'>Edit</a>" . "<a class='btn btn-danger' href='../script/owner_delete.php?userid=" . $user['id'] . "'>Delete</a>" . "</td></tr>";
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
























<?php
include '../layout/footer.php';
?>