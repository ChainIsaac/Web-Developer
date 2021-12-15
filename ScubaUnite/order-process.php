<?php
require_once 'extrakod.php';
/**********************************************
 *       order-process.php
 *       Skriptet hanterar formulärdata från
 *       order-form.php
 **********************************************/

// Om POST saknas, gå till startsidan 
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.php');
    exit;
}

// Hämta och rensa data från POST
$customer = htmlspecialchars($_POST['kund_id']);
$email = htmlspecialchars($_POST['email']);
$pro = htmlspecialchars($_POST['id']);


// Kolla om kunden finns i databasen
require_once 'db.php';
$sql = "SELECT * FROM kunder Where kund_id=:kund_id and email=:email";
$stmt = $db->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':kund_id', $customer);
$stmt->execute();

    // Sparar stmt för användning vid check out

    $clear = $stmt->rowCount();

    // Ja kunden finns i databasen. Hämta info om kunden.
    $customer = $stmt->fetch();
    
    $kund_id = $customer['kund_id'];
    $namn = $customer['namn'];
    $telefon = $customer['telefon'];
    $email = $customer['email'];
    $adress = $customer['adress'];
    $postkod = $customer['postkod'];
    $stad = $customer['stad']; 

// Kolla om kunden finns i databasen
require_once 'db.php';
$sql = "SELECT * FROM produkter Where id=:id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $pro);
$stmt->execute();

// Hämta info om produkter
$pro  = $stmt->fetch();

$id    = $pro['id'];
$produkt = $pro['produkt'];
$produktNamn = $pro['produktNamn'];
$beskrivning = $pro['beskrivning'];
$pris = $pro['pris'];
$bild = $pro['bild'];


//  Om kunden saknas, skapa ett felmeddelande
if ($clear == 0) {
   
    $message = "
        <div class='alert alert-warning mx-5 text-center'>
        <p> OBS! Kundnumret är inte registrerat! </p>
		</div>";
} else {
    
    $message = "
        <div class='alert alert-success mx-5 text-center'>
			<p>Tack $namn!</p>
             <br>
           <p>Här är din beställnings bekräftelse på $produktNamn, en kopia har skickats till $email <br> Totalt: $pris kr.</p>
           <br>
           <p>Leveranstid beräknas till 4-7 arbetsdagar.</p>
            <p>Tack för beställningen.
            <br>
            MVH, ScubaUnite</p>
        </div>";

    $confirm = "
        <div class='alert alert-success mx-5 text-center'>
            <p>Beställning till $namn</p>
            <br>
            <p>Ny beställning på $produktNamn som ska levereras till:</p>
            <div>
                <ul>
                    <li>Kund ID: $kund_id</li>
                    <li>Namn: $namn</li>
                    <li>Telefon: $telefon</li>
                    <li>Email: $email</li>
                    <li>Adress: $adress</li>
                    <li>Postkod: $postkod</li>
                    <li>Stad: $stad</li>
                </ul>
            </div>
        </div>";

    // TODO: (OBS! Kräver en epost-server)


    
    // Skicka bekräftelse via e-post till kunden

    $to = "$email";
    $subject = "Bekräftelse från ScubaUnite";
    $headers[] = "From: $min_email";
    $headers[] = "Reply-To: noreply@example.com"; 
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=utf-8"; 
    mail($to, $subject, $message, implode("\r\n", $headers));


    // Skicka beställningen till butiken via e-post

    $to = "$min_email";
    $subject = "Beställning från $namn";
    $headers[] = "From: $email";
    $headers[] = "Reply-To: noreply@example.com"; 
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=utf-8"; 
    $headers[] = "cc: $email";
    mail($to, $subject, $confirm, implode("\r\n", $headers));

}

include_once 'header.php';
echo $message;
include_once 'footer.php';
