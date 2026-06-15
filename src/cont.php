<?php


?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>fiche patient</title>
        <link rel="stylesheet" type="text/css" href="form3.css"/>
    </head>
    <body>
        
                        <br/>
                        <label for="nomcas" class="adr2"><strong class="second">Noms :</strong></label>    
                        <input type="text" placeholder="Exemple: LUKOMBO Albert" id="nomcas" name="nomcas" value="" class="adr"/>
                        <br/>                             
                        <label for="agecas" class="adr2"><strong class="second">Age :</strong></label>    
                        <input type="number" id="agecas" name="agecas" value="" class="num"/>
                        <br/>
                            <table> 
                                <tr>    
                                    <td class="sex"><label class="sex"><strong class="second">Sexe :</strong></label></td>    
                                    <td><input type="radio" name="sexecas" value="masculin" id="mascullinc"  /> <label for="masculinc" class="m"><strong class="second" title="Homme">M</strong></label><input type="radio" name="sexecas" value="feminin" id="femininc"/> <label for="femininc" class="m1"><strong class="second" title="Femme">F</strong></label></td>
                                </tr>
                               
                                <tr>
                                    <td class="sex"><label class="sex"><strong class="second">Dépisté VIH + :</strong></label></td>    
                                    <td><input type="radio" name="positifcas" value="oui" id="ouic1"  /> <label for="ouic1" class="m"><strong class="second">OUI</strong></label><input type="radio" name="positifcas" value="non" id="nonc1"/> <label for="nonc1" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                                <tr>
                                    <td class="sex"><label class="sex"><strong class="second">Ayant retiré le résultat :</strong></label></td>   
                                    <td><input type="radio" name="retraitcas" value="oui" id="ouic2"  /> <label for="ouic2" class="m"><strong class="second">Oui</strong></label><input type="radio" name="retraitcas" value="non" id="nonc2"/> <label for="nonc2" class="m1"><strong class="second">Non</strong></label></td>

                                </tr>
                                <tr>
                                    <td class="sex"><label class="sex"><strong class="second">Sous ARV :</strong></label></td>   
                                    <td><input type="radio" name="arvcas" value="oui" id="ouic3"  /> <label for="ouic3" class="m"><strong class="second">Oui</strong></label><input type="radio" name="arvcas" value="non" id="nonc3"/> <label for="nonc3" class="m1"><strong class="second">Non</strong></label></td>
                                </tr>
                            </table>
                            <hr/>
                            <table>
    </body>

</html>