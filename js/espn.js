
var api = {
		
		init: function() {
			
			$('#choose-league .league').click(function () {
								
				// Add selected class
				$('#choose-league .league').removeClass("selected");
				$(this).addClass("selected");

				// Clear section
				$("#choose-team").html("").addClass("hide");				
				// Show loader
				$('#loader').removeClass("hide").addClass("show");
				
				// Object to send in request
				var data_obj = {  
					action: 'get_league_teams',
					league_abbr: $(this).find("img").data("abbreviation") 
				};							
				// Make request to server
				api.makeRequest(data_obj);				
			});			
		},
		
		// Make request to server
		makeRequest: function(d) {
		
			var action = d.action;
		
			$.ajax({			
				type: "POST",
				url: "../channel.php",
				data: d,
				error: function(error) {
					console.log(error);
				},				
				success: function(data) {
					
					switch (action) {
						case "get_league_teams":
							api.printLeagueTeams(data);
						break;
						case "get_team_info":
							//api.printLeagueTeams(data);
						break;
					}
				}
			});
		
		},
		
		// Get League Info
		printLeagueTeams: function(data) {
			
			// Print out teams grid
			$("#choose-team").html(data);
			// Hide loader
			$('#loader').removeClass("show").addClass("hide");
			// Fade in
			$("#choose-team").fadeIn("slow").removeClass("hide");					
			// Add click even to team
			$('#choose-team .team').click(function () {
				
				// Object to send in request
				var data_obj = {  
					action: 'get_team_info',
					team_id: $(this).find("img").data("team-id")
				};							
				// Make request to server
				api.makeRequest(data_obj);
			});			
		},
		
		// Get Team Info
		printTeamInfo: function(team_id) {
			
		}
	
};


$(document).ready(function() {	
	api.init();		
});