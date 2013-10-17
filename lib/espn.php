<?php
	
	
	class espn {
		
		protected $api_uri = "http://api.espn.com/v1/sports/soccer/";
		protected $api_key = "f6hmra974ye89xhemku9dawx";
		
		function espn_get_league_info($league_abb) {			
			$api_url = $this->api_uri . $league_abb . "?apikey=" . $this->api_key;			
			$league_info = $this->espn_get($api_url);			
			
		}
		
		function espn_get_league_teams($league_abb) {
			
			$league_teams_info = array();
			$api_url = $this->api_uri . $league_abb . "/teams?apikey=" . $this->api_key;			
			$league_teams_info = $this->espn_get($api_url);
			$league_teams = $league_teams_info["sports"][0]["leagues"][0]["teams"];
			
			// Generate markup to be sent by Ajax
			return $this->espn_get_teams_markup($league_abb, $league_teams);
			
		}
		
		function espn_get_teams_markup($league_abb, $teams) {

			$rows = -1;
			foreach ($teams as $team) {

				$rows++;
				if ($rows == 0) $table .= "<div class='row'>";

				$id = $team["id"];
				$abbreviation = strtolower($team["abbreviation"]);
				$logo_src = "img/logos/{$league_abb}/{$abbreviation}" . ".png";
				$table .= "<div class='col-md-3'><img src='{$logo_src}' width='100px' data-team-id='{$id}'></div>";

				if ($rows == 3) {
				 	$table .= "</div>";
					$rows = -1;
				}
			}
			return $table;
		}
		
		function espn_get($uri) {
			return json_decode(file_get_contents($uri), true);
		}
		
	}


?>