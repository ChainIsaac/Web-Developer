<?php

require_once 'header.php';

?>

<h1 class="text-center my-4 display-2 text-decoration-underline">Kontakta oss</h1>
<div class="text-center">
    <img class="img-fluid w-50" src="images/profil.png" alt="ScubaUnite">
    <p>Tack för att ni besöker ScubaUnite och hoppas att ni finner det ni söker, har ni några frågor angående produkter, leverans så kontakta oss så svarar vi så fort vi kan!</p>
</div>
<div class="container">
    <div class="row d-flex justify-content-center mb-5">
<form action="meddelande.php" method="post" class="row">
    <div class="col-md-5">
        <input type="text" name="namn" class="form-control mt-2" 
               required placeholder="Fullt namn">
    </div>
    <div class="col-md-5">
        <input type="email" name="email" class="form-control mt-2" 
               required placeholder="Ange E-mail">
    </div>
    <div>
    <textarea name="message" id="message" class="form-control mt-2" placeholder="Write a message...." row="10"></textarea>
    <span id="counter"></span>
    </div>
    <div class="col-md-3">
        <input type="submit" class="form-control mt-2 btn btn-primary" 
        value="Skicka" >
    </div>
</form>

<?php

require_once 'footer.php';

  
?>