<?php
include("includes/dbh.inc.php");
$SQL = "SELECT * FROM tbl_category JOIN tbl_product ON tbl_category.id = tbl_product.categoryid";
$result = mysqli_query($conn, $SQL);
?>

<head>
  <title>Wijzig product</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
</head>

<div class="container">
  <h2> Wijzig Product</h2>
  <table border = "1">
    <tr>
      <th>Product ID</th>
      <th>Product Name</th>
      <th>Product Price</th>
      <th>Product Category</th>
      <th>Product Discount</th>
      <th>Percentage van Prijs</th>
      <th>Action</th>
    </tr>

    <?php
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) // constante loop stopt wanneer actie uitgevoerd wordt.
      {
        $id = $row['id']; // haal het id op uit de database
        ?>
        <tr>
          <form action= includes/update.inc.php?wijzig=<?php echo $id;?> method=post>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo "<input type = text name = pprice value='".$row['price']."'>";?></td>
            <td><?php echo $row['catName']; ?></td>
            <td><?php echo "<input type = text name = pdisc value='".$row['discount']."'>";?></td>
            <td><?php echo "<input type = text name = pperdisc value='".$row['percdiscount']."'>";?></td>
            <td>
              <?php echo "<input type =submit value = Wijzig>";?>
            </td>
          </form>
        </tr>

      <?php
      }
      ?>

    </table>
  <a href="index.php">Home</a>  <!-- plaats knop om terug te keren naar index-->
  </div>
