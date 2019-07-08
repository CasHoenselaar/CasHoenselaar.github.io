<?php $page = 'Elek'; include"header.php"?>
<?php include"nav.php"?>
<?php include("includes/dbh.inc.php");?>

<head>
      <title>Elektrische</title>
</head>

<body>
  <section id="showcase">
    <div class="container">
      <img id="showcasepic" src="foto/elec.jpg" alt="showcasepic" height="280">
    </div>
  </section>
  <div class="container">
    <section id="main">
      <?php
        $SQL = "SELECT * FROM tbl_product WHERE categoryid = '1' ORDER BY id ASC";
        $result = mysqli_query($conn, $SQL);
        if (mysqli_num_rows($result)>0)
        {
          while ($row = mysqli_fetch_array($result))
          { // reken de nieuwe prijs uit met korting
            $prijs = $row["price"]; // schrijf oude prijs in variable
            $discount = $row["discount"]; // schijf of kortign afctief is of niet
            $percdiscount = $row["percdiscount"]; // schijf het percentage van de korting
            if ($discount == '1')
            {
              $newprijs = $prijs * $percdiscount /'100';
            }
            else
            {
              $newprijs = $prijs;
            }
          ?>
            <div>
              <form method="post" action="shoppingcart.php?action=add&id=<?php echo $row["id"];?>">
                <div>
                  <img src="<?php echo $row["image"];?>"/>
                  <h4><?php echo $row["name"];?></h4>
                  <h4>&#8364;<?php echo round($newprijs,2);?></h4> <!-- zet de nieuwe prijs onder afbeeling met euroteken en afronden-->
                    <?php // als een user is ingelogd dan
                    if(isset($_SESSION['userId']))
                    {
                    ?>
                      <input type="text" name="quantity" value="1">
                      <input type="hidden" name="hidden_name" value="<?php echo $row["name"] ?>">
                      <input type="hidden" name="hidden_price" value="<?php echo $newprijs ?>">
                      <input type="submit" name="add-to-cart" class="button" value="Add to Cart">
                    </div>
                  </form>
                </div>
                <?php
                    }
                    else
                    { // als geen user is ingelogd
                      echo '<h2 class "login-status">Log in om een fiets te kopen!</h2>';
                    }
                  }
                }
                ?>
              </section>

              <aside id="sidebar">
                <h1>Wat is een elektrische fiets</h1>
                <p>Een elektrische fiets is een tweewieler die naast het gewone fietsen, extra elektrische ondersteuning biedt. De motor en de accu zorgen ervoor dat deze ondersteuning wordt opgewekt en overgebracht. De elektrische fiets is populairder dan ooit en het is een ideale aankoop voor iedereen die tijdens het fietsen een extra zetje in de rug wil. Handig wanneer je bijvoorbeeld op de fiets naar het werk wil en niet moe wilt aankomen. Of wanneer je gewoon lekker wilt genieten van buiten zijn op de fiets. Ook het vervoeren van je kinderen zal veel gemakkelijker gaan met de trapondersteuning die de elektrische fietsen bieden.</p>
              </aside>
            </div>
  <?php include"footer.php"?>
</body>
