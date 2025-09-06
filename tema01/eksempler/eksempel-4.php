<?php
  $tall1=$_POST ["tall1"];
  $tall2=$_POST ["tall2"]; 
  $summen=$tall1 + $tall2;
  $differansen=$tall1 - $tall2;
  $produkt=$tall1 * $tall2;
  $kviotent=$tall1 / $tall2;

  print ("tall 1 er $tall1 <br />");
  print ("tall 2 er $tall2 <br />");
  print ("<br />");
  print ("summen er $summen <br />");
  print ("differansen er $differansen <br />");
  print ("produktet er $produkt <br />");
  print ("kviotenten er $kviotent <br />");
?>

