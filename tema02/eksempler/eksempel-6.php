<?php
    $tall1=$_POST ["tall1"];
    $tall2=$_POST ["tall2"];

    print ("Tall 1 er $tall1 og Tall 2 er $tall2 <br />");

        if ($tall1=="" || $tall2=="") {
            print ("Du har ikke tastet inn begge tallene, vennligst prøv igjen! <br />");
            exit;
        }

        else if ($tall1 > $tall2) {
            print ("$tall1 er høyere enn $tall2 <br />");
        }

        else if ($tall1 < $tall2) {
            print ("$tall2 er høyere enn $tall1 <br />");
        }

        else if ($tall1 == $tall2) {
            print ("$tall1 og $tall2 er like verdi <br />");
        }

        else {
            print ("Ugyldig input, vennligst tast inn to tall <br />");
            exit;
        }
?>