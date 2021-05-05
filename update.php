<?php
require_once 'database.php';
require_once 'header.php';

//först read data of id
if (isset($_GET['id'])) {

    //Hämta id från querystring
    $id = htmlspecialchars($_GET['id']);

    //förbered en SQL-sats
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->bindParam(':id', $id);

    // Kör SQL-satsen
    $stmt->execute();

    // Hämta all data från tabellen och spara i en array
    $result = $stmt->fetch();

    $name = $result['name'];
    $tel = $result['tel'];

    $form = 
        "<form action='#' method='post' class='row'>
            <div class='col-md-5'>
                <label for='name'>Namn:</label>
                <input type='text' name='name' class='form-control mt-2' value='$name'>
            </div>
            <div class='col-md-5'>
                <label for='name'>Telefon</label>
                <input type='text' name='tel' class='form-control mt-2' value='$tel'>
            </div>
            <div class='col-md-2'>
                <label for='name'>Admin</label>
                <input type='submit' class='form-control mt-2 btn btn-outline-primary' value='Spara' >
            </div>
        </form>";

    echo $form;
}

//update

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hämta data från post-arrayen
    $name = htmlspecialchars($_POST['name']);
    $tel = htmlspecialchars($_POST['tel']);

    // Förbered en SQL-sats and binda parametrar
    $stmt = $conn->prepare("UPDATE contacts SET name=:name, tel=:tel WHERE id=:id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':id', $id);

    // Kör SQL-satsen (infoga en rad)
    $stmt->execute();

    echo "<p class='alert alert-success'>Record name: $name, tel: $tel updated successfully.</p>";
}

require_once 'footer.php'; 
