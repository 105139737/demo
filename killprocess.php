<?php 
include("config.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
	   define ( 'MAX_SLEEP_TIME', 5 );
		$result = mysqli_query ($conn,"SHOW PROCESSLIST");
		while ( $proc = mysqli_fetch_assoc ( $result ) ) {
		    echo $proc ["Command"];
        	if ($proc ["Command"] == "Sleep" && $proc ["Time"] > MAX_SLEEP_TIME) {
                @mysqli_query ("KILL " . $proc ["Id"],$conn);
              echo $display = "KILL " . $proc ["Id"] . "<br />";
                
			}
		}

?>