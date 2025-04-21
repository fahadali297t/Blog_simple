<?php
include_once "./includes/dbconnect.php";
session_start();
if (isset($_SESSION['user_arr'])) {
  header("Location:admin/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap demo</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
    crossorigin="anonymous" />
</head>

<body>
  <section class="vh-100" style="background-color: #9a616d">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img
                  src="./assets/images/loginImage.jpg"
                  alt="login form"
                  class="img-fluid"
                  style="border-radius: 1rem 0 0 1rem" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="post" action="">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i
                        class="fas fa-book fa-2x me-3"
                        style="color: #ff6219"></i>
                      <span class="h1 fw-bold mb-0">Blog Web</span>
                    </div>

                    <h5
                      class="fw-normal mb-2 pb-3"
                      style="letter-spacing: 1px ; color: rgba(0,0,0,0.6)">
                      Sign into your account
                    </h5>

                    <div class="form-outline mb-4">
                      <input
                        type="email" placeholder="Email" required id="typeEmailX-2" name="email" class="form-control" />
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="password" id="typePasswordX-2" required maxlength="8" name="password" placeholder="Password" class="form-control" />
                    </div>
                    <?php
                    if (isset($_SESSION['error'])) {
                      $error = $_SESSION['error'];
                      echo "<p style='color:red'> $error </p>";
                      unset($_SESSION['error']);
                    }
                    ?>

                    <div class="pt-1 mb-4">
                      <button

                        class="btn btn-dark btn-lg btn-block"
                        name="login-btn" type="submit">
                        Login
                      </button>
                    </div>

                    <p class="mb-5 pb-lg-2" style="color: #393f81">
                      Don't have an account?
                      <a href="./register.php" style="color: #393f81">Register here</a>
                    </p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Js Files -->
  <script src="https://kit.fontawesome.com/0e26b3244d.js" crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST['login-btn'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password =  mysqli_real_escape_string($conn, sha1($_POST['password']));
  // $query = "INSERT INTO users (user_id , email , password_hash , roll)
  // VALUES (NULL , '$email' , '$password' , 1)
  // ";
  // if (mysqli_query($conn, $query)) {
  //     echo "Record Saved Success";
  // } else {
  //     echo "Record Not Saved";
  // }
  $query = "SELECT * FROM users WHERE email = '{$email}' AND password_hash = '{$password}' ";
  $result = mysqli_query($conn, $query);
  $data = mysqli_num_rows($result);
  if ($data) {
    $userData = mysqli_fetch_assoc($result);
    $user_arr = array($userData['user_id'], $userData['email'], $userData['roll']);
    $_SESSION['user_arr'] = $user_arr;
    header("Location:/admin/index.php");
    $_SESSION['data'] = '';
  } else {
    $_SESSION['error'] = "Invalid Email/Password";
    header("Location:login.php");
  }
}

?>