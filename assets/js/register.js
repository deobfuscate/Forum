$(document).ready(function(){
	//user exists
	$("#user").blur(function(){
		//alert("Value: " + $("#user").val());
		$("#exists").html("<img src=\"assets/images/loading.gif\" alt=\"Loading\">");
		if (!$("#user").val()) {
			$("#exists").html("<img src=\"assets/images/red-x.png\" alt=\"Username left blank\"> You must enter a username.").attr("style","color:red;");
		}
		else if ($("#user").val().length < 4) {
			$("#exists").html("<img src=\"assets/images/red-x.png\" alt=\"Username too short\"> Username must be at least 4 characters long.").attr("style","color:red;");
		}
		else {
			$.post("includes/userExists.php", {
				username:$("#user").val()
			},
			function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				if(data=="true")
					$("#exists").html("<img src=\"assets/images/red-x.png\" alt=\"Username is taken\"> This username is taken.").attr("style","color:red;");
				if(data=="false")
					$("#exists").html("<img src=\"assets/images/green-check.png\" alt=\"Username is available\">");		
			});
		}				
	});
});