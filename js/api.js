
var api = {
		
		init: function() {
			$('#choose-league img').click(function () {
				var league_abbr = $(this).data("abbreviation");				
				api.getLeagueInfo(league_abbr);
			});
		},
		
		// Get League Info
		getLeagueInfo: function(league) {
			
			$.ajax({			
				type: "POST",
				url: "../channel.php",
				data: { 
					action: 'get_league_teams',
					league_abbr: league 
					},
				error: function(error) {
					console.log(error);
				},				
				success: function(data) {
					$("#choose-team").html(data);
				}
			});
		}
	
};


$(document).ready(function() {	
	api.init();		
});