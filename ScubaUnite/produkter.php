<?php

require_once 'header.php';
?>
<h1 class="text-center my-4 display-2 text-decoration-underline">Produkter</h1>
<div class="container">
    <div class="row d-flex justify-content-center mb-5">

<?php

require_once 'db.php';
$stmt = $db->prepare("SELECT * FROM kategorier");
$stmt->execute();
$produkt = $stmt->fetchAll();

foreach ($produkt as $pro) {

    // Hämta data om varje film
    $produkt = $pro['produkt'];
    $bild = $pro['bild'];
  
    // Hämta src till en bild från mappen images
    if (empty($bild)){
      $bild = "images/no-poster.png";
    } 
    else {
      $bild = "images/$produkt/$bild";
    }


?>
<!-- Kategorier -->
            <div class="col-lg-3 col-sm-4 card m-1">
                <a class="text-decoration-none" href="<?php echo strtolower($produkt); ?>.php">
                    <img class="card-img-top" src="<?php echo $bild; ?>" alt="<?php echo $produkt; ?>">
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            <?php echo $produkt; ?>
                            <br>
                        </h4>
                    </div>        
                </a>
            </div>
<?php
}
?>
    </div>
</div>

<?php
require_once 'footer.php';

?>