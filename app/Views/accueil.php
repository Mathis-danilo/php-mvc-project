<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url('/public/css/styles.css'); ?>" /> 
</head> 
<body>
<?php $titre = 'Accueil'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Visiteur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="getdata?action=index">Accueil</a>
        <a href="getdata?action=consulter_fiches_de_frais">Consulter</a>
        <a href="getdata?action=renseigner_fiche_de_frais">Renseigner</a>
        <span style="float:right; padding: 14px 20px; color: white;"></span>
    </div>
    <img src="logo.jfif" alt="Logo" style="float: right; height: 90px;">
    <h1>Bienvenue, Visiteur  </h1>
    <footer>
        <form method="post" class="logout-form">
            <button type="submit" name="logout" class="button">Déconnexion</button>
            
        </form>
    </footer>
</body>
</html>
