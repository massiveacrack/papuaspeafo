<?php
    $svar=$_POST ["svar"];
        if ($svar=="") {
            print ("Du har ikke svart, vennligst prøv igjgen! <br />");
        }
        else if ($svar=="j") | ($svar=="J") | ($svar==("ja") | ($svar=="Ja") ) {
            print("Du har svart ja, på spørsmålet om du er student");
        }
        else if ($svar=="n") | ($svar==("N") | ($svar=="nei") | ($svar=="Nei")) {
            print("Du har svart nei, på spørsmålet om du er student");
        }
        else {
            print("Ugyldig svar, vennligst svar med j eller n");
        }
?>