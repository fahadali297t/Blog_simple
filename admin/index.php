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
   <h5 class="mb-2 text-gray-800">Blog Posts</h5>
   <!-- DataTales Example -->
   <div class=" shadow">
      <div class="card-header py-3 d-flex justify-content-between">
         <div>
            <a href="./add_blog.php">
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
         <?php
         include_once "./includes/navbar.php"
         ?>
         <!-- main Blog lists -->
         <div class="container mt-5 mb-5">
            <div class="row gx-4 gy-4">
               <!--  -->
               <?php
               $select_query = "SELECT * FROM blog WHERE author_id = {$user_id}";
               $run_query = mysqli_query($conn, $select_query);
               $rows = mysqli_num_rows($run_query);
               if ($rows) {
                  while ($result  = mysqli_fetch_assoc($run_query)) {
               ?>
                     <div class="col-md-6 col-lg-4">
                        <div class="card">
                           <img
                              src="../assets/images/<?php echo $result['blog_image'] ?>"
                              class="card-img-top"
                              alt="..." />
                           <div class="card-body">
                              <div class="top mt-2">
                                 <a href="#"><i class="fa-solid fa-calendar-days color-primary"></i>
                                    &nbsp; <?php
                                             echo  $result['publish_date'];
                                             ?>
                                 </a>
                                 <a href="#"><i class="fa-solid fa-calendar-days color-primary"></i>
                                    &nbsp; <?php
                                             echo  $result['category'];
                                             ?>
                                 </a>
                                 <a href="#"><i class="fa-solid fa-user color-primary"></i> &nbsp;
                                    <?php
                                    echo  $result['author_id'];
                                    ?></a>
                              </div>
                              <h1>
                                 <h5 class="card-title mt-3">
                                    <?php
                                    echo  $result['blog_title'];
                                    ?> </h5>
                              </h1>
                              <div class="card-text">
                                 <?php
                                 echo  $result['blog_body'];
                                 ?>
                              </div>
                              <form action="../blog_details.php" method="post">
                                 <input type="hidden" name="blog_id" value=" <?php
                                                                              echo  $result['blog_id'];
                                                                              ?> ">

                                 <button type="submit" name="read_more" class="btn button btn-primary mt-3">Read More</button>
                              </form>
                              <div class="edit">
                                 <form action="./edit_blog.php" method="post">
                                    <input type="hidden" name="blog_id" value=" <?php
                                                                                 echo  $result['blog_id'];
                                                                                 ?> ">
                                    <button type="submit" name="edit_blog" class="btn btn-primary btn-success shadow"><i class="fa-solid fa-pen"></i></button>
                                 </form>
                              </div>
                              <div class="delete">
                                 <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                                    <input type="hidden" name="blog_id" value=" <?php
                                                                                 echo  $result['blog_id'];
                                                                                 ?> ">

                                    <button type="submit" name="del_blog" class="btn btn-primary btn-danger shadow"><i class="fa-solid fa-trash"></i></button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
               <?php
                  }
               } else {
                  echo "<p class ='text-center text-danger'>You don't have any blog.</p>";
               }

               ?>


            </div>
         </div>
         <!--  -->
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<?php
include_once "./admin_footer.php";
if (isset($_POST['del_blog'])) {
   $blog_id = $_POST['blog_id'];

   $dell_query = "DELETE FROM blog WHERE blog_id = '{$blog_id}'";
   $run_del_query = mysqli_query($conn, $dell_query);
   if ($run_del_query) {
      header("Location:/index.php");
   } else {
      echo "Something went wrong";
   }
}
?>