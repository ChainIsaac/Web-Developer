<?php

require_once 'header.php';

?>

<h1 class="text-center my-4 display-2 text-decoration-underline">Bli kund</h1>
<div class="text-center">
    <p>
        Bli kund hoss oss och få ta del utav våran gemenskap, uppdateringar utav produkter och möjliga framtida evenemang.
        <br>
        Eller bara registrera er så jag vet om det är någon som tittat in.
    </p>
</div>
<div class="container">
    <div class="row d-flex justify-content-center mb-5">
        <form action="reg.php" method="post" class="row">
            <div class="row-md-5">
                <input type="text" name="namn" class="form-control mt-2" 
                    required placeholder="Fullt namn">
            </div>
            <div class="row-md-5">
                <input type="number" name="telefon" class="form-control mt-2" 
                    required placeholder="Telefon nummer">
            </div>
            <div class="row-md-5">
                <input type="email" name="email" class="form-control mt-2" 
                    required placeholder="E-mail">
            </div>
            <div class="row-md-5">
                <input type="text" name="adress" class="form-control mt-2" 
                    required placeholder="Adress">
            </div>
            <div class="row-md-5">
                <input type="number" name="postkod" class="form-control mt-2" 
                required placeholder="Postkod">
            </div>
            <div class="row-md-5">
                <input type="text" name="stad" class="form-control mt-2" 
                required placeholder="Stad">
            </div>
            <div class="row-md-5">
                <input type="submit" class="form-control mt-2 btn btn-primary" 
                value="Registrera" >
            </div>
        </form>
    </div>  
</div>

<?php

require_once 'footer.php';

  
?>