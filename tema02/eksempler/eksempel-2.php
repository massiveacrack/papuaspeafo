<?php
    $svar=$_POST ["svar"];
        if (!$svar="") {
            print ("Du har ikke svart, vennligst prøv ijgen! <br />");
        }
        else if ($svar=="j") {
            print("Du har svart ja, på spørsmålet om du er student");
        }
        else if ($svar=="n"); {
            print("Du har svart nei, på spørsmålet om du er student");
        }
        else ($svar==""=); {
            print("Ugyldig svar, vennligst svar med j eller n");
        }
?>