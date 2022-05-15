
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/ada/View/images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ADA</title>
</head>
<body class="d-flex flex-column min-vh-100">


<nav class="navbar navbar-expand-sm bg-none navbar-light">
  <div class="container-fluid">
  <div class="col-sm-3">

    <a class="navbar-brand" href="../Controllers/controllers.php?home">
      <img src="/ada/View/images/logo_ada2.png" style="width: 50%" >
    </a>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar"> 

    <div class="col-sm-6" style="">

      <!-- Links -->
      <ul class="navbar-nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="../Controllers/controllers.php?home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Controllers/controllerProject.php?gallery">Gallerie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Controllers/controllers.php?apropos">A propos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Controllers/controllers.php?contact">Contacte</a>
        </li>
      </ul>
    </div>
    
      <?php
      session_start();
      if(!isset($_SESSION['administrator']))
      {
        $_SESSION['administrator']=false;

      }
      if($_SESSION['administrator'])
      {
      ?>
      <div class="col-sm-2">
      </div>
        <div class="col-sm-1">
          
        <ul class="d-flex">
          
          <a href="/ada/Controllers/controllers.php?logout" class="btn btn-secondary">logout</a>
        </ul>
      <?php
      }
      ?>
        </div>
  </div>

</nav>