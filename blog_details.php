<?php
include_once "./includes/dbconnect.php";
if (isset($_POST['read_more'])) {
  $blog_id = $_POST['blog_id'];
  $author_id = $_POST['author_id'];
} else {
  header("Location:index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog-Web</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link
    rel="shortcut icon"
    href="./assets/images/favicon.png"
    type="image/x-icon" />
  <link rel="stylesheet" href="./assets/style/style.css" />
</head>

<body>
  <?php
  include_once "./includes/navbar.php";
  ?>
  <!--======================= main Blog post =============================== -->
  <?php
  $select_query = "SELECT * FROM blog WHERE blog_id = {$blog_id}";
  $run_query = mysqli_query($conn, $select_query);
  $rows = mysqli_num_rows($run_query);
  if ($rows) {
    $result  = mysqli_fetch_assoc($run_query);
  ?>
    <main class="container my-5">
      <div class="top_row row">
        <div class="col-md-12">
          <h1 class="mb-3"><?php echo $result['blog_title']; ?></h1>
          <p class="text-muted"><?php echo $result['publish_date']; ?> by <strong><?php echo $result['author_id']; ?></strong></p>
        </div>
      </div>
      <!-- whole blog post with sidebar container -->
      <div class="row">
        <!-- Blog Post -->
        <div class="col-12 blog_article">
          <article>
            <img
              src="./assets/images/<?php echo $result['blog_image']; ?>"
              alt="Blog Image"
              class="img-fluid rounded mb-4" />
            <!-- Blog Body -->
            <?php echo $result['blog_body']; ?>
          </article>
          <!-- Comments Section -->
          <section>
            <!-- Add a Comment Form -->
            <form class="mt-4 comment-form">
              <h2>Add a Comment</h2>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Your name" />
              </div>
              <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea
                  class="form-control"
                  id="comment"
                  rows="4"
                  placeholder="Your comment"></textarea>
              </div>
              <button type="submit" class="btn btn-primary button">
                Submit
              </button>
            </form>
          </section>
        </div>

        <!-- Sidebar -->

      </div>
    <?php
  } else {
    header("Location:index.php");
  }
    ?>
    <hr />


    </main>
    <!--======================== you may like posts========================== -->
    <div class="container mt-5 mb-5">
      <h1 class="text-center mb-4">YOU MIGHT ALSO LIKE</h1>
      <div class="row gx-4 gy-4">
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <img
              src="./assets/images/asset11.jpeg"
              class="card-img-top"
              alt="..." />
            <div class="card-body">
              <div class="top mt-2">
                <a href="#"><i class="fa-solid fa-calendar-days color-primary"></i>
                  &nbsp; December 06, 2024</a>
                <a href="#"><i class="fa-solid fa-user color-primary"></i> &nbsp;
                  Admin</a>
              </div>
              <h5 class="card-title mt-3">Understanding Design Briefs</h5>
              <p class="card-text">
                A design brief is a foundational document that outlines the core
                details of a design project, such as its goals, scope, and
                overall strategy.
              </p>
              <a href="#" class="btn button btn-primary">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <img
              src="./assets/images/asset12.jpeg"
              class="card-img-top"
              alt="..." />
            <div class="card-body">
              <div class="top mt-2">
                <a href="#"><i class="fa-solid fa-calendar-days color-primary"></i>
                  &nbsp; December 04, 2024</a>
                <a href="#"><i class="fa-solid fa-user color-primary"></i> &nbsp;
                  Admin</a>
              </div>
              <h5 class="card-title mt-3">
                Healthcare Software Development: A Complete Guide for 2025
              </h5>
              <p class="card-text">
                The global healthcare software market is anticipated to reach
                nearly $981.5 billion by 2032.
              </p>
              <a href="#" class="btn button btn-primary">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <img
              src="./assets/images/asset13.jpeg"
              class="card-img-top"
              alt="..." />
            <div class="card-body">
              <div class="top mt-2">
                <a href="#"><i class="fa-solid fa-calendar-days color-primary"></i>
                  &nbsp; December 02, 2024</a>
                <a href="#"><i class="fa-solid fa-user color-primary"></i> &nbsp;
                  Admin</a>
              </div>
              <h5 class="card-title mt-3">
                Best Practices for Accessible Web Design
              </h5>
              <p class="card-text">
                Web accessibility is the practice of designing and developing
                websites that are usable by everyone, including people with
                disabilities.
              </p>
              <a href="#" class="btn button btn-primary">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- =============================footer-section======================== -->

    <!-- =============================bootstrap script====================== -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>

</html>