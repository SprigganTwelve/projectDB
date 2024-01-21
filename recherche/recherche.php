<?php
include("../config/connectDb.php");
$search = trim($_POST['search']);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link rel="stylesheet" href="../style/recherche.css">
</head>

<body>
    <header>
        <form action="" method="post">
            <a class="logo" href="../home/index.html"><span>LeBonCôté</span></a>
            <input name="search" class="search" placeholder="Rechercher sur LebonCôté">
            <input type="submit" id="send" name="submit" value="RECHERCHER">
        </form>
    </header>
    <div class="container">
        <div class="filter">
            <select name="tri" id="tri">
                <option value="">Tri</option>
                <option value="croissant">Prix croissants</option>
                <option value="decroissant">Prix décroissants</option>
                <option value="ancien">Plus anciennes</option>
                <option value="rcent">Plus récentes</option>
            </select>
            <select name="categorie" id="categorie">
                <option value="">Catégorie</option>
                <option value="vehicule">Vehicules</option>
                <option value="electronique">Electronique</option>
                <option value="immobilier">Immobilier</option>
            </select>
            <button>FILTRER</button>
        </div>
        <div class="sections">
            <?php
            if (isset($_POST['submit'])) {
                $query = mysqli_query($connexion, "SELECT * FROM `annonces` WHERE INSTR(titre,'$search')>0 OR INSTR(description,'$search')>0 OR INSTR(categorie,'$search')>0") or die('Requete échouée');
                while ($row = mysqli_fetch_assoc($query)) {
                    $image = $row["image"];
                    $titre = $row["titre"];
                    $prix = $row["prix"];
                    $date_publication = $row["date_publication"];

                    $user_id = $row["user_id"];
                    $queryUser = mysqli_query($connexion, "SELECT * FROM `utilisateurs` WHERE id=$user_id") or die('Requete échouée');
                    $user = mysqli_fetch_assoc($queryUser);
                    $userNom = $user['nom'];
                    $userPrenom = $user['prenom'];

                    echo '<section>
                            <div class="user">
                                <img src="../image/avatar.jpg">
                                <span>' . $userNom . ' ' . $userPrenom . '</span>
                            </div>
                            <img class="photo" src="../image' . $image . ' alt="PHOTO ARTICLE">
                            <span class="titre">' . $titre . '</span>
                            <span class="prix">' . $prix . ' €</span>
                            <span class="date">' . $date_publication . '</span>
                        </section>';
                }

            } ?>
        </div>
    </div>

</body>

</html>