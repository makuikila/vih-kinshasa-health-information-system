<?php
session_start();
$serveur = "localhost";
$login = "root";
$pass = "";

try{
    $connection = new PDO("mysql:host=$serveur;dbname=vihsida", $login, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    echo 'connection à la base de données réussit';
}
catch(PDOException $e){
    echo 'Echec :' .$e->getMessage();
}

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Graphique</title>
        <link rel="stylesheet" type="text/css" href="form7.css"/>
    </head>
    <body>
        <header>
            <img src="sida.png" class="float1"/>
            <img src="sida.png" class="float2" />
        </header>
        
        <div align="center">
            <section class="insc" style="width: 800px;height: 1300px;">
                <h3><strong class="first">Différents graphiquesS</strong></h3>
                <br/><br/>
                <p> <?php echo "<img src='./graph1.php'/>"; ?></p>
                
                        <button type="submit" formaction="http://localhost/project/rapporteur.php" align="center">Annuler</button>
                    </div> 
                
                <?php

               
                ?>
            </section>
            <br/><br/>
            
        </div>
    </body>

</html>