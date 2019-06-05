<?php
include("dbh.inc.php");
if (isset($_GET['wijzig'])) // waneer in de header het woordt wijzig achter het vraagteken staat.
{
  $wijzig_id = $_GET['wijzig']; // kijk welk id gewijzigd moet worden.
  $SQL = "UPDATE tbl_product SET price = '$_POST[pprice]', discount = '$_POST[pdisc]', percdiscount = '$_POST[pperdisc]' WHERE id = '$wijzig_id'";
  mysqli_query($conn, $SQL);
  header ("location: ../admin_wijzigproduct.php"); // keer terug naar de wijzigproduct pagina
}
?>
