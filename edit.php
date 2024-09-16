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

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

// Récupérer les informations de l'étudiant à modifier
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM etudiants WHERE id=$id");
    $student = $result->fetch_assoc();
}

// Mise à jour des informations de l'étudiant
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_student'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $parcours = $_POST['parcours'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $sexe = $_POST['sexe'];

    $sql = "UPDATE etudiants 
            SET nom='$nom', prenom='$prenom', parcours='$parcours', date_naissance='$date_naissance', adresse='$adresse', sexe='$sexe' 
            WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: list-etudiants.php"); // Redirection vers la page de la liste des étudiants après la mise à jour
        exit;
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
    <title>Modifier l'étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class="link"><p><a href="list-etudiants.php">Liste des étudiants</a></p></div>
    <p><a href="logout.php">Se déconnecter</a></p>
</header>
<body>

<h1>Modifier les informations de l'étudiant</h1>
<?php if ($student): ?>
    <form method="post" action="" id="add-form">
        <label>Nom: </label>
        <input type="text" name="nom" value="<?php echo $student['nom']; ?>" required><br>

        <label>Prénom: </label>
        <input type="text" name="prenom" value="<?php echo $student['prenom']; ?>" required><br>

        <label>Parcours: </label>
        <select name="parcours" required>
            <option value="Parcours 1" <?php if ($student['parcours'] == 'Parcours 1') echo 'selected'; ?>>Parcours 1</option>
            <option value="Parcours 2" <?php if ($student['parcours'] == 'Parcours 2') echo 'selected'; ?>>Parcours 2</option>
            <option value="Parcours 3" <?php if ($student['parcours'] == 'Parcours 3') echo 'selected'; ?>>Parcours 3</option>
        </select><br>

        <label>Sexe: </label>
        <span>
            <input type="radio" name="sexe" value="Masculin" <?php if ($student['sexe'] == 'Masculin') echo 'checked'; ?>> Masculin
            <input type="radio" name="sexe" value="Féminin" <?php if ($student['sexe'] == 'Féminin') echo 'checked'; ?>> Féminin<br>
        </span>

        <label>Date de Naissance: </label>
        <input type="date" name="date_naissance" value="<?php echo $student['date_naissance']; ?>" required><br>

        <label>Adresse: </label>
        <input type="text" name="adresse" value="<?php echo $student['adresse']; ?>" required><br>

        <button type="submit" name="update_student"><a href="list-etudiants.php">Mettre à jour</a></button>
    </form>
<?php else: ?>
    <p>Étudiant introuvable.</p>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
