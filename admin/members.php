<?php 
session_start();
if (isset($_SESSION['Username']) AND isset($_SESSION['Pass'])) {

  $pagetitle = 'Profile';
  include 'init.php';
  

  $do  ="";
  if  (isset($_GET['do']))  {
      $do = $_GET['do'];
  } else  {
      $do  =  'Manage';
  }
  if ($do  == 'manage') {
      echo '<div class="container">
              <div class="row" style="margin-top: 100px;">
                <div class="col-md-6 d-flex justify-content-center">
                <a href="members.php?do=edit"><img src="layout/images/member-page/edit-member.png" height=200></a>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                <a href="members.php?do=add"><img src="layout/images/member-page/add-member.png" height=200></a>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                <a href="members.php?do=delete"><img src="layout/images/member-page/delete-member.png" height=200></a>
                </div>
              </div>
            </div>';
  } elseif ($do == 'edit') {
    if ($Id = isset($_GET['userid']) && is_numeric($_GET['userid']) && intval($_GET['userid'])) {
      $stmt = $conn->prepare("SELECT * FROM users WHERE Id='$Id' LIMIT 1");
    $stmt->execute();
    $row  = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) { ?>
    <div class="container">
      <form class="form-horizontal member" action="?do=update" method="post">
        <div class="form-group">
          <h1 class="text-center member">edit profile</h1>
          <div class="form-group row hidden">
            <input class="form-control member" type="hidden" name="id" autocomplete="off" value="<?php echo $_SESSION['Id']?>">
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-lg-2 member">username :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="text" name="name" autocomplete="off" value="<?php echo $_SESSION['Username']?>" required="required">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-12 col-lg-2 member">pass :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="hidden" name="oldpass" value="<?php echo $row['Pass']?>">
              <input class="form-control member" type="password" name="newpass" autocomplete="new-password" value="<?php echo $_SESSION['Pass']?>" required="required" placeholder="type newpassword">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-12 col-lg-2 member">email :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="email" name="email" autocomplete="off" value="<?php echo $_SESSION['Email']?>" required="required">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-12 col-lg-2 member">fullname :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="text" name="fullname" autocomplete="off" value="<?php echo $_SESSION['FullName']?>" required="required">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-lg-1 offset-lg-2 btn-member">
              <input class="btn btn-success btn-block" value="Save" type="submit" name="save">
            </div>
          </div>
        </div>
      </form>
    </div>
      <?php } else {
          echo 'false id';
      } 
    
    }
    
    } elseif ($do == 'update') {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $Id = $_POST['id'];
        $Name = $_POST['name']; 
        $Email = $_POST['email'];
        $Fullname = $_POST['fullname'];

        $newpass = "";
        if (empty($_POST['newpass'])) {
          $newpass = $_POST['oldpass'];
          echo 'no new pass entered' . '<br>';        
        } else {
          $newpass = $_POST['newpass'];
        }


        $formErrors = array();
        if (empty($Id)) {
          $formErrors[] = "id cant be emty";
        }
        if (empty($Name)) {
          $formErrors[] = "name cant be emty";
        }
        if (strlen($Name) < 2) {
          $formErrors[] = "name cant be shorter than 2 caracters";
        }
        if (empty($newpass)) {
          $formErrors[] = "password cant be emty";
        };
        if (empty($Email)) {
          $formErrors[] = "Email cant be emty";
        }
        if (empty($Fullname)) {
          $formErrors[] = "Fullname cant be emty";
        }

        foreach ($formErrors as $error) {
          echo $error . '<br>';
        }
        

        if (empty($formErrors)) {
          $stmt = $conn->prepare("UPDATE users SET Username='$Name', Pass='$newpass', Email='$Email', FullName='$Fullname' WHERE Id='$Id'");
          $stmt->execute();
          $count = $stmt->rowCount();

          if ($count > 0) {
            echo '<div class="alert alert-success">' . $count . ' records updated</div><br>';
          }

          if ($count < 1) {
            echo '<div class="alert alert-danger">' . $count . ' records updated</div><br>';
          }
        }
    

      } else {
        echo 'u cant access this page';
      }

    } elseif ($do == 'add') { ?>
      <div class="container">
      <form class="form-horizontal member" action="?do=insert" method="post">
        <div class="form-group">
          <h1 class="text-center member">add new member</h1>
          <div class="form-group row">
            <label class="col-sm-12 col-lg-2 member">username :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="text" name="zname" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-12 col-lg-2 member">pass :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="password" name="zpass" autocomplete="new-password" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-12 col-lg-2 member">email :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="email" name="zemail" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-12 col-lg-2 member">fullname :</label>
            <div class="col-md-12 col-lg-10">
              <input class="form-control member" type="text" name="zfullname" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-lg-1 offset-lg-2 btn-member">
              <input class="btn btn-success btn-block" value="Save" type="submit" name="save">
            </div>
          </div>
        </div>
      </form>

    
    </div>
    <?php } elseif ($do == 'insert') {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $zname = $_POST['zname'];
        $zpass = $_POST['zpass'];
        $zemail = $_POST['zemail'];
        $zfullname = $_POST['zfullname'];
        $sql = "INSERT INTO users (Username, Pass, Email, FullName) VALUES ('$zname', '$zpass', '$zemail', '$zfullname')";
        $conn->exec($sql);
      } else {
        header('location :index.php');
      };
     
    } elseif ($do == 'delete') { 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
      <div class="container">
        <div class="justify-content-center">
        <table class="table">
        <thead>
        <tr>
          <th scope="col">ID :</th>
          <th scope="col">Username :</th>
          <th scope="col">Pass :</th>
          <th scope="col">Email :</th>
          <th scope="col">Fullname :</th>
          <th scope="col">Status :</th>
          <th scope="col">Action :</th>
        </tr>
        </thead>
        
  
      <?php 
      $result = $conn->query('SELECT * FROM users') or die($conn->error);
      while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
      <tbody>
      <tr>
        <td><?php echo $row['Id']; ?></td>
        <td><?php echo $row['Username']; ?></td>
        <td><?php echo $row['Pass']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td><?php echo $row['FullName']; ?></td>
        <td><?php if ($row['GroupID'] == 0) {
          echo 'member';
        } elseif ($row['GroupID'] == 1) {
          echo 'admin';
        } else {
          echo 'error';
        }
        ?>
        </td>
        <td><a href ="?do=delete_process&id=<?php echo $row['Id']; ?>" class="btn btn-danger" name="delete">DELETE</a></td>
      </tr>
      <?php endwhile; ?>
      </tbody>
        </table>
        </div>
      </div>
      <?php
    } 
    }elseif ($do = 'delete_process') {
        $Id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id=$Id";
        $conn->exec($sql);
        header('location: members.php?do=delete');
    }
     
     else {
      echo  'there is no  page with this name';
    }

} else {
  header('location: index.php');
  exit();
};

include 'includes/templates/footer.php';