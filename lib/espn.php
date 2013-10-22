<?php
		
	class espn {
		
		protected $api_uri = "http://api.espn.com/v1/sports/soccer/";
		protected $api_key = "YOUR_KEY_HERE";
		
		/**
		*   Get league info list
		*/	
		function espn_get_league_info($league_abb) {			
			$api_url = $this->api_uri . $league_abb . "?apikey=" . $this->api_key;			
			$league_info = $this->espn_get($api_url);		
		}
		
		/**
		*   Get league teams info list
		*/
		function espn_get_league_teams($league_abb) {
			
			$league_teams_info = array();
			$api_url = $this->api_uri . $league_abb . "/teams?apikey=" . $this->api_key;			
			$league_teams_info = $this->espn_get($api_url);
			$league_teams = $league_teams_info["sports"][0]["leagues"][0]["teams"];
			
			// Generate markup to be sent by Ajax
			return $this->espn_get_teams_markup($league_abb, $league_teams);
		}
				
		/**
		*   Get league teams grid markup string
		*/
		function espn_get_teams_markup($league_abb, $teams) {

			$rows = -1;
			$table = "";
			foreach ($teams as $team) {

				$rows++;
				if ($rows == 0) $table .= "<div class='row'>";

				$team_id = $team["id"];
				$team_abbreviation = strtolower($team["abbreviation"]);
				$team_name = $team["location"];
				$team_logo = "img/logos/{$league_abb}/{$team_abbreviation}" . ".png";
				$team_color = $team['color'];
				
				$table .= "<div class='col-md-3 team' data-team-id='{$team_id}' data-color='{$team_color}'>";
				$table .= "<img src='{$team_logo}'>";
				$table .= "<span>{$team_name}</span>";
				$table .= "</div>";

				if ($rows == 3) {
				 	$table .= "</div>";
					$rows = -1;
				}
			}
			return $table;
		}
		
		/**
		*   Get team headlines markup string
		*/
		function espn_get_headlines_markup($team_headlines) {
			
			$list = "";
			if (count($team_headlines) > 0) {				
				$list .= '<ul>';
				foreach ($team_headlines as $headline) {
					$headline_link = $headline["links"]["web"]["href"];
					$headline_text = $headline["headline"];
					$list .= "<li><a href='{$headline_link}' target='_blank'>{$headline_text}</a></li>"; 
				}
				$list .= '<ul>';
			} else {
				$list = "<p>There are no news for this team</p>";
			}		
			
			return $list;
		}
		
		/**
		*   Get team headlines and return json string
		*/
		function espn_get_team_headlines($league_abb, $team_id) {
			
			$team_headlines = array();
			$obj = array();
			$api_url = $this->api_uri . $league_abb . "/teams/{$team_id}/news?apikey=" . $this->api_key;	
			
			$team_headlines_info = $this->espn_get($api_url);
			// Return only first 6 headlines
			$team_headlines = array_slice($team_headlines_info["headlines"], 0, 6);
			
			// Create object to transform to JSON string to be sent
			$obj['team_id'] = $team_id;
			$obj['markup'] = $this->espn_get_headlines_markup($team_headlines);
			return json_encode($obj);
		}
		
		/**
		*   Get json content from API uri and return array
		*/
		private function espn_get($uri) {
			return json_decode(file_get_contents($uri), true);
		}
		
	}


?>
