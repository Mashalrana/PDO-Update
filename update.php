<?php
// Databasegegevens
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    // Maak een verbinding met de database
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "DB connection successful";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productNaam = $_POST["product_naam"];
        $prijsPerStuk = $_POST["prijs_per_stuk"];
        $omschrijving = $_POST["omschrijving"];

        try {
            // SQL-query om het tweede product bij te werken
            $sql = "UPDATE producten SET product_naam = ?, prijs_per_stuk = ?, omschrijving = ? WHERE producten_code = 9";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$productNaam, $prijsPerStuk, $omschrijving]);

            echo "Record succesvol bijgewerkt.";
        } catch (\PDOException $e) {
            echo "Fout bij het bijwerken van het record: " . $e->getMessage();
        }
    }
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="update.php" method="POST">
    <label for="product_naam">Productnaam:</label><br>
    <input type="text" name="product_naam" id="product_naam"><br>

    <label for="prijs_per_stuk">Prijs per stuk:</label><br>
    <input type="text" name="prijs_per_stuk" id="prijs_per_stuk"><br>

    <label for="omschrijving">Omschrijving:</label><br>
    <input type="text" name="omschrijving" id="omschrijving"><br>

    <input type="submit" value="Update"><br>
</form>

</body>
</html>