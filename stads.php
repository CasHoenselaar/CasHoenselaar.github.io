<?php $page = 'Stads'; include"header.php"?>
<?php include"nav.php"?>
<?php include("includes/dbh.inc.php");?>

<head>
      <title>Stads</title>
</head>

<body>
  <section id="showcase">
    <div class="container">
      <img id="showcasepic" src="foto/stad.jpg" alt="showcasepic" height="280">
    </div>
  </section>
  <div class="container">
    <section id="main">
      <?php
      $SQL = "SELECT * FROM tbl_product WHERE categoryid = '2' ORDER BY id ASC";
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
              <form method="post" action="shoppingcart.php?action=add&id=<?php echo $row["id"];?> ">
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
                      <input type="submit" name="add-to-cart" class="btn-success" value="Add to Cart">
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
                <h1>Wie heeft er geen stads fiets</h1>
                <p>Van een paar dingen in het leven herinner jij je de eerste keer: jouw eerste auto, voor het eerst op kamers... en ook jouw eerste echte stadsfiets toen je naar de middelbare school ging! Onder de ongeveer 19 miljoen bruikbare fietsen in Nederland is de stadsfiets het meest gebruikte en het populairste model. Daarom hebben we op CML.nl een groot aanbod van allerlei soorten stadsfietsen. Veel of weinig versnellingen, met of zonder achterdrager, modern of klassiek; je kunt het zo gek niet bedenken of er bestaat een versie van de stadsfiets van.</p>
              </aside>
            </div>
  <?php include"footer.php"?>
</body>
