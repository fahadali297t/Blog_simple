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
<!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <h3 class="mb-2 text-gray-800">Add Categories</h3>
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class=" p-4 mt-5">
                <form method="post" action="">
                    <h5 class="text-primary mt-3 font-weight-bold">Add New Category</h5>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="cat_name" required placeholder="Category Name">
                    </div>


                    <button type="submit" class="btn btn-primary" name="cat_btn">Add</button>
                    <a href="./categories.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<?php
include_once "./admin_footer.php";

if (isset($_POST['cat_btn'])) {
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $select_query = "SELECT * FROM categories WHERE cat_name = '{$cat_name}'";
    $run_select_query = mysqli_query($conn, $select_query);
    $select_result = mysqli_num_rows($run_select_query);
    if ($select_result) {

        echo "
             <script>
                alert('Category already existed')
            </script>
            ";
    } else {
        $insert_query = "INSERT INTO categories (cat_name) VALUES ('$cat_name')";
        $run_insert_query = mysqli_query($conn, $insert_query);
        if ($run_insert_query) {
            # code...
            echo "
            <script>
                alert('Category Added Successfully')
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Some Thing Went Wrong')
            </script>
            ";
        }
    }
}
?>