<?php
if (isset($_POST['signup-submit'])) // waneer signup knop ingedurkt wordt
{
  require 'dbh.inc.php';

  $username = $_POST['uid']; // alle gegevens van de ingevulde tekstvak opslaan
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordrepeat = $_POST['pwd-repeat'];
  //<!--kijken of alles ingevuld is-->
  if (empty($username) || empty($email) || empty($password) || empty($passwordrepeat))
  { // checken of er legen velden zijn
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  //<!--kijken of email geldig is-->
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
    //<!--kijken of wachtwoord gelijk aan elkaar is-->
  else if ($password !== $passwordrepeat)
  { // zo niet geef error
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
      //<!--Alles goed dan uit database gegevens halen-->
  else
  {
    $SQL = "SELECT uidUsers FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $SQL))
    { // Kijken of de database bereikbaar is
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
          //<!--Alles goed dan uit database gegevens halen-->
    else
    {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck> 0)
      { // als check hoger dan 0 betekend dat er al een zelfde username bekend is
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else
      {
          $SQL = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $SQL))
          { // als de database niet beschikbaar is
            header("Location: ../signup.php?error=sqlerror");
            exit();
          }
          else
          {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            // zorg er voor dat het wachtwoord niet drirect zichtbaar is in de database
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../signup.php?succes=signup");
            exit();
          }
        }
      }
    }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else
{
  header("Location: ../signup.php");
  exit();
}
