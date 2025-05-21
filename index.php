<?php
include_once "./includes/dbconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>APEXVIM - Blog</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <link rel="stylesheet" href="./assets/style/style.css" />

</head>

<body style="background-color:#ECFAE5">
  <!--  -->
  <?php
  include_once "./includes/navbar.php"
  ?>
  <!-- main Blog lists -->
  <div class="container mt-5 mb-5">
    <div class="row gx-4 gy-4">
      <!--  -->
      <?php
      $select_query = "SELECT * FROM blog";
      $run_query = mysqli_query($conn, $select_query);
      $rows = mysqli_num_rows($run_query);
      if ($rows) {
        while ($result  = mysqli_fetch_assoc($run_query)) {
      ?>
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <img
                src="./assets/images/<?php echo $result['blog_image'] ?>"
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
                <a href="./blog1.html">
                  <h5 class="card-title mt-3">
                    <?php
                    echo  $result['blog_title'];
                    ?> </h5>
                </a>
                <div class="card-text">
                  <?php
                  echo  $result['blog_body'];
                  ?>
                </div>
                <form action="blog_details.php" method="post">
                  <input type="hidden" name="blog_id" value=" <?php
                                                              echo  $result['blog_id'];
                                                              ?> ">
                  <button type="submit" name="read_more" class="btn button btn-primary mt-3">Read More</button>
                </form>
              </div>
            </div>
          </div>
      <?php
        }
      }

      ?>


    </div>
  </div>
  <!--  -->

  <!-- bootstrap script -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>