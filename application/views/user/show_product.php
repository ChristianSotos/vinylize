<html>
<head>
	<title>Show Product</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		var album_url = "https://api.spotify.com/v1/albums/<?=$album_id?>";
		console.log(album_url);
		$.ajax({
			url: album_url,
			method: 'GET',
			success: function(res){
				console.log(res);
				$('#album-art').html("<img src='"+res.images[0].url+"'>");
				$('#name').html(res.name);
				$('#artist').html(res.artists[0].name);
				$('#release-date').html(res.release_date);

			}
		})
	})
	</script>
</head>
<body>
<div class='container'>
	<div id='album-art'>
	</div>
	<div id='album-info'>
		<h1 id='name'></h1>
		<h2 id='artist'></h2>
		<h4 id='release-date'></h4>
		<!-- <iframe src="https://embed.spotify.com/?uri=spotify:user:spotify:album:<?=$album_id?>" width="300" height="380" frameborder="0" allowtransparency="true"></iframe> -->
		<iframe src="https://embed.spotify.com/?uri=spotify:album:<?=$album_id?>" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>
	</div>
	
</div>
</body>
</html>