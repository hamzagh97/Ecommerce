

<?php 
session_start();
if (isset($_SESSION['Username'])) {

  header('location: dashboard.php');
};

$pagetitle = 'Login';
$noNavbar = "";

include "init.php";

  $loginErr ="";

  if (isset($_POST["login"])) {
    $name = $_POST["name"];
    $pass =  $_POST["pass"];
    $result = $conn->prepare("SELECT * FROM users WHERE Username='$name' AND Pass='$pass' AND GroupID=1 LIMIT 1");
    $result->execute();
    $row  = $result->fetch();
    $count = $result->rowCount();
    if ($count > 0) {
        $_SESSION['Username'] = $name;
        $_SESSION['Id'] = $row['Id'];
        $_SESSION['Pass'] = $row['Pass'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['FullName'] = $row['FullName'];
        header('location: dashboard.php');
        exit();
    } else {
        header("location:index.php?error=not_a_member");
    };

    if  (isset($_GET['error'])) {
    if ($_GET['error'] == "not_a_member") {
    $loginErr = "you are not registred";
    };
  };
  };

?>

<div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" class="login" method="post">
      <div class="form-group">
        <h1 class="text-center login">Login</h1>
        <input class="form-control login" type="text" name="name" placeholder="Type Your Name">
        <input class="form-control login" type="password" name="pass" placeholder="Type Your Password">
        <span class="error"><?php echo $loginErr; ?></span>
        <input class="btn btn-success btn-block" type="submit" name="login">
      </div>
    </form>
  </div>


  <?php include 'includes/templates/footer.php';