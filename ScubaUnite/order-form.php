<?php

/**********************************************
 *       order-form.php
 *       Skriptet hanterar en GET-request
 *       och visar ett beställningsformulär
 **********************************************/

// Om id saknas i URLen, gå till startsidan 
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
    // Make sure that code below does not get executed when we redirect. 
    // http://php.net/manual/en/function.header.php
}

// Infoga sidhuvud (header.php)
include_once 'header.php';

// Sök filmen i databasen med hjälp av dess id
// OBS! Vi måste rensa id för bättre säkerhet
$id = htmlspecialchars($_GET['id']);

require_once 'db.php';
$sql  = "SELECT * FROM produkter WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Hämta info om filmen
$pro  = $stmt->fetch();
// print_r($film); die;
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

<h2 class="text-center my-4 display-2 text-decoration-underline">Beställningsformulär</h2>
<h3 class="text-center">
    <?php echo $produktNamn; ?>
</h3>
<div>
    <img src="<?php echo $bild;?>" alt="<?php echo $produktNamn;?>" class="img-fluid w-50 mx-auto d-block">
</div>
<h4 class="text-center">    
    <br>Pris: <?php echo $pris; ?>kr
</h4>
<div class="container">
    <div class="row mb-5">
        <form action="order-process.php" method="post" class="row">
            <div class="col-md-5 mx-auto">
                <input type="email" name="email" 
                required class="col-4 form-control my-2" 
                placeholder="Ange din email">
            </div>
            <div class="col-md-5 mx-auto">
                <input type="number" name="kund_id" 
                required class="col-4 form-control my-2" 
                placeholder="Ange ditt kundnummer">
            </div>
            <div class="col-md-12 mx-auto">
                <input type="submit" 
                class="col-6 form-control my-2 btn btn-outline-success" 
                value="Skicka beställningen">
            </div>
            <div class="col-md-2">
                <input type="hidden" name="id" value="<?php echo $id ?>">
            </div>
        </form>
    </div>
</div>
<?php
    require_once 'footer.php';
?>