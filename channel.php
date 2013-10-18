<?php

	require_once("lib/espn.php");
	$espn = new espn();
	$action = "";
	
	if (isset($_POST["action"]) && $_POST["action"] != "") {
		$action = $_POST["action"];
	}
	
	switch ($action) {
		
		// Get selected league teams
		case "get_league_teams":
			$league_abbr = $_POST["league_abbr"];
			echo $espn->espn_get_league_teams($league_abbr);
		break;
		
		// Get team headlines
		case "get_team_headlines":
			$team_id = $_POST["team_id"];
			$league_abbr = $_POST["league_abbr"];
			echo $espn->espn_get_team_headlines($league_abbr, $team_id);
		break;
	}
	
?>