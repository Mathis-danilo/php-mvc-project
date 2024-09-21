<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Renseigner-visiteurMedicale</title>
    <link rel="stylesheet" href="<?php echo base_url('/public/css/style.css'); ?>" />
</head>
<body class="acceuil">
    <nav>
        <div class="logo">
            <img src="<?php echo base_url('public/images/logo.png'); ?>" alt="Logo">
        </div>
        <ul>
            <li><a href="getdata?action=acceuil_visi">Accueil</a></li>
            <li><a href="getdata?action=renseigner">Renseigner fiche frais</a></li>
            <li><a href="getdata?action=consulter">Consulter fiche frais</a></li>
            <li><a href="getdata?action=deconnexion">Déconnexion</a></li>
        </ul>
    </nav>

    <form method="POST" action="postdata">
        <select id="mois" name="mois">
            <option value="01">Janvier</option>
            <option value="02">Février</option>
            <option value="03">Mars</option>
            <option value="04">Avril</option>
            <option value="05">Mai</option>
            <option value="06">Juin</option>
            <option value="07">Juillet</option>
            <option value="08">Août</option>
            <option value="09">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Décembre</option>
        </select>
        <input type="submit" name="Consulter" value="Consulter">
    </form>

    <div class="principale">
        <h2>Fiche Frais pour le mois de <?php echo $mois; ?></h2>

        <!-- Table pour les frais forfaitaires -->
        <h4>Les frais forfait du mois</h4>
        <table border='1'>
            <tr>
                <th>ID du visiteur</th>
                <th>Mois</th>
                <th>ID Frais</th>
                <th>Quantité</th>
            </tr>
            <?php if (!empty($fiches['ligneFraisForfait'])): ?>
                <?php foreach ($fiches['ligneFraisForfait'] as $fraisForfait): ?>
                    <tr>
                        <td><?php echo $fraisForfait->idVisiteur; ?></td>
                        <td><?php echo $fraisForfait->mois; ?></td>
                        <td><?php echo $fraisForfait->idFraisForfait; ?></td>
                        <td><?php echo $fraisForfait->quantite; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun frais forfait trouvé pour ce mois.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Table pour les frais hors forfait -->
        <h4>Les frais hors forfait du mois</h4>
        <table border='1'>
            <tr>
                <th>ID Fiche</th>
                <th>ID Visiteur</th>
                <th>Mois</th>
                <th>Description</th>
                <th>Date</th>
                <th>Montant</th>
            </tr>
            <?php if (!empty($fiches['ligneFraisHorsForfait'])): ?>
                <?php foreach ($fiches['ligneFraisHorsForfait'] as $fraisHorsForfait): ?>
                    <tr>
                        <td><?php echo $fraisHorsForfait->id; ?></td>
                        <td><?php echo $fraisHorsForfait->idVisiteur; ?></td>
                        <td><?php echo $fraisHorsForfait->mois; ?></td>
                        <td><?php echo $fraisHorsForfait->libelle ?></td>
                        <td><?php echo $fraisHorsForfait->date; ?></td>
                        <td><?php echo $fraisHorsForfait->montant; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun frais hors forfait trouvé pour ce mois.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>