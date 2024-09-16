<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_reset'])) {
    $reset_code = $_POST['reset_code'];
    $new_password = $_POST['new_password'];

    if ($reset_code == "123456") {
        // Hacher le nouveau mot de passe
        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

        // Simuler la mise à jour du mot de passe dans la base de données
        echo "Votre mot de passe a été réinitialisé avec succès.";
    } else {
        echo "Code de réinitialisation incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            background-image: url(bg.svg);
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #6921bb;
        }

        form {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            color: #6921bb;
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
            text-align: left;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 2px solid #6921bb;
            border-radius: 5px;
        }

        button {
            background-color: #6921bb;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }

        button:hover {
            background-color: #501a93;
        }
    </style>
</head>
<body>
    <form method="post" action="reset_password.php">
        <h2>Réinitialisation du mot de passe</h2>
        <label>Entrez le code reçu : </label>
        <input type="text" name="reset_code" required><br>

        <label>Nouveau mot de passe : </label>
        <input type="password" name="new_password" required><br>

        <button type="submit" name="confirm_reset">Confirmer la réinitialisation</button>
    </form>
</body>
</html>
