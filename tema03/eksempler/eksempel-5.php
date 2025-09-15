<?php

$sum=0;

for ($tall=1;$tall<=10;$tall++) { 
     $sum=$sum+$tall;
     $gjennomsnitt = $sum/10;
    }

    {
        print("Summen av tallene 1-10 er lik $sum ");
        print("<br />");
        print("Gjennomsnittet av tallene 1-10 er lik $gjennomsnitt"); 
    }

?>