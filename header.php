<?php session_start();?>
<?php include("includes/dbh.inc.php");?>

<head>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
</head>

<body>
  <header id="mainHeader">
    <div class="container">
    <img id="logo" src="foto/logo.jpg" alt="Logo" width="300">
      <p class="menuName"> <!-- geef de menu naam weer boven in de pagina-->
        <?php if($page == 'Home'){echo 'Home';}?>
        <?php if($page == 'Contact'){echo 'Contact';}?>
        <?php if($page == 'Elek'){echo 'Elektrische Fiets';}?>
        <?php if($page == 'Stads'){echo 'Stads Fiets';}?>
        <?php if($page == 'Sport'){echo 'Sportieve Fiets';}?>
      </p>
      <?php
        if(isset($_SESSION['userId']))
        { // als iemand ingelogd is
          $id = $_SESSION['userId'];
          $SQL= "SELECT * FROM users WHERE idUsers = $id";
          $records = mysqli_query($conn,$SQL);
          while ($user = mysqli_fetch_assoc($records))
          {
            if($user['admin'] == '1')
            {
              echo'<div class="header-signup">';
              echo'  <a href="admin_addproduct.php">Product Toevoegen</a>';
              echo'  <a href="admin_wijzigproduct.php">Product Wijzigen</a>';
              echo'  <a href="admin_delproduct.php">Product Verwijderen</a>';
              echo'</div>';
            }
            echo'<p class "login-status"> ͅ  '.$user['uidUsers'].'</p>'; // laat zien wie ingelogd is
          }
          echo '<form action="includes/logout.inc.php" method="post">
                <button type="submit" class="button" name="logout-submit">Logout</button>
                </form>';
          echo'<p class "login-status"> You are logged in!</p>';
        }
        else
        { // als niemand ingelogd is
          echo '<form action="includes/login.inc.php" method="post">
                <input type="text" name="mailuid" placeholder="E-mail/Username">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" class="button" name="login-submit">Login</button>
                </form>
                <a href="signup.php" class="header-signup">Signup</a>';
          echo '<p class "login-status"> You are logged out!</p>';
        }
        ?>
      </div>
    </header>
  </body>
</html>
