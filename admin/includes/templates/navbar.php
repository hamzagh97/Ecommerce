

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
  <a class="navbar-brand" href="dashboard.php">home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">items</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="members.php?do=manage">members</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#">statistics</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Logs</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['Username']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="members.php?do=edit&userid=<?php echo $_SESSION['Id']?>">edit profile</a>
          <a class="dropdown-item" href="#">settings</a>
          <a class="dropdown-item" href="logout.php">logout</a>
        </div>
      </li>
</ul>
  </div>
  </div>
</nav>


