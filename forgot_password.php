<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $email = $_POST['email'];

    if ($email == "radznantenaina@gmail.com") {
        // Envoyer un email avec le code de réinitialisation "123456"
        $to = $email;
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Votre code de réinitialisation est : 123456";
        $headers = "From: admin@etudiantsite.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Un email avec un code de réinitialisation a été envoyé.";
        } else {
            echo "Échec de l'envoi de l'email.";
        }
    } else {
        echo "Email non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
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
            width: auto;
        }

        label {
            color: #6921bb;
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
            text-align: left;
        }

        input[type="email"] {
            width: 90%;
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
    <form method="post" action="forgot_password.php">
        <h2>Réinitialisation</h2>
        <label>Email: </label>
        <input type="email" name="email" required><br>

        <button type="submit" name="reset_password">Envoyer un code de reinitialisation</button>
    </form>
</body>
</html>
