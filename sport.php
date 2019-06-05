<?php $page = 'Sport'; include"header.php"?>
<?php include"nav.php"?>
<?php include("includes/dbh.inc.php");?>

<head>
      <title>Sportieve</title>
</head>

<body>
  <section id="showcase">
    <div class="container">
      <img id="showcasepic" src="foto/sport.jpg" alt="showcasepic" height="280">
    </div>
  </section>
  <div class="container">
    <section id="main">
      <?php
      $SQL = "SELECT * FROM tbl_product WHERE categoryid = '3' ORDER BY id ASC";
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
                <h1>Sportieve fietsen van topmerken</h1>
                <p>Denk je er ook wel eens aan om een sportieve fiets aan te schaffen? Sportieve fietsen worden steeds populairder, of het nu voor het woon-werk verkeer gebruikt wordt of om zelf een paar (lange) tochten te maken. De sportieve fiets is hier uitermate geschikt voor! Bij CML.nl heb je een ruime keuze aan sportieve fietsen.</p>
              </aside>
            </div>
  <?php include"footer.php"?>
</body>
