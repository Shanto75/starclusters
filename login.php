<?php
$alert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    include "./db.php";
    $sql = "Select * from admin where email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      while( $row = mysqli_fetch_assoc($result)){

          if ( $pass === $row['password']) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['adminEmail'] = $email;
            header("location: admin.php");
          } else {
            $alert = "Invalid Email or Password.";
          }
      }

    } else {
      $alert = "Invalid Email or Password.";
    }
}
?>
<?php include "./admin-header.php"; include "./error-alert.php"; ?>

<div class="container p-5 ">
    <form action="login.php" method="post">
        <div class="col-lg-6 p-5 bg-dark mx-auto text-white rounded-3">
            <h1 class="text-center text-white">Admin LogIn</h1>
            <hr>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-5">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
            </div>
            <div class="d-flex align-items-center justify-content-center ">
                <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php include "./admin-footer.php" ?>