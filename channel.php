<?php

	require_once("lib/espn.php");
	$espn = new espn();
	$action = "";
	
	if (isset($_POST["action"]) && $_POST["action"] != "") {
		$action = $_POST["action"];
	}
	
	switch ($action) {
		case "get_league_teams":
			$league_abbr = $_POST["league_abbr"];
			echo $espn->espn_get_league_teams($league_abbr);
		break;
	}
	
?>