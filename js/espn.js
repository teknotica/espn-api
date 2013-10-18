
var current_league;
var api = {

		init: function() {
			
			$('#choose-league .league').click(function () {
				
				current_league = $(this).find("img").data("abbreviation");
								
				// Add selected class
				$(this).addClass("selected");
				$('#choose-league .league').not(this).removeClass("selected");				

				// Clear section
				$("#choose-team").html("").addClass("hide");				
				// Show loader
				$('#loader').removeClass("hide").addClass("show");
				
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
			console.log(d);
		
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
			$("#choose-team").fadeIn("slow").removeClass("hide");					
						
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
			
			$('#choose-team .team').hover(function(){
				$(this).css({
					'background-color': '#' + $(this).data("color"),
					'opacity': '1'
				});
			}, function() {
				$(this).removeAttr("style");
			});	
		},
		
		// Get Team Headlines
		printTeamHeadlines: function(data) {
			
			var obj = JSON.parse(data);			
			$team_img_clicked = $("[data-team-id='" + obj.team_id + "']");			
			$team_img_clicked.parent(".team").parent(".row").after(obj.markup);			
			
			// Collapse and remove previous headlines
			$('.row.open').animate({ height: 0 }).remove();
			
			$('.row.closed')
			.css("visibility", "visible")
			.animate({ height: 'auto' })
			.removeClass("closed").addClass('open');
		}
	
};


$(document).ready(function() {	
	api.init();		
});