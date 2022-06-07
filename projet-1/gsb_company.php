<!DOCTYPE html>

<html>

<?php
require_once 'includes/head.php';
require_once './mesClasses/Cvisiteurs.php';

session_start()
?>


<?php
$ovisiteurs = new Cvisiteurs();
$ocoll = $ovisiteurs->getVisiteursTrie();
require_once 'includes/nav-bar.php';
?>
<head>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body >

    <img src="img/gsb_icone.png" alt="">
    <h1 style="text-align:center ;">GSB Entreprise</h1>
    <div style="margin: 50px;">
        <h2 style="text-align:center ;">Description du laboratoire GSB</h2>
        <h3>Le secteur d'activité</h3>
        <p style="text-align:justify ;">L’industrie pharmaceutique est un secteur très lucratif dans lequel le mouvement de fusion acquisition est très fort. Les regroupements de laboratoires ces dernières années ont donné naissance à des entités gigantesques au sein desquelles le travail
            est longtemps resté organisé selon les anciennes structures. Des déboires divers récents autour de médicaments ou molécules ayant entraîné des complications médicales ont fait s'élever des voix contre une partie de l'activité des laboratoires
            : la visite médicale, réputée être le lieu d' arrangements entre l'industrie et les praticiens, et tout du moins un terrain d'influence opaque.
        </p>
        <h3>L'entreprise</h3>
        <p style="text-align:justify ;">Le laboratoire Galaxy Swiss Bourdin (GSB) est issu de la fusion entre le géant américain Galaxy (spécialisé dans le secteur des maladies virales dont le SIDA et les hépatites) et le conglomérat européen Swiss Bourdin (travaillant sur des médicaments
            plus conventionnels), lui même déjà union de trois petits laboratoires . En 2009, les deux géants pharmaceutiques ont uni leurs forces pour créer un leader de ce secteur industriel. L'entité Galaxy Swiss Bourdin Europe a établi son siège administratif
            à Paris. Le siège social de la multinationale est situé à Philadelphie, Pennsylvanie, aux Etats-Unis.
        </p>
    </div>
    <div class="headergsb"></div>
    <div style="height: 200px;
    margin-top: 30px;
    margin-bottom: 50px;
    background-image: url('https://medias.publidata.io/production/images/images/000/028/807/original/bandeau-laboratoire-grandparissud.jpg?1535119733');
    
    background-origin: content-box;
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: auto auto;"></div>
</body>
<?php ?>
