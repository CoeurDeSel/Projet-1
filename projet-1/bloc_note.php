<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <?php
    session_start();
    require_once 'mesClasses/Cdao.php';
    require_once 'mesClasses/Cmedicaments.php';
    require_once 'includes/nav-bar.php';
    
    $onote = new Cdao();
    if (isset($_GET['note'])) {
        $otemporaire = unserialize($_SESSION['visiteur']);
        $id_visit = $otemporaire->id;
        //var_dump($id_visit);
        $omedicaments = new Cmedicaments();
        
        $sid_med = $_GET['id_med']; // Si je met 1 à la place de $_GET['id_med'], le médicament avec l'id 1 aura dans la table "presenter" une nouvelle note
        // Sauf qu'il n'arrive pas à trouver l'id_med au moment de l'envoie de la requête
    $onote->updateDataFromSql($id_visit, $sid_med, $_GET['note']);
    } else {}?>
    
    <body><!--Je voudrais récuperer l'id du médicaments qui était sur la même ligne que le bouton note personnelles que l'on a clicker-->
    <!--Le post id_med est bien trouvé en fonction du médicament-->
    <?php
    require_once 'mesClasses/Cpersomedicaments.php';
    $omedicaments = new Cpersomedicaments();
    $otemporaire = unserialize($_SESSION['visiteur']);
        $id_visit = $otemporaire->id;
    $u = $omedicaments->getNoteById($_GET['id_med'],$id_visit);
    
                            
    ?>
        <form action="" method='GET'>
        
        
            <p >La note présent sur ce médicament est : </p>
            <textarea  name="note"><?php echo $u?></textarea>
            <input type="hidden" name='id_med' value='<?php echo $_GET['id_med']?>' > 
            <!--<input type="text" name="note"></input>-->
            
            <input type="submit" value="Enregistrer" ></input>
        </form>
    </body>
</html>

<?php





/*if(file_exists("bloc_note.txt"))
{
echo "Le fichier bloc_note.txt existe";
    if (!touch('some_file.txt')) {
        echo 'Whoops, une erreur est survenue...';
    } else {
        echo 'L\'appel à la fonction touch() a réussi';
    }
}
else
{
echo "Le fichier n'existe pas";
}
$nom=' okFay';
echo $nom;
$machaine = shell_exec('mkdir'. $nom);
echo $machaine;
*/