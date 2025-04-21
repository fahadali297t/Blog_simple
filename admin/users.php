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
<div class="container-fluid">
    <!-- Page Heading -->
    <h5 class="mb-2 text-gray-800">Users</h5>
    <!-- DataTales Example -->
    <div class="shadow">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <a href="./add_user.php">
                    <h6 class="font-weight-bold text-primary mt-2">Add New</h6>
                </a>
            </div>
            <div>
                <form class="navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-white border-0 small" placeholder="Search for...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button"> <i class="fas fa-search fa-sm"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>

                            <th>User Email</th>
                            <th>Roll</th>

                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_query = "SELECT * FROM users";
                        $run_select = mysqli_query($conn, $select_query);
                        $data = mysqli_num_rows($run_select);

                        if ($data) {
                            $sr = 1;
                            while ($result  = mysqli_fetch_assoc($run_select)) {
                                $roll = $result['roll'];
                                $roll_name = "";
                                if ($roll == 1) {
                                    $roll_name = "Admin";
                                } else {
                                    $roll_name = "User";
                                }
                                echo "                        <tr>
                            <td>$sr</td>
                            <td>$result[email]</td>
                            <td>
                                $roll_name
                            </td>
                            <td>
                               <div class='d-flex justify-content-center align-items-center gap-4'>
                                    <form action='' method='post' onsubmit='return confirm(` Are You Sure you want to delete this record?`)'>
                                    <button class='btn btn-danger' value='$result[user_id]' name='delbtn' type='submit'><i class='fa-solid fa-trash'></i></button>

                                    </form>


                                <form action='edit_user.php' method='post' onsubmit='return confirm(` Are You Sure you want to edit this record?`)'>
                                    <button class='btn btn-success' value='$result[user_id]' name='editbtn' type='submit'><i class='fa-solid fa-pen-to-square'></i></button>

                                </form>
                                </div>
                            </td>
                        </tr>";
                                ++$sr;
                            }
                        } else {
                            echo "<tr>
                                <td colspan ='4'>No Record Found</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<?php
include_once "./admin_footer.php";
if (isset($_POST['delbtn'])) {
    $id = $_POST['delbtn'];
    $del_query = "DELETE FROM users WHERE user_id = {$id}";
    $del_query_run = mysqli_query($conn, $del_query);
    if ($del_query_run) {
        echo "Success";
        echo "<script>window.location.href = './users.php';</script>";
        exit();
    } else {
        echo "Failed";
    }
}

?>