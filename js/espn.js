
var current_league;
var api = {

		init: function() {
			
			$('#choose-league .league').click(function () {
				
				// Current league viewed 
				current_league = $(this).find("img").data("abbreviation");
												
				// Add selected class
				$(this).addClass("selected");
				$('#choose-league .league').not(this).removeClass("selected");				

				// Clear section
				//$("#choose-team").html("").addClass("hide");				
				$("#choose-team").fadeOut(300, function() {
					// Show loader
					$('#loader').removeClass("hide").addClass("show");
				});
				
				// Object to send in request
				var data_obj = {  
					action: 'get_league_teams',
					league_abbr: current_league
				};							
				// Make request to server
				api.makeRequest(data_obj);				
			});			
		},
		
		// Make request to server
		makeRequest: function(d) {
		
			var action = d.action;
		
			// Request to server
			$.ajax({			
				type: "POST",
				url: "../channel.php",
				data: d,
				error: function(error) {
					console.log("An error has ocurred " + error);
				},				
				success: function(data) {
					
					// Do stuff based on action value
					switch (action) {
						case "get_league_teams":
							api.printLeagueTeams(data);
						break;
						case "get_team_headlines":
							api.printTeamHeadlines(data);
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
			$("#choose-team").fadeIn(300).removeClass("hide");	
	
			// Add click even to team
			$('#choose-team .team').click(function () {
				
				// Object to send in request
				var data_obj = {  
					action: 'get_team_headlines',
					league_abbr: current_league,
					team_id: $(this).find("img").data("team-id")
				};							
				// Make request to server
				api.makeRequest(data_obj);
			});	
			
		},
		
		// Get Team Headlines
		printTeamHeadlines: function(data) {
			
			// Json to obj
			var obj = JSON.parse(data);			
			// Active team image
			$team_img_clicked = $("[data-team-id='" + obj.team_id + "']");			
			// Active team
			$team_clicked = $team_img_clicked.parent('.team');
			// Active team color
			$team_color = $team_clicked.data("color");
			
			// Add new row for headlines
			var h = $team_img_clicked.parent(".team").parent(".row").after(obj.markup);		
			// Calculate headlines height for animation
			var headlines_h	= 300; //$('.row.closed').outerHeight();
			
			// Collapse and remove previous headlines
			$('.row.open').animate({ height: 0 }).remove();
			
			// Animate headline row
			console.log(headlines_h);
			$('.row.closed').css("visibility", "visible").animate({ height: headlines_h + 'px' }, 300).removeClass("closed").addClass('open');
			
			// Remove active class to all teams
			$('#choose-team .team').removeAttr("style").removeClass("active");
			
			// Set background color
			$team_clicked.addClass("active").css({'background-color': '#' + $team_color, 'opacity': '1'});
			
			// Add border top to headline panel
			$('.row.open').css({'border-top': '3px solid #' + $team_color});
			
		}
	
};


$(document).ready(function() {	
	// Init function
	api.init();		
});