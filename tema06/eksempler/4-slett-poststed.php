<?php  /* slett-poststed */
/*
/*  Programmet lager et skjema for å velge et poststed som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett poststed</h3>

<form method="post" action="" id="slettPoststedSkjema" name="slettPoststedSkjema" onSubmit="return bekreft()">
  Poststed 
  <select name="postnr" id="postnr">
    <option value="">velg postnr</option>
    <?php include("dynamiske-funksjoner.php"); listeboksPostnr(); ?> 
  </select>  <br/>
  <input type="submit" value="Slett poststed" name="slettPoststedKnapp" id="slettPoststedKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettPoststedKnapp"]))
    {
      $postnr=$_POST ["postnr"];	  
	  
      if (!$postnr)
        {
          print ("Det er ikke valgt noe poststed"); 

        }
      else
        {	  		 
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */
	
          $sqlSetning="DELETE FROM poststed WHERE postnr='$postnr';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
            /* SQL-setning sendt til database-serveren */
		
          print ("F&oslash;lgende poststed er n&aring; slettet: $postnr  <br />");
        }	
    }
?> 
