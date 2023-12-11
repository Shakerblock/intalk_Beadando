<?php
session_start();
require_once 'db_kapcsolat.php';

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'aaa') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lekérdezzük az adatokat az adott id alapján
    $sql = "SELECT * FROM felhasznalo WHERE id = $id";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();

    // Ellenőrizzük, hogy az id-hoz tartozik-e rekord
    if (!$record) {
        echo "Nem található rekord az adott azonosítóval.";
        exit();
    }

    // Módosítás űrlap feldolgozása
    if (isset($_POST['mentes'])) {
        $felh_nev = $_POST['felh_nev'];
        $iranyito_szam = $_POST['iranyito_szam'];
        $megye = $_POST['megye'];
        $varos = $_POST['varos'];
        $utca_hazszam = $_POST['utca_hazszam'];

        // Módosítás végrehajtása
        $sql_update = "UPDATE felhasznalo SET felh_nev='$felh_nev', iranyito_szam='$iranyito_szam', megye='$megye', varos='$varos', utca_hazszam='$utca_hazszam' WHERE id=$id";
        $conn->query($sql_update);

        // Visszatérés a tartalom oldalra
        header('Location: tartalom.php');
        exit();
    }
} else {
    echo "Hiányzó vagy érvénytelen azonosító.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módosítás</title>
</head>
<body>
    <h2>Rekord módosítása</h2>

    <form method="post" action="modosit.php?id=<?php echo $id; ?>">
        <label>Felhasználónév:</label>
        <input type="text" name="felh_nev" value="<?php echo $record['felh_nev']; ?>" required><br>

        <label>Irányítószám:</label>
        <input type="text" name="iranyito_szam" value="<?php echo $record['iranyito_szam']; ?>" required><br>

        <label>Megye:</label>
        <input type="text" name="megye" value="<?php echo $record['megye']; ?>" required><br>

        <label>Város:</label>
        <input type="text" name="varos" value="<?php echo $record['varos']; ?>" required><br>

        <label>Utca:</label>
        <input type="text" name="utca_hazszam" value="<?php echo $record['utca_hazszam']; ?>" required><br>

        <input type="submit" name="mentes" value="Mentés">
        <a href="tartalom.php">
        <button type="button">Mégse</button>
    </a>
    </form>
    
</body>
</html>
