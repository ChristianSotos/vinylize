<html>
<head>
	<title>Show Product</title>
	<link rel="stylesheet" type="text/css" href="/assets/show_product_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		//add to cart
		$('#buy-btn').click(function(){
			album_info['qty'] = $('#qty').val();
			$.post('/products/add_to_cart', album_info, function(res){
				$('#header-div').html(res);
			})
		})

		//load and append album data
		var album_info = {};
		var artist_name = "";
		var album_url = "https://api.spotify.com/v1/albums/<?=$album_id?>";
		$.ajax({
			url: album_url,
			method: 'GET',
			success: function(res){
				//console.log(res);
				artist_name = res.artists[0].name;
				artist_id = res.artists[0].id;
				$('#album-art').html("<img src='"+res.images[0].url+"'>");
				$('#name').html(res.name);
				$('#artist').html(res.artists[0].name);
				$('#release-date').html("Released: "+res.release_date);
				for(var i=0 ; i<res.tracks.items.length ; i++){
					$('#tracklist').append("<li><h4>"+res.tracks.items[i].track_number+".</h4> "+res.tracks.items[i].name+"</li>")
				}
				album_info["id"] = res.id;
				album_info['name'] = res.name;
				album_info['artist'] = res.artists[0].name;
				track_length = res.tracks.items.length;
				if (track_length < 5){
					album_info['price'] = 5;
				} else if (track_length < 10 ){
					album_info['price'] = 10;
				} else if (track_length < 15){
					album_info['price'] = 15;
				} else if (track_length >= 15){
					album_info['price'] = 20;
				}

				//create related artists sidebar
				var related_artist_src = res.artists[0].href+"/related-artists"
				$.get(related_artist_src, function(res){
					//console.log(res);
					$('#side-content').append('<h3>Related Artists</h3>')
					for(var i=0 ; i<3 ; i++){
						artist_src = res.artists[i].href;
						$.get(artist_src,function(res){
							//console.log(res);
							var new_name = "";
							for (var i=0 ; i< res.name.length ; i++){
								if (res.name[i] == '$'){
									new_name += 'S';
								} else if (res.name[i] == ','){

								}else{
									new_name += res.name[i];
								}
							} 	
							$('#side-content').append("<div class='related-artists'><h4>"+res.name+"</h4><a href='/products/new_search/"+new_name+"'><img class='related-pics' src='"+res.images[0].url+"'></a></div>")
						})
					}
				})//end related artists sidebar

				//other albums by this artist
				$.ajax({
					url:"https://api.spotify.com/v1/search",
					method: "GET",
					data: {
						q: artist_name,
						type: 'album'
					}, 
					success: function(serverData){
						
						$('#bottom-content').append('<h3>Other Albums By This Artist</h3>');
						for(var i=0; i < 5 ; i++){
							var src = serverData.albums.items[i].href;
							$.get(src, function(res){
								if (res.id == album_info['id'] || res.artists[0].id != artist_id){
									i --;
								} else{
									$('#bottom-content').append("<div class='other-albums'><a href='/products/show_product/"+res.id+"'><img src='"+res.images[0].url+"' id='"+res.id+"'></a><p>"+res.name+"</p></div>");
								}
							})
						}
					}//success function
				})//end other albums
		
			}//end success function
		})//end initial get request

	})
	</script>
</head>
<body>
<div id='header-div'>
	<?php 	$this->load->view('partials/header'); 	?>
</div>
<div class='container'>
	<div id='show-album'>
		<div id='album-player-art'>
			<iframe src="https://embed.spotify.com/?uri=spotify:album:<?=$album_id?>" frameborder="0" allowtransparency="true"></iframe>
			<div id='album-art'></div>
		</div>
		<div id='player-div'>
			<h1 id='name'></h1>
			<h2 id='artist'></h2>
			<div id='buy-div'>
				<button id='buy-btn'>Buy</button>
				<select id='qty'>
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
				</select>
			</div>
			<h4 id='release-date'></h4>
			<ul id='tracklist'>
			</ul>
		</div>
	</div>
	<div id='side-content'>
	</div>
	<div id='bottom-content'></div>
</div>
</body>
</html>