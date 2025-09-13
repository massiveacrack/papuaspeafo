<?php
 $gift=$_POST ["gift"];
 $barn=$_POST ["barn"];

    if ($gift=="" || $barn=="") {
        print ("Du har ikke svart på alle spørsmålene, vennligst prøv igjen! <br />");
    }


    if ($gift=="j" && $barn=="j") {
        print ("Du er gift og har barn <br />");
    }
  
    if ($gift=="j" && $barn=="n") {
        print ("Du er gift og har ikke barn <br />");
    }

    if ($gift=="n" && $barn=="j") {
        print ("Du er ikke gift og har barn <br />");
    }

    if ($gift=="n" && $barn=="n") {
        print ("Du er ikke gift og har ikke barn <br />");
    }

    else {
        print ("Ugyldig svar, vennligst svar med j eller n <br />");
    }
?>