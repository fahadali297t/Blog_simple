<?php
session_start();
include_once "./includes/dbconnect.php";

if (isset($_SESSION['user_arr'])) {
    $user_id = $_SESSION['user_arr'][0];
    $user_role = $_SESSION['user_arr'][2];

    if ($user_role == 2) {
        header("Location:/admin/userDashboard.php");
        exit();
    }
}

include_once "./admin_header.php";
?>
<?php


$id = null;
$result = [];

if (isset($_POST['editbtn'])) {
    $id = $_POST['editbtn'];
    $select_query = "SELECT * FROM categories WHERE cat_id = {$id}";
    $query_run = mysqli_query($conn, $select_query);
    $result = mysqli_fetch_assoc($query_run);
}


?>


<!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <h3 class="mb-2 text-gray-800">Edit Categories</h3>
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class="card p-4 mt-5">
                <form method="post" action="">
                    <h5 class="text-primary mt-3 font-weight-bold">Edit Category</h5>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="cat_name" required placeholder="Category Name"
                            value="<?php echo isset($result['cat_name']) ? $result['cat_name'] : ''; ?>">
                        <input type="hidden" name="cat_id" value="<?php echo isset($result['cat_id']) ? $result['cat_id'] : ''; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary" name="edit_cat">Edit</button>
                    <a href="./categories.php" class="btn btn-secondary">Back</a>
                </form>

            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<?php include_once "./admin_footer.php" ?>

<?php
if (isset($_POST['edit_cat'])) {
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $cat_id = (int) $_POST['cat_id']; // hidden input

    $update_query = "UPDATE categories SET cat_name = '$cat_name' WHERE cat_id = $cat_id";
    $run_update = mysqli_query($conn, $update_query);

    if ($run_update) {
        echo "Hello";
        header("Location:/categories.php");
        exit();
    } else {
        echo "Something went wrong: " . mysqli_error($conn);
    }
}
?>