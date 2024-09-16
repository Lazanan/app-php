<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit;
}

$servername = "localhost";
$username = "etudiant_user";
$password = "azertyuiop";
$dbname = "etudiants_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM etudiants");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
<div class="link">
    <p><a href="app.php">Ajouter etudiant</a></p>
    <p><a href="logout.php">Se déconnecter</a></p>
</div>
</header>
<body>
<h1>Liste des étudiants</h1>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Sexe</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['nom']; ?></td>
        <td><?php echo $row['prenom']; ?></td>
        <td><?php echo $row['sexe']; ?></td>
        <td id="action">
            <button><a href="edit.php?id=<?php echo $row['id']; ?>"><img src="pen.svg" alt="Modifier"></a></button>
            <button><a href="details_etudiant.php?id=<?php echo $row['id']; ?>"><img src="eye.svg" alt="Voir détail"></a></button>
            <button><a href="list-etudiants.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr ?');"><img src="trash.svg" alt="Supprimer"></a></button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- <div class="link">
    <p><a href="app.php">Ajouter etudiant</a></p>
    <p><a href="logout.php">Se déconnecter</a></p>
</div> -->

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM etudiants WHERE id=$id";
    $conn->query($sql);
    header("Location: list-etudiants.php");
}
$conn->close();
?>
</body>
</html>
