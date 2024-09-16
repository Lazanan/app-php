<?php
session_start();

$servername = "localhost";
$username = "etudiant_user";
$password = "azertyuiop";
$dbname = "etudiants_db";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

$err = "";
// Utilisateur spécifique (email et mot de passe haché)
$admin_email = "radznantenaina@gmail.com";
$admin_password_hash = password_hash("a", PASSWORD_BCRYPT); 

// Connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == $admin_email && password_verify($password, $admin_password_hash)) {
        // Connexion réussie
        $_SESSION['user_id'] = 1;  
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;
        header("Location: app.php");
        exit;
    } else {
        $err =  "Email ou mot de passe incorrect.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Style général pour le corps */
        body {
            font-family: Arial, sans-serif;
            background-image: url(bg.svg);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #8a21bb;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Style du conteneur de connexion */
        .login-container {
            background-color: white;
            width: 400px;
            padding: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Style des champs de formulaire */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Style du bouton de connexion */
        button {
            padding: 12px;
            background-color: #8a21bb;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #701997;
        }

        /* Lien mot de passe oublié */
        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #8a21bb;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Connexion</title>
</head>
<body>
    <div class="login-container">
        <form method="post" action="index.php">
            <h2>Connexion</h2>
            <?php
                if ($err){
                    echo "<div style='color: red; padding: 0rem 0rem 1rem 0rem;'>$err!!</div>";
                    $err="";
                }
            ?>
            <label>Email: </label>
            <input type="email" name="email" required><br>
    
            <label>Mot de passe: </label>
            <input type="password" name="password" required><br>
    
            <button type="submit" name="login">Se connecter</button>
        </form>
        <p><a href="forgot_password.php">Mot de passe oublié ?</a></p>
    </div>

</body>
</html>

