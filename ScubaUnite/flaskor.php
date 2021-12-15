<?php

require_once 'header.php';

require_once 'db.php';
$stmt = $db->prepare("SELECT * FROM produkter where produkt='Flaskor'");
$stmt->execute();
$produkt = $stmt->fetchAll();


?>
<h1 class="text-center my-4 display-2 text-decoration-underline">Flaskor</h1>
<div class="container">
    <div class="row d-flex justify-content-center mb-5">
<?php

foreach ($produkt as $pro) {

    // Hämta data om varje film
    $id    = $pro['id'];
    $produkt = $pro['produkt'];
    $produktNamn = $pro['produktNamn'];
    $beskrivning = $pro['beskrivning'];
    $pris = $pro['pris'];
    $bild = $pro['bild'];
  
    // Hämta src till en bild från mappen images
    if (empty($bild)){
      $bild = "images/no-poster.png";
    } 
    else {
      $bild = "images/$produkt/$bild";
    }


?>

<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
    <div class="card m-1">
      <img class="card-img-top" 
      src="<?php echo $bild?>" 
      alt="<?php echo $produktNamn ?>">
      <div class="card-body">
        <h4 class="card-title text-center">
          <?php echo $produktNamn ?>
          <br>
          <!-- Skapa en GET-Länk till en beställningssida (skicka id) t.ex. order-form.php?id=1 -->
           <a class="btn btn-outline-info mt-2 m-1"
            href="read-me.php?id=<?php echo $id ?>">
            <?php echo "Beskrivning" ?>
            <a class="btn btn-outline-info mt-2 m-1"
            href="order-form.php?id=<?php echo $id ?>">
            <?php echo "Köp $pris kr" ?>
          </a>
        </h4>
        </div>
      </div>
  </div>

  <?php
  // Avsluta foreach
}
?>

</div>
</div>

<?php

require_once 'footer.php';

?>
