<?php 

  include("funksjoner.php");  

  $fornavn=$_POST ["fornavn"];
  $etternavn=$_POST ["etternavn"];  

  $navn=fulltNavn($fornavn,$etternavn);

  print ("Navnet er $navn");  

?>