
<html>
<head>
	<title>All Products</title>
	<link rel="stylesheet" type="text/css" href="/assets/all_products_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	var new_to_page = true;
	$(document).ready(function(){
		new_to_page();
		//BEGIN PAGINATION
		var page = 0;
		$(document).on('mouseover', '#page-div h4', function(){
			$(this).css('cursor', 'pointer');
		})
		$(document).on('click', '#page-forward', function(){
			page +=1;
			$('#page-num').html(page+1);
			var search = $('#current-search').attr('value');
			search_album(search, page);
		})
		$(document).on('click', '#page-back', function(){
			if(page > 0){
				page -=1;
				$('#page-num').html(page+1);
				var search = $('#current-search').val();
				search_album(search, page);
			}
		})
		//signal initial search
		function new_to_page(){
			var search = '<?=$search?>';
			console.log(search);
			$('#current-search').val(search);
			var page = 0;
			search_album(search, page);
		}
		
		//signal new search
		$(document).on('change', 'input', function(){
			//clear current content
			$('#main-content').html("");
			$('#side-content').html("");
			
			//call search
			var search = $(this).val();
			$('#current-search').val(search);

			page = 0;
			$('#page-num').html(page+1);

			search_album(search, page);
		})//on form change
		
		$('form').submit(function(){
			return false;
		})

		//related artist search
		$(document).on('mouseover', '.related-pics', function(){
			$(this).css('cursor', 'pointer');
		})
		$(document).on('click', '.related-pics', function(){
			search_album($(this).attr('id'), 0);
		})
		
		//main search function
		function search_album(search, page_offset){
			page_offset *= 12;
			console.log(search);
			console.log(page_offset);
			$.ajax({
				url:"https://api.spotify.com/v1/search",
				method: "GET",
				data: {
					q: search,
					type: 'album',
					offset: page_offset, 
					limit: 12
				}, 
				success: function(serverData){
					$('#main-content').html("");
					$('#side-content').html("");
					console.log(serverData);
					
					//create main content
					for(var i=0 ; i < serverData.albums.items.length ; i++){
						var src = serverData.albums.items[i].href;
						$.get(src, function(res){
							//console.log(res);
							$('#main-content').append("<div class='albums'><h4>"+res.artists[0].name+"</h4><a href='/products/show_product/"+res.id+"'><img src='"+res.images[0].url+"' id='"+res.id+"'></a><p>"+res.name+"</p></div>");
						})
					}//end main content
					
					//create sidebar
					var original_album_src = serverData.albums.items[0].href;
					$.get(original_album_src, function(res){
						//console.log(res);
						var related_artist_src = res.artists[0].href+"/related-artists"
						$.get(related_artist_src, function(res){
							//console.log(res);
							$('#side-content').append('<h3>Related Artists</h3>')
							for(var i=0 ; i<4 ; i++){
								artist_src = res.artists[i].href;
								$.get(artist_src,function(res){
									//console.log(res);
									$('#side-content').append("<div class='related-artists'><h4>"+res.name+"</h4><img class='related-pics' id='"+res.name+"'src='"+res.images[0].url+"'></div>")
								})
							}

						})
					})//end sidebar
				}//success function
			})//original ajax call
		}//function call
	})
	</script>
</head>
<body>
<?php 	$this->load->view('partials/header'); 	?>
<div class='container'>
	<div id='sidebar'>
	</div>
	<form action='' method='post'>
		<p>Album: <input type='text' name='album_search'></p>
		<p>Artist: <input type='text' name='artist_search'></p>
		<input type='hidden' name='current_search' id='current-search' value=''>
	</form>
	
	<div id='page-div'>
		<h4 id='page-back'> <-- </h4>
		<h4 id='page-num'>1</h4>
		<h4 id='page-forward'> --> </h4>
	</div>
	<div id='main-content'>
	</div>
	<div id='side-content'>
	</div>
</div>
</body>
</html>