less.env = "development";
less.watch();

jQuery(function($){ 

	$(document).ready(function() {
		"use strict";

		$("button#install").click(function(){
			$.post('/', {'install' : '1'}, function(data) {
				$("#install_messages").append(data);
			});
			return false;
		});
	
	});
});
