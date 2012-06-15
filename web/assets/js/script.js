less.env = "development";
less.watch();

jQuery(function($){ 

	$(document).ready(function(){
		"use strict";
		$("#search_form").submit(function(){
			if ($("#search_results").length < 1) {
				$(this).append('<ul id="search_results"></ul>');
			}			
			if ($("#query").val().length < 3) {
				$('#search_results').empty();
			} else {
				$.post('/search', $(this).serialize(), function(data) {
					var ret_data = $.parseJSON(data);
					$('#search_results').empty();
					for each (var obj in ret_data) {
						$('#search_results').append('<li><a href="' + obj.link + '"><span class="title">' + obj.name + '<span class="tags">' + obj.tags + '</span></span><span class="description">' + obj.body + '</span></a></li>');
					};

				});
			}
			return false;
		});
		$("#query").keyup(function(){ 
		//	if ($(this).val().length >= 3) {
				$("#search_form").submit();
			
		//	}
		});
	});
});
