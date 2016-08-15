<link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
<style>
	#header{
		list-style-type: none;
		padding: 1%;
		text-align: right;
		position: static;
		top: 0;
		margin: 0;
		padding: 2%;
	}
	#header li{
		display: inline;
		margin: 0 1em;
	}
	#header a{
		color: silver;
		text-decoration: none;
		font-style: italic;
	}
	#header a:hover{
		font-weight: bold;
		font-size: 1em;
		color: lightgrey;
	}
	#vin-name, #vin-tag{
		float: left;
	}
	#vin-name h3{
		font: 400 100px/1.3 'Arizonia', Helvetica, sans-serif;
		font-size: 2em;
		line-height: 0.5em;
		margin: 0;
	}
	#vin-tag h4{
		margin: 0;
		margin-left: 10%;
		margin-top: 1px;
		font-style: italic;
		white-space: nowrap;
	}

</style>


<ul id='header'>
	<li id='vin-name'><h3>vinylize</h3></li>
	<li id='vin-tag'><h4>World's Largest Vinyl Collection</h4></li>
<?   if ($this->session->userdata('admin_level') == 9) { ?>
	<li><a href="/orders">admin dash</a></li> 
<?   } ?>
	<li><a href='/products/to_home'>home</a></li>
	<li><a href='/users/logout'>logout</a></li>
	<li id='cart-count'><a href='/products/to_cart'>cart <?=$this->session->userdata('cart_count')?></a></li>
</ul>