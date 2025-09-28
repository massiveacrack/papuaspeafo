<?php 

function fulltNavn($fornavn,$etternavn)
{
  $navn=$fornavn . " " . $etternavn;	
  return $navn; 	
}

  $fornavn=$_POST ["fornavn"];
  $etternavn=$_POST ["etternavn"];  

  $navn=fulltNavn($fornavn,$etternavn);

  print ("Navnet er $navn");  
?>