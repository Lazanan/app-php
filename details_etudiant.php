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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM etudiants WHERE id=$id");
    $student = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class="link">
        <p><a href="list-etudiants.php">Liste des étudiants</a></p>
        <p><a href="logout.php">Se déconnecter</a></p>
    </div>
</header>
<body>
<h1>Détails de l'étudiant</h1>
<?php if ($student): ?>
    <div class="details">
        <p><strong>Nom</strong>: <?php echo $student['nom']; ?></p>
        <p><strong>Prénom</strong>: <?php echo $student['prenom']; ?></p>
        <p><strong>Parcours</strong>: <?php echo $student['parcours']; ?></p>
        <p><strong>Date de naissance</strong>: <?php echo $student['date_naissance']; ?></p>
        <p><strong>Adresse</strong>: <?php echo $student['adresse']; ?></p>
        <p><strong>Sexe</strong>: <?php echo $student['sexe']; ?></p>
    </div>
<?php else: ?>
    <p>Étudiant introuvable.</p>
<?php endif; ?>

<!-- <div class="link"><p><a href="list-etudiants.php">Liste des étudiants</a></p></div> -->
</body>
</html>

<?php
$conn->close();
?>
