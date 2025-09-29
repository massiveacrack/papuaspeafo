<?php 

  include("db-tilkobling.php");  

  $sqlSetning="SELECT * FROM poststed;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
  
	
  $antallRader=mysqli_num_rows($sqlResultat);  

  print ("<h3>Registrerte poststeder</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>postnr</th> <th align=left>poststed</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  
      $postnr=$rad["postnr"];
      $poststed=$rad["poststed"]; 

      print ("<tr> <td> $postnr </td> <td> $poststed </td> </tr>");
    }
  print ("</table>"); 
?>