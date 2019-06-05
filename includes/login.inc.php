<?php
if (isset($_POST['login-submit']))
{
  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  if (empty($mailuid) || empty($password))
  {
    header("Location: ../index.php?error=emptyfields"); // checken of email of wachtword ingevuld is
    exit();
  }
  else
  {
    $SQL = "SELECT * FROM users WHERE uidUsers = ? OR emailUsers = ?;"; // checken of de database beschikbaar is
    $stmt = mysqli_stmt_init($conn); // return een object die gebruikt wordt in de perpare
    if (!mysqli_stmt_prepare($stmt, $SQL)) {
      header("Location: ../index.php?error=sqlerror"); // schrijf in header dat error op sql aanwezig is
      exit();
    }
    else
    {
      mysqli_stmt_bind_param($stmt, "ss",$mailuid, $mailuid); // zet paramters klaar voor sql
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUId'] = $row['uidUsers'];
          header("Location: ../index.php?succes=login");
          exit();
        }
        else {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
      }
      else
      {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }
  }
}
else {
  header("Location: ../index.php");
  exit();
}
