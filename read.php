<?php 

// Förbered en SQL-sats
$stmt = $conn->prepare("SELECT * FROM contacts");

// Kör SQL-satsen
$stmt->execute();

// Hämta all data från tabellen och spara i en array
$result = $stmt->fetchAll();

// fetchAll — Returns an array containing all of the result set rows
// https://www.php.net/manual/en/pdostatement.fetchall.php

$table = "<table class='table'>
        <tr>
            <th>Namn</th>
            <th>Telefon</th>
            <th>Admin</th>
        </tr>";
    foreach ($result as $value) {
    $table .= "<tr>
                <td>$value[name]</td>
                <td>$value[tel]</td>
                <td>
                    <a href='update.php?id=$value[id]' class='btn btn-sm btn-outline-info'>Uppdatera</a>
                </td>
                <td>
                    <a href='delete.php?id=$value[id]' class='btn btn-sm btn-outline-danger'>Ta bort</a>
                </td>
            </tr>";
    }
    $table .= '</table>';
    echo $table;