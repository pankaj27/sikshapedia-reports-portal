function isItMe(){
	var hasToken = localStorage.getItem('hasToken');
	$.ajax({
		url:"https://sikshapedia.pmitcolleges.org/vault/api/me", 
		data: {},
		dataType:'json',
		method: "POST",
		headers: {"Authorization": 'Bearer '+hasToken},
		success: function(data) {
			$(".my_name").html(data.name);
			//console.log('Success');
		},
		error: function(data) {
			//localStorage.removeItem("hasToken");
			//location.href = 'index.html';
		},
	}); 
}



		