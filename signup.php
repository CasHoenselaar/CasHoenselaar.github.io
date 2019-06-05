<head>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
</head>
<!-- afhandeling van de error en succes berichten in de header-->
<main>
  <div class= "container">
    <h1>Signup</h1>
    <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "emptyfields") {
        echo '<p class"signuperror"> Fill in all fields!</p>';
      }
      else if ($_GET['error'] == "invaliduidmail") {
        echo '<p class"signuperror"> Invalid username and e-mail!</p>';
      }
      else if ($_GET['error'] == "invaliduid") {
        echo '<p class"signuperror"> Invalid username!</p>';
      }
      else if ($_GET['error'] == "invalidmail") {
        echo '<p class"signuperror"> Invalid e-mail!</p>';
      }
      else if ($_GET['error'] == "passwordcheck") {
        echo '<p class"signuperror"> Your passwords do not match!</p>';
      }
      else if ($_GET['error'] == "usertaken") {
        echo '<p class"signuperror"> Username is already taken!</p>';
      }
    }
    else if ((isset($_GET['succes'])) == "signup"){
      echo '<p class"signuperror"> Signup successfull!</p>';
      header("Location: ../index.php");
    }
     ?>
    <form action="includes/signup.inc.php" method="post" name = "form1">
      <table>
        <tr>
          <td>Username</td>
          <td><input type="text" name="uid" placeholder="Username"></td>
        </tr>
        <tr>
          <td>E-mail</td>
          <td><input type="text" name="mail" placeholder="E-mail"></td>
        </tr>
        <tr>
          <td>Password</td>
        <td><input type="password" name="pwd" placeholder="Password"></td>
      </tr>
      <tr>
        <td>Repeat Password</td>
        <td><input type="password" name="pwd-repeat" placeholder="Repeat password"></td>
      </tr>
      <tr>
        <td><button type="submit" name="signup-submit">Signup</button></td>
      </tr>
    </table>
  </form>
  <a href="index.php">Home</a>
  </div>
</main>
