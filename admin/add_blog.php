<?php
include_once "./admin_header.php";
include_once "./includes/dbconnect.php";

if (isset($_SESSION['user_arr'])) {
    $user_id = $_SESSION['user_arr'][0];
}

?>
<!-- Begin Page Content -->
<div class="container">
    <!-- Page Heading -->
    <h3 class="mb-2 text-gray-800">Blogs</h3>
    <div class="row">
        <div class="col-xl-7 col-lg-5">
            <div class=" p-4 mt-5">
                <form method="post" action="" enctype="multipart/form-data">
                    <h5 class="text-primary mt-3 font-weight-bold">Publish a new blog</h5>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="blog_title" required placeholder="Blog Title">
                    </div>
                    <div class="mb-3">
                        <textarea name="blog_body" required class="form-control" placeholder="body" rows="2" id="blog_body"></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" required type="file" name="blog_img">
                    </div>
                    <div class="mb-3">
                        <select name="category_select" class="form-control" required>
                            <option value="">Select a Category</option>
                            <?php
                            $select_cat = "SELECT * FROM categories";
                            $run_query = mysqli_query($conn, $select_cat);
                            $row = mysqli_num_rows($run_query);
                            if ($row) {
                                while ($result = mysqli_fetch_assoc($run_query)) {
                                    $cat_name = $result['cat_name'];
                                    $cat_id = $result['cat_id'];
                                    echo "<option value='$cat_id'>$cat_name</option>";
                                }
                            } else {
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" name="add_blog">Publish</button>
                    <a href="./index.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<?php
include_once "./admin_footer.php";
if (isset($_POST['add_blog'])) {
    $title = mysqli_real_escape_string($conn, $_POST['blog_title']);
    $body = mysqli_real_escape_string($conn, $_POST['blog_body']);
    $category = mysqli_real_escape_string($conn, $_POST['category_select']);
    $filename = $_FILES["blog_img"]['name'];
    $tmp_name = $_FILES['blog_img']['tmp_name'];
    $size = $_FILES['blog_img']['size'];
    $image_ext = strtolower(trim(pathinfo($filename, PATHINFO_EXTENSION)));
    $allow_type = ['jpg', 'png', 'jpeg'];
    $destination = "../assets/images/" . $filename;
    if (in_array($image_ext, $allow_type)) {
        if ($size <= 2000000) {
            move_uploaded_file($tmp_name, $destination);
            $insert_blog = "INSERT INTO blog(blog_id , blog_title , blog_body , blog_image , category , author_id) VALUES(NULL , '$title' , '$body' , '$filename' , {$category} , '$user_id'  )";
            $run_insert_blog = mysqli_query($conn, $insert_blog);
            if ($run_insert_blog) {
                echo "Blog Added SuccessFully";
            }
        } else {
            echo "File Size must not be more than 2MB";
        }
    } else {

        echo "Only jpg , png and jpeg type allowed";
    }
}

?>