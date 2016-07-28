<style>
	ul{
		list-style-type: none;
	}
	li{
		display: inline-block;
	}

</style>


<ul>
	<li>vinylize</li>
	<li><a href='/products'>Home</a></li>
	<li><a href='/users/logout'>Log Out</a></li>
	<li id='cart-count'><a href='/products/to_cart'>Cart <?=$this->session->userdata('cart_count')?></a></li>
</ul>