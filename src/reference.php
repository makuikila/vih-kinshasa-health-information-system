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
$id1='AMBA';
$reque2='SELECT * From t_zone where denom_zone=\''. $id1 .'\'';
$use= $connection->prepare($reque2);
$use->execute(array());
$user=$use->fetch();
$id2='FUNA';
$reque3='SELECT * From t_zone where denom_zone=\''. $id2 .'\'';
$use2= $connection->prepare($reque3);
$use2->execute(array());
$user1=$use2->fetch();
$id3='KOKOLO';
$reque4='SELECT * From t_zone where denom_zone=\''. $id3 .'\'';
$use3= $connection->prepare($reque4);
$use3->execute(array());
$user2=$use3->fetch();
$id4='LUKUNGA';
$reque5='SELECT * From t_zone where denom_zone=\''. $id4 .'\'';
$use4= $connection->prepare($reque5);
$use4->execute(array());
$user3=$use4->fetch();
$id5='TSHANGU';
$reque6='SELECT * From t_zone where denom_zone=\''. $id5 .'\'';
$use5= $connection->prepare($reque6);
$use5->execute(array());
$user4=$use5->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Reference</title>
        <link rel="stylesheet" type="text/css" href="form.css" />
       
    </head>
    <body>
        <div style="margin=auto;">
            <table id="tete">
                <tr>
                    <td id="td"><img src=armoire.png style="float:left;width: 80px;height: 80px;"/></td>
                    <td id="td"><table><tr><tdid="td">REPUBLIQUE DEMOCRATIQUE DU CONGO</td></tr><tr><td id="td">PROGRAMME NATIONAL DE LUTTE CONTRE LE VIH</td></tr></table></td>
                    <td id="td"><img src=pnmls.png style="float:right;;width: 80px;height: 80px;"/></td>
                </tr>
            </table>
        </div>
        <section id="aide">
            <table>
                <tr>        
                    <td align="centrer">
                        <a href="amba.html"> 
                            <article>
                                <p class="contenant"> Zone de Santé de <?php echo $user['denom_zone']; ?></p>
                                <p class="contenant">Adresse : <?php echo $user['localisation']; ?></p> 
                                <p class="contenant">Contact :  <?php echo $user['telephone']; ?>  </p >       
                             
                            </article>
                        </a>
                    </td>
                    <td>
                        <a href="funa.html"> 
                            <article>
                                <p class="contenant"> Zone de Santé de <?php echo $user1['denom_zone']; ?></p>
                                <p class="contenant">Adresse : <?php echo $user1['localisation']; ?></p> 
                                <p class="contenant">Contact :  <?php echo $user1['telephone']; ?>  </p >
                            </article>
                        </a>
                    </td>
                </tr>
                <tr>        
                    <td>
                        <a href="kokolo.html"> 
                            <article>
                               
                                <p class="contenant"> Zone de Santé de <?php echo $user2['denom_zone']; ?></p>
                                <p class="contenant">Adresse : <?php echo $user2['localisation']; ?></p> 
                                <p class="contenant">Contact :  <?php echo $user2['telephone']; ?>  </p >
                                
                                
                                
                            </article>
                        </a>
                    </td>
                    <td>
                        <a href="LUKUNGA.html"> 
                            <article>
                                <p class="contenant"> Zone de Santé de <?php echo $user3['denom_zone']; ?></p>
                                <p class="contenant">Adresse : <?php echo $user3['localisation']; ?></p> 
                                <p class="contenant">Contact :  <?php echo $user3['telephone']; ?>  </p >
                                
                            </article>
                        </a>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <a href="tshangu.html"> 
                            <article>
                                <p class="contenant"> Zone de Santé de <?php echo $user4['denom_zone']; ?></p>
                                <p class="contenant">Adresse : <?php echo $user4['localisation']; ?></p> 
                                <p class="contenant">Contact :  <?php echo $user4['telephone']; ?>  </p >
                            </article>
                        </a>
                    </td>
                </tr>
            </table>
        </section>
        
        <div class="contact">
            <div align=center>
                <strong class="cont">Principaux parténaires de la lutte contre le VIH/SIDA</strong><br/>
                <img src="onusida.png" style="width=50px;height=50px;" />
                <img src="pnmls.png" /><br/>
                <strong class="cop">&#169 Copyright 2021</strong>
                
            </div>
            
        </div>   
        
        
        
    </body>
</html>