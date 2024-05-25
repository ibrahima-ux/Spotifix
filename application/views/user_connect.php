<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h5>Connexion</h5>
    <section>
        <form action="traiterdonnee.php" method="post">
            <div>
                <label for="username">Identifiant:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Connexion</button>
            </div>
        </form>
    </section>
</body>
</html>
