<?php
 $gift=$_POST ["gift"];
 $barn=$_POST ["barn"];

    if ($gift=="" || $barn=="") {
        print ("Du har ikke svart på alle spørsmålene, vennligst prøv igjen! <br />");
    }


    if ($gift=="j" && $barn=="j") {
        print ("Du er gift og har barn <br />");
    }
  