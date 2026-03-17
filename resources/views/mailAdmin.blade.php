<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Compte Administrateur</title>
</head>
<body>
    <h2>Bonjour {{ $name }},</h2>
    <p>Votre compte administrateur a été créé avec succès.</p>
    <p>Voici vos informations de connexion :</p>
    <ul>
        <li>Email : {{ $name }}</li>
        <li>Mot de passe : {{ $password }}</li>
    </ul>
    <p>Veuillez changer votre mot de passe dès votre première connexion.</p>
</body>
</html>
