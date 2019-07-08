<?php
session_start();

if (isset($_POST["add-to-cart"])) // als de button add to cart ingedrukt wordt
{
 if(isset($_SESSION['shopping_cart'])) // als er een sessie van shopping cart is
 {
   $count = count($_SESSION['shopping_cart']); // tel aantal producten in winkelwagen
   $item_array_id = array_column($_SESSION['shopping_cart'],'item_id');
   if (!in_array($_GET["id"], $item_array_id))
   {
     $item_array = array(
       'item_id'       => $_GET["id"], // zet variablelen in array
       'item_name'     => $_POST["hidden_name"],
       'item_price'    => $_POST["hidden_price"],
       'item_quantity' => $_POST["quantity"]
     );
     $_SESSION['shopping_cart'][$count] = $item_array; // plaats producten in winkelwagen
   }
 }
 else
 { // als geen sessie aanwezig zet niks in de winkelwagen
   $item_array = array(
     'item_id'       => $_GET["id"],
     'item_name'     => $_POST["hidden_name"],
     'item_price'    => $_POST["hidden_price"],
     'item_quantity' => $_POST["quantity"]
   );
   $_SESSION['shopping_cart'][0] = $item_array;
  }
}
// als een actie gebeurt zoals verwijderen
if (isset($_GET["action"]))
{
 if ($_GET["action"] == "delete")
 {
   foreach ($_SESSION['shopping_cart'] as $keys => $value)
   {
     if($value["item_id"] == $_GET["id"])
     {
       unset($_SESSION['shopping_cart'][$keys]); // haal product uit winkelwagen
     }
   }
 }
}
?>

<head>
  <title>Shopping Cart</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css">
</head>

<body>
  <div class="container">
    <div>
      <h3>Shopping Cart</h3>
      <table border = "1">
        <tr>
          <th>Name </th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
        <?php
          if(!empty($_SESSION['shopping_cart']))
          {//als product in winkelwagen staan zet eerst totaal op 0
            $total = 0;
            foreach ($_SESSION['shopping_cart'] as $keys => $values)
             {
        ?>
               <tr>
                 <td><?php echo $values["item_name"];?></td><!-- plaats naam van item in winkelwagen-->
                 <td><?php echo $values["item_quantity"];?></td><!-- plaats aantal van item in winkelwagen-->
                 <td>&#8364;<?php echo number_format($values["item_price"],2);?></td><!-- plaats bedrag van 1 item in winkelwagen afkomstig van de fiets op site -->
                 <td>&#8364;<?php echo number_format($values["item_quantity"] * $values["item_price"],2);?></td><!-- plaats bedrag van totaal aantal item in winkelwagen -->
                 <td><a  href="shoppingcart.php?action=delete&id=<?php echo $values["item_id"];?>"> <span> Remove </span></a></td><!-- plaats knop om te verwijderen -->
                </tr>

                <?php $total = $total + ($values["item_quantity"] * $values["item_price"]);//totaal van alle producten
             }
             ?>
           </table>
           <br>
           <table border ="1">
             <tr>
               <td>Total</td>
               <td>&#8364;<?php echo number_format(($total),2); ?></td>
             </tr>
            <?php
            }
            ?>
          </table>
        <br>
        <a href="index.php">Home</a>
        <a href="afrekenen.php">Afrekenen</a>
    </div>
   </div>
 </body>
