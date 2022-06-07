<html>
<?php
require_once 'includes/head.php';
require_once './mesClasses/Cmedicaments.php';
require_once 'includes/function.php';
session_start();
?>

<body>
    <?php
    $omedicaments = new Cmedicaments();
    $ocoll = $omedicaments->getMedicmentsTrie();
    //echo unserialize($_SESSION['visiteur'])->id;
    $lesMois = moisEnFrancais();
    ?>

    <div class="container">

        <header title="listemedicament"></header>
        <?php require_once 'includes/nav-bar.php'; ?>
        <h1>
            <p title="tabmedicament">Liste des médicaments proposés aux praticiens pour le mois de <?php echo $lesMois[date('F')] ?> <?php echo date('Y') ?>.</p>
        </h1>

        <table class="table table-condensed">
            <thead title="entetetabmedicament">
                <tr>
                    <th>Présentation</th>
                    <th>Nom du produit</th>
                    <th>Descriptif</th>

                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($ocoll as $omedicament) {

                ?>

                    <tr>
                        <td> <?php echo '<img class="imgTailleMaxiTab" src=' . $omedicament->image . ' alt="" />'; ?></td>
                        <td> <?php echo $omedicament->designation_med ?></td>
                        <td><?php echo $omedicament->description_med ?></td>
                        <td>
                            <input type="button" value="Description détaillée" class="btn btn-group-justified" onclick="javascript:location.href='pdf/<?php echo $omedicament->designation_med ?>.pdf'"></input>
                            <br>
                            
                    
                    

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>