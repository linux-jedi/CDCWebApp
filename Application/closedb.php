<?php
// closes the mysql database connection
if(isset($read))
{
	$read->close();
}

if(isset($write))
{
	$write->close();
}

?>
