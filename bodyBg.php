<?php	
include("connection.php");
$username = $_SESSION["Paces"];
	include("retrieve.php");	
		if (is_null($userRow["Background"])) {
			$bg = $userRow["Cover_pic"];
			echo " style=\"background-image: url('$bg');\"";
		} else {
			$bg = explode(" ",$userRow["Background"]);

			//Background colour 1
			list($r1, $g1, $b1) = sscanf($bg[0], "#%02x%02x%02x");


			//Background colour 2
			list($r1, $g1, $b1) = sscanf($bg[1], "#%02x%02x%02x");


			echo " style='background: linear-gradient(54deg, ".$bg[0]." 0%, ".$bg[1]." 100%);'";
		}

		/*Notes: Background colour is saved as hexcode and convert into rgba for linear gradient*/
?>
