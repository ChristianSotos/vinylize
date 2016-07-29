<style>
	#header{
		background-color: black;
		background: linear-gradient(to left, black, dimgrey);
		color: white;
		list-style-type: none;
		padding: 1%;
		border: 3px groove silver;
		border-radius: 1em;
		text-align: right;
		position: static;
		top: 0;
	}
	#header li{
		display: inline-block;
		margin: 0 1em;
	}
	#header a{
		color: silver;
	}
	#vin-name{
		float: left;
	}
	#vin-name h3{
		margin: 0;
	}
</style>


<ul id='header'>
	<li id='vin-name'><h3>vinylize</h3></li>
	<li><a href='/products/to_home'>Home</a></li>
	<li><a href='/users/logout'>Log Out</a></li>
	<li id='cart-count'><a href='/products/to_cart'>Cart <?=$this->session->userdata('cart_count')?></a></li>
</ul>