<?php
	$err = "Bad Request";

	if (isset($_GET["e"]))
		$err = urldecode($_GET["e"]);

	header("Content-Type: application/json");
	die(json_encode(
			array(
				"status"	=> "error"
				, "data"	=> array(
									"uuid"	=> ""
									, "message"	=> ""
								)
				, "error"	=> array(
									"errorType"	=> $err
								)
			)
		)
	);
