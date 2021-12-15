<?php

// Om id saknas i URLen, gå till startsidan 
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
    // Make sure that code below does not get executed when we redirect. 
    // http://php.net/manual/en/function.header.php
}

require_once 'header.php';

// OBS! Vi måste rensa id för bättre säkerhet
$id = htmlspecialchars($_GET['id']);
require_once 'db.php';
$sql  = "SELECT * FROM produkter WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Hämta info om filmen
$pro  = $stmt->fetch();

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
<h1 class="text-center my-4 display-2 text-decoration-underline">Produkt beskrivning</h1>
<div class="d-flex justify-content-center my-auto">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img id="myImg" src="<?php echo $bild;?>" class="img-fluid rounded-start" alt="<?php echo $produktNamn;?>">
                    <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- The Close Button -->
                <span class="close">&times;</span>

                    <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                    <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
                </div>
            </div>
            <script src="zoom.js"></script>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $produktNamn;?></h5>
                    <p class="card-text"><?php echo $beskrivning;?></p>
                    <a class="btn btn-outline-info mt-2 m-1"
                    href="<?php echo strtolower($produkt); ?>.php">
                    <?php echo "Tillbaka" ?>
                    <a class="btn btn-outline-info mt-2 m-1"
                        href="order-form.php?id=<?php echo $id ?>">
                        <?php echo "Köp $pris kr" ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

require_once 'footer.php';

?>