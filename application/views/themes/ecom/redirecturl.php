<?php 	$this->load->third_party('ccavenue','Aes.php' ); ?>

<?php

/*

	This is the sample RedirectURL PHP Page. It can be directly used for integration with CCAvenue if your application is developed in PHP. You need to simply change the variables to match your variables as well as insert routines for handling a successful or unsuccessful transaction.

	return values i.e the parameters below are passed as POST parameters by CCAvenue server 
*/


//---------------------------------------------------------------------------------------------------------------------------------//

//error_reporting(0);
$workingKey='mpzss96a1cy0wao6jdpdav9w9nojwmo4';		//Working Key should be provided here.
$encResponse=$_POST["encResponse"];			//This is the response sent by the CCAvenue Server


$rcvdString=decrypt($encResponse,$workingKey);		//AES Decryption used as per the specified working key.


$decryptValues=explode('&', $rcvdString);
$dataSize=sizeof($decryptValues);

echo "

<br /><br /><br /><br /><br />
<center>";
echo "<table cellspacing=4 cellpadding=4>"; 
for($i = 0; $i < $dataSize; $i++) 
{
	$information=explode('=',$decryptValues[$i]);
    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
}

echo "</table>";
echo "</center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";


?>
