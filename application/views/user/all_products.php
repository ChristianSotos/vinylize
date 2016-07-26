<?php var_dump($this->session->userdata); ?>
<html>
<head>
	<title>All Products</title>
	<link rel="stylesheet" type="text/css" href="/assets/all_products_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	var new_to_page = true;
	$(document).ready(function(){
		if(new_to_page){
			var search = '<?=$search?>';
			spotify_search(search);
		}
		$(document).on('change', 'input', function(){
			var search = $(this).val();
			spotify_search(search);
		})//on form change
		$('form').submit(function(){
			return false;
		})
		$(document).on('click', 'img', function(){
			var album_id = $(this).attr('id');
			var src = '/products/show_product/'+album_id;
			$.get(src);
		})
		function spotify_search(search){
			$.ajax({
				url:"https://api.spotify.com/v1/search",
				method: "GET",
				data: {
					q: search,
					type: 'album'
				}, 
				success: function(serverData){
					$('#main-content').html("");
					//console.log(serverData);
					for(var i=0 ; i < 20 ; i++){
						var src = serverData.albums.items[i].href;
						$.get(src, function(res){
							console.log(res);
							$('#main-content').append("<div class='albums'><h1>"+res.artists[0].name+"</h1><h4>"+res.name+"</h4><a href='/products/show_product/"+res.id+"'><img src='"+res.images[0].url+"' id='"+res.id+"'></div></a>");
						})//get album info
					}//for loop
				}//success function
			})//original ajax call
		}//function call
	})
	</script>
</head>
<body>
<div class='container'>
	<div id='sidebar'>
	</div>
	<form action='' method='post'>
		<p>Search: <input type='text' name='search'></p>
	</form>
	
	<div id='main-content'>
	</div>
	
</div>
</body>
</html>