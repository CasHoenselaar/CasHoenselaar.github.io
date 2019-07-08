<?php
include("includes/dbh.inc.php");
$SQL = "SELECT * FROM tbl_category JOIN tbl_product ON tbl_category.id = tbl_product.categoryid";
$result = mysqli_query($conn, $SQL);
?>

<head>
  <title>Delete product</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
</head>

<div class="container">
  <h2> Delete Product</h2>
  <table border = "1">
    <tr>
      <th>Product ID</th>
      <th>Product Name</th>
      <th>Product Price</th>
      <th>Product Category</th>
      <th>Product Discount</th>
      <th>Product Percentage Discount</th>
      <th>Action</th>
    </tr>

    <?php
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) // constante loop stopt wanneer actie uitgevoerd wordt.
      {
        $id = $row['id']; // haal het id op uit de database
        ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><?php echo $row['catName']; ?></td>
          <td><?php echo $row['discount']; ?></td>
          <td><?php echo $row['percdiscount']; ?></td>
          <td>
            <a href="admin_delproduct.php?delete=<?php echo $id; ?>"onclick="return confirm ('Are you sure?');">Delete</a>
          </td>
        </tr>

      <?php
      }
      if (isset($_GET['delete'])) // waneer in de header het woordt delete achter het vraagteken staat.
      {
        $delete_id = $_GET['delete']; // kijk welk id verwijderd moet worden.
        $SQL = "DELETE FROM tbl_product WHERE id = '$delete_id'";
        mysqli_query($conn, $SQL);
        header ("location: admin_delproduct.php"); // keer terug naar de delproduct pagina
      }
      ?>
    </table>
  <a href="index.php">Home</a> <!-- plaats knop om terug te keren naar index-->
  </div>
