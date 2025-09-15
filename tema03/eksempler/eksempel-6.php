<?php

$angittTall=$_POST["angittTall"];
if ($angittTall>0)
{
    print("Du ikke valgt en positiv og hell tall" <br />);
}
else ($angittTall=<0)
{ 
    for ($tall=1;$tall<=$angittTall;$tall++)
    {
    print("$tall <br />");
    }
}

?>
    