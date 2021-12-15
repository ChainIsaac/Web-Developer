

<?php

require_once 'header.php';
require_once 'extrakod.php';

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  // Hämta data från post-arrayen
  $name = $_POST['namn'];
  $telefon = $_POST['telefon'];
  $email  = $_POST['email'];
  $adress = $_POST['adress'];
  $postkod = $_POST['postkod'];
  $stad = $_POST['stad'];
  
  // Förbered en SQL-sats and binda parametrar
  $sql =    "INSERT INTO kunder (namn, telefon, email, adress, postkod, stad) 
             VALUES (:namn, :telefon, :email, :adress, :postkod, :stad)";
  $stmt = $db->prepare($sql);

  $stmt->bindParam(':namn', $name); 
  $stmt->bindParam(':telefon', $telefon);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':adress', $adress);
  $stmt->bindParam(':postkod', $postkod);
  $stmt->bindParam(':stad', $stad);

  // Kör SQL-satsen (infoga en rad)
  $stmt->execute();

    $last_id = $db->lastInsertId();
    
    $confirm = "<div class='alert alert-success mt-2 text-center'>
              <h3>Tack $name</h3>
              <p>Du är nu registrerad som kund hos oss på ScubaUnite.</p> 
              <p>Spara ditt kundnummer som referens när du kontaktar eller handlar hos oss.</p>
              <small>Ditt kundnummer är: $last_id</small>
              <p>MVH. Adam Albertsson, CEO på ScubaUnite
              </div>";
  echo $confirm;

    // Skicka e-post till mig och en kopia till kunden
  $to = "$min_email";
  $subject = "Registrering utav kund $name";
  $headers[] = "From: $email";
  $headers[] = "Reply-To: noreply@example.com"; 
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/html; charset=utf-8"; 
  $headers[] = "cc: $email";
  mail($to, $subject, $confirm, implode("\r\n", $headers));

  }


include_once 'footer.php';
?>