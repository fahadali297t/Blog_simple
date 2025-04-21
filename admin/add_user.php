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
    <h3 class="mb-2 text-gray-800">Add User</h3>
    <div class="row">
        <div class="col-xl-6 col-lg-5">
            <div class=" p-4 mt-5">
                <form method="post" action="">
                    <h5 class="text-primary mt-3 font-weight-bold">Add New User</h5>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" required placeholder="User Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" maxlength="8" class="form-control" name="password" required placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <select name="role" class="form-select" required value=''>
                            <option value="">Please Select User Role</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary" name="add_user">Add</button>
                    <a href="./users.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<?php
include_once "./admin_footer.php";
if (isset($_POST['add_user'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, sha1($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $query = "SELECT * FROM users WHERE email = '{$email}' ";
    $result = mysqli_query($conn, $query);
    $data = mysqli_num_rows($result);
    if ($data) {
        // $userData = mysqli_fetch_assoc($result);
        // $user_arr = array($userData['user_id'], $userData['email'], $userData['roll']);
        // $_SESSION['user_arr'] = $user_arr;
        // header("Location:/admin/index.php");
        // $_SESSION['data'] = '';
        echo "
        <script> alert('User Already Exist') </script>
        ";
    } else {
        $query2 = "INSERT INTO users (user_id , email , password_hash , roll)
        VALUES (NULL , '$email' , '$password' , $role) ";
        if (mysqli_query($conn, $query2)) {
            echo "<script> alert('User Added Successfully') </script>";
            echo "<script>window.location.href = './users.php';</script>";
        } else {
            echo "<script> alert('Something Went Wrong') </script>";
        }
    }
}
?>