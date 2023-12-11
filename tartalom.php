
<?php
session_start();
require_once 'db_kapcsolat.php';

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'aaa') {
    header('Location: index.php');
    exit();
}


// Űrlap adatok feldolgozása
if (isset($_POST['submit'])) {
    $username = $_POST['felh_nev'];
    $postalCode = $_POST['iranyito_szam'];
    $county = $_POST['megye'];
    $city = $_POST['varos'];
    $street = $_POST['utca_hazszam'];

    $sql = "INSERT INTO felhasznalo (felh_nev, iranyito_szam, megye, varos, utca_hazszam) VALUES ('$username', '$postalCode', '$county', '$city', '$street')";
    $conn->query($sql);

    header('Location: tartalom.php');
    exit();
}

// Rekordok lekérdezése
$sql = "SELECT * FROM felhasznalo ORDER BY id DESC";
$result = $conn->query($sql);
$records = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tartalmi oldal</title>
</head>
<body>
    <h2>Üdvözöljük, <?php echo $_SESSION['user']; ?>!</h2>

    <form method="post" action="tartalom.php">
        <label>Felhasználónév:</label>
        <input type="text" name="felh_nev" required><br>

        <label>Irányítószám:</label>
        <input type="text" name="iranyito_szam" required><br>

        <label>Megye:</label>
        <input type="text" name="megye" required><br>

        <label>Város:</label>
        <input type="text" name="varos" required><br>

        <label>Utca és házszám:</label>
        <input type="text" name="utca_hazszam" required><br>

        <input type="submit" name="submit" value="Rögzít">
    </form>

    <h3>Eddig rögzített rekordok:</h3>
    <ul>
        <?php foreach ($records as $record) : ?>
            <li>
                Felhasználónév: <?php echo $record['felh_nev']; ?>,
                Irányítószám: <?php echo $record['iranyito_szam']; ?>,
                Megye: <?php echo $record['megye']; ?>,
                Város: <?php echo $record['varos']; ?>,
                Utca és házszám: <?php echo $record['utca_hazszam']; ?>
                <a href="modosit.php?id=<?php echo $record['id']; ?>">Módosít</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="post" action="kijelentkezes.php">
        <input type="submit" value="Kilépés">
    </form>
</body>
</html>
