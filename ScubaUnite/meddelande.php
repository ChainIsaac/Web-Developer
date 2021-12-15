<?php
require_once 'extrakod.php';
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  // Hämta data från post-arrayen
  $name = $_POST['namn'];
  $email  = $_POST['email'];
  $message = $_POST['message'];

  // Förbered en SQL-sats and binda parametrar
  $sql =    "INSERT INTO kontaktformular (namn, email, message) 
             VALUES (:namn, :email, :message)";
  $stmt = $db->prepare($sql);

  $stmt->bindParam(':namn', $name); 
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':message', $message);

  // Kör SQL-satsen (infoga en rad)
  $stmt->execute();

    $last_id = $db->lastInsertId();
    
    $confirm = "<div class='alert alert-success mt-2'>
              <h3>Tack $name</h3>
              <p>Vi kommer att skicka svar till $email.</p> 
              <p>Här kommer en kopia på ditt meddelande:</p> 
              <p><em>$message</em></p>
              <small>Ditt meddelande ID är: $last_id</small>
              </div>";
  echo $confirm;

    // Skicka e-post till mig och en kopia till kunden
  $to = "$min_email";
  $subject = "Meddelande från $name";
  $headers[] = "From: $email";
  $headers[] = "Reply-To: noreply@example.com"; 
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/html; charset=utf-8"; 
  $headers[] = "cc: $email";
  mail($to, $subject, $message, implode("\r\n", $headers));

  }

  include_once 'header.php';
  include_once 'footer.php';