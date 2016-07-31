
<html>
<head>
	<title>All Products</title>
	<link rel="stylesheet" type="text/css" href="/assets/all_products_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		new_to_page();
		
		//BEGIN PAGINATION
		var page = 0;
		$(document).on('mouseover', '#page-search h4', function(){
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
			var search = "<?=$this->session->userdata('current_search')?>";
			if (!search){
				search = "<?=$search?>";
			}
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
		$(document).on('mouseover', '.rel-pics', function(){
			$(this).css('cursor', 'pointer');
		})
		$(document).on('click', '.rel-pics', function(){
			console.log('clicking');
			search_album($(this).attr('id'), 0);
		})
		
		//BEGIN ALBUM SPIN
	    (function(){
		    function setRotation(deg, album_id) {
		    		// console.log("IN SET ROTATION: ", album_id);
		    		var id = "#"+album_id;      
		            $(id).css({    // rotate element via css
		                '-webkit-transform': 'rotate(' + deg + 'deg)',
		                    '-moz-transform': 'rotate(' + deg + 'deg)',
		                    '-ms-transform': 'rotate(' + deg + 'deg)',
		                    'transform': 'rotate(' + deg + 'deg)'
		            });
		    }
	    	var myintv;
	    	var degrees = 0;
	    	var timerinterval = 20;
	    	var degperint = 3;
	    $(document).on('mouseover', '.album-pics', function(){
	    	var album_id = $(this).attr('id');
	    	myintv = setInterval(function(){
	    		(function(id){
	                degrees += degperint;    // add degree-per-interval to rotation
		            // alert('passed: '+album_id);
		            setRotation(degrees%360, id);
	    		}(album_id));
	    	}, timerinterval);
	    });
	    $(document).on('mouseout', '.album-pics', function(){
	    	var album_id = $(this).attr('id');
	    	clearInterval(myintv);
	    	var localDegrees = degrees;
	    	console.log(localDegrees);
	    	degrees = 0;
	    	var localIntv = setInterval(function(){
	    		(function(id){
	    			console.log("interior degrees",localDegrees, id);
	    			if (localDegrees <=0){
	    				console.log("KILL INTERVAL");
	    				clearInterval(localIntv);
	    				return;
	    			}
	    			localDegrees -= degperint;
	    			setRotation(localDegrees%360, id);
	    		}(album_id))},timerinterval)

	    })
		}())

		
		//main search function
		function search_album(search, page_offset){
			if(search === ""){
				search = "<?=$this->session->userdata('current_search')?>";
			}else{
				var current_search = {'search':search};
				$.post('/products/set_search', current_search, function(res){});
			}
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
							$('#main-content').append("<div class='albums'><h4>"+res.artists[0].name+"</h4><a href='/products/show_product/"+res.id+"'><img class='album-pics' src='"+res.images[0].url+"' id='"+res.id+"'></a><p>"+res.name+"</p></div>");
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
							for(var i=0 ; i<3 ; i++){
								artist_src = res.artists[i].href;
								$.get(artist_src,function(res){
									//console.log(res);
									$('#side-content').append("<div class='related-artists'><h4>"+res.name+"</h4><img class='rel-pics' id='"+res.name+"'src='"+res.images[0].url+"'></div>")
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
<div class='container'>
<div id='header-div'>
<?php 	$this->load->view('partials/header'); 	?>
</div>
	<div id='side-content'>
	</div>

	<div id='page-search'>
		<form action='' method='post' id='search-bar'>
			<p><input type='text' name='album_search' placeholder='Search for an Album or Artist'></p>
			<input type='hidden' name='current_search' id='current-search' value=''>
		</form>
		<div id='page-bar'>
			<h4 id='page-back'> <-- </h4>
			<h4 id='page-num'>1</h4>
			<h4 id='page-forward'> --> </h4>
		</div>
	</div>
	
	<div id='main-content'>
	</div>
</div>
</body>
</html>