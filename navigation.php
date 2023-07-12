

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="img/planet-earth.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <div class="collapse navbar-collapse navbar-left" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="place.php">Places</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="event.php">Events</a>
        </li>
      </ul>
      
      <ul class="nav navbar-nav ml-auto">
        <?php
          if(empty($_SESSION['username'])){

        ?>
        <li>
          <a href="signup.php" class="nav-link"><span class="glyphicon glyphicon-user"></span> SIGN UP</a>
        </li>
        <li>
          <a href="login.php" class="nav-link"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a>
        </li>
        <?php
        }
        else{
        ?>
        <li><a href="includes/logout.inc.php" class="nav-link"><span class="glyphicon glyphicon-log-out"></span>LOG OUT</a></li>
        <?php
        }
        ?>
      </ul>

    </div>		
  </nav>