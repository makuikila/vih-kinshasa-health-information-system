<?php
session_start();
$serveur = "localhost";
$login = "root";
$pass = "";
try{
    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    
}
catch(PDOException $e){
    echo 'Echec :' .$e->getMessage();
}

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Infirmier</title>
        <link rel="stylesheet" type="text/css" href="form23.css" />
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="page 1.html">Accueil</a></li>
                    <li><a href="http://localhost/project/deconnexion.php">Déconnection</a></li>                     
                </ul>
            </nav>
        </header>
        <div class="emballage">
                <div class="contenant">
                    <h1 class="titre">SAISIE DES DONNEES</h1>
                    <form method="POST" action="rapporteur.php">
                        <div class="fieldset">
                            <button type=submit formaction="http://localhost/project/fiche.php" align="center">Enregistrer nouveau patient</button><br/>
                            <button type=submit formaction="http://localhost/project/unite.php">Ajouter des informations</button><br/>
                            <button type=submit formaction="http://localhost/pdf_project/unite.php">Liste ds malades</button>
                        </div>    
                    </form>
                    
                </div>
        </div>        
    </body>

</html>
