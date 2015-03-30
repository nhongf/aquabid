<?php 
$timezone  = +7; //(GMT +7:00)  
echo gmdate("M j, Y H:i:s O", time() + 3600*($timezone+date("0"))); 
?>