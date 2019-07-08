<head>
  <title>Add product</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
</head>

<div class="container">
  <div class="box round first">
  <h2> Add Product</h2>
    <div class="block">
      <form name="form1" action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <td>Product Name</td>
            <td><input type = "text" name = "pnm"></td>
          </tr>
          <tr>
            <td>Product Image</td>
            <td><input type="file" name="pimage"></td>
          </tr>
          <tr>
            <td>Product Price</td>
            <td><input type = "text" name = "pprice"></td>
          </tr>
          <tr>
            <td>Product Category</td>
            <td>
              <select name = "pcategory">
                <option value = "1">Electrische</option>
                <option value = "2">Stads</option>
                <option value = "3">Sportieve</option>
            </td>
          </tr>
          <tr>
          <td>Product Discription</td>
          <td><textarea cols"12" rows="5" name = "pdesc"></textarea></td>
          </tr>
          <tr>
            <td><input type = "submit" name="submit1" value="Upload"></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <a href="index.php">Home</a>
</div>

<?php
  include("includes/dbh.inc.php");

  if (isset($_POST["submit1"]))
    { // tbv foto
      $v1 = rand(1111,9999); // maak 2 random waardes aan
      $v2 = rand(1111,9999);
      $v3 = $v1.$v2; // vermenigvuldig deze waarde met elkaar.
      $v3 = md5($v3); // manier van hashen van foto

      $fnm = $_FILES["pimage"]["name"]; // file name aanmaken
      $dst="product_image/".$v3.$fnm; // bestemming aanmaken waar foto geplaatst wordt
      move_uploaded_file($_FILES["pimage"]["tmp_name"], $dst);
      mysqli_query($conn,"INSERT INTO tbl_product VALUES('','$_POST[pnm]','$dst','$_POST[pprice]','$_POST[pdesc]','$_POST[pcategory]','','')");
    }
?>
