<?php
    $tall1=$_POST ["tall1"];
    $tall2=$_POST ["tall2"];
    $operasjon=$_POST ["operasjon"];

    print ("Tall 1 er $tall1 og Tall 2 er $tall2 <br />");
    
        if ($operasjon=="1") {
            print ("Valgt operasjon er addisjon <br />");
        }

        else if ($operasjon=="2"){
            print ("Valgt operasjon er subtraksjon <br />");
        }

        else if ($operasjon=="1") {
            $svar=$tall1+$tall2;
        
        print ("$tall1 + $tall2 = $svar <br />");
        }
        
        else if ($operasjon=="2") {
            $svar=$tall1-$tall2;

            print ("$tall1 - $tall2 = $svar <br />");   
        }

        else if ($operasjon=="3") {
            $svar=$tall1*$tall2;

            print ("$tall1 * $tall2 = $svar <br />");
        }

        else if ($operasjon=="4") {
            if ($tall2==0) {
                print ("Kan ikke dele med 0! <br />");
                exit;
            }
            $svar=$tall1/$tall2;

            print ("$tall1 / $tall2 = $svar <br />");
        }
        else {
            print ("Ugyldig operasjon, vennligst tast 1,2,3,4 for å velge regneoperasjon <br />");
            exit;
        }