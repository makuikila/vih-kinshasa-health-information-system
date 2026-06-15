<?php


?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Vente</title>
        <link rel="stylesheet" type="text/css" href="vent.css"/>
    </head>
    <body>
        <p class="bouton">
            <div align=right>
                <ul id="menu-demo3">
                    <li><strong><a href="accueil.html">ACCUEIL</a></strong></li>                    
                </ul>
            </div>
        </p>
        <div align="center">
            <section class="insc">
                <h3><strong class="first">Enregistrement de la vente</strong></h3>
                <br/>
                <form method="POST" action="">
                    <table>
                        <tr>
                            <td align="right"><label ><strong class="second">La couleur de la voiture :</strong></label><br/><br/></td>    
                            
                            <td align="right"><input type="radio" name="couleur" value="rouge" id="rouge" checked="checked"/> <label for="rouge"><strong class="second21">ROUGE</strong></label><input type="radio" name="couleur" value="jaune" id="jaune" /> <label for="jaune"><strong class="second22">JAUNE</strong></label><br/><br/></td>
                        </tr>
                        <tr>
                            <td align="right"><label ><strong class="second">Le style de la voiture :</strong></label><br/><br/></td>    
                            
                            <td align="right"><input type="radio" name="types" value="staff" id="staff" checked="checked" /> <label for="staff"><strong class="second">STAFF</strong></label><td align="right"><input type="radio" name="types" value="sport" id="sport"  /> <label for="sport"><strong class="second">SPORT</strong></label><br/><br/></td>
                        </tr>
                        <tr>
                            <td align="right"><label ><strong class="second">Quelle est son origine :</strong></label><br/><br/></td>    
                            
                            <td align="right"><input type="radio" name="origine" value="domicile" id="domicile" checked="checked"/> <label for="domicile"><strong class="second2">DOMICILE</strong><td align="right"><input type="radio" name="origine" value="importer" id="importer" /> <label for="importer"><strong class="second2">IMPORTE</strong><br/><br/></td>
                        </tr>
                        <tr>
                            <td align="right"><label ><strong class="second">La voiture a été vendu ? :</strong></label><br/><br/></td>    
                            
                            <td align="right"><input type="radio" name="acheté" value="oui" id="oui" checked="checked"/> <label for="oui"><strong class="second2">OUI</strong><td align="right"><input type="radio" name="acheté" value="non" id="non" /> <label for="non"><strong class="second2">NON</strong><br/><br/></td>
                        </tr>
                        
                    </table>
                    <br/>
                    <input type="submit" name="formvente" Value="Ajouter" style="float:center; padding:8px; font-size: 10px; color:rgb(251, 251, 253); background-color: rgb(109, 2, 61); font-weight: bold; text-transform: uppercase; border-radius: 4px; font-family: Georgia, 'Times New Roman', Times, serif;"/>
                </form>
                
                
            </section>
            <br/><br/>
            <div align="center"><p class="conn"><a href="http://tp/affichage.php"><strong>Verifier l'état des ventes !</strong></a></p></div>
            <p><img src="logo2.png" width=10% height=10% alt="le logo de la firme" /></p>
        </div>
    </body>
</html>