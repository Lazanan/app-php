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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_student'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $parcours = $_POST['parcours'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $sexe = $_POST['sexe'];

    $sql = "INSERT INTO etudiants (nom, prenom, parcours, date_naissance, adresse, sexe)
            VALUES ('$nom', '$prenom', '$parcours', '$date_naissance', '$adresse', '$sexe')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel étudiant ajouté avec succès";
    } else {
        echo "Erreur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class="link">
        <p><a href="list-etudiants.php">Liste des étudiants</a></p>
        <p><a href="logout.php">Se déconnecter</a></p>
    </div>
</header>
<body>
    <h1>Ajouter un étudiant</h1>
    <form method="post" action="" id="add-form">
    <label>Nom: </label>
    <input type="text" name="nom" required><br>

    <label>Prénom: </label>
    <input type="text" name="prenom" required><br>

    <label>Parcours: </label>
    <select name="parcours" required>
        <option value="Parcours 1">Parcours 1</option>
        <option value="Parcours 2">Parcours 2</option>
        <option value="Parcours 3">Parcours 3</option>
    </select><br>

    <label>Sexe: </label>
    <span>Masculin <input type="radio" name="sexe" value="Masculin" required><span>Féminin <input type="radio" name="sexe" value="Féminin" required></span></span>
    

    <label>Date de Naissance: </label>
    <input type="date" name="date_naissance" required><br>

    <label>Adresse: </label>
    <input type="text" name="adresse" required><br>

    <button type="submit" name="add_student">Ajouter</button>
</form>

<!-- <div class="link">
    <p><a href="list-etudiants.php">Liste des étudiants  <span class="arrow">&#8702</span></a></p>
    <p><a href="logout.php">Se déconnecter <span class="arrow">&#8702</span></a></p>
</div> -->
</body>
</html>

<?php
$conn->close();
?>
