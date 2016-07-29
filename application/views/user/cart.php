<html>
<head>
	<title>View Cart</title>
	<link rel="stylesheet" type="text/css" href="/assets/cart_style.css">
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$(document).on('submit', '#shipping-form', function(){
			$.post('/orders/add_ship', $(this).serialize(), function(res){
				console.log('submitted');
				$('#shipping-div').fadeOut();
				$('#stripe-div').html(res);
			})
			return false;
		})
		
	})
	</script>
</head>
<body>
<?php 	$this->load->view('partials/header'); 	
		$sum = 0;
?>

<div class='container'>

	<div id='cart-div'>
		<table>
			<thead>
				<tr>
					<th>Album</th>
					<th>Artist</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
<?php 	foreach($cart as $album){ 	?>

				<tr>
					<td><?=$album['name']?></td> 
					<td><?=$album['artist']?></td>
					<td><?=$album['qty']?></td>
					<td>$<?=($album['price']*$album['qty'])?>.00</td>
				</tr>

<?php 	$sum +=	($album['price']*$album['qty']); 	?>

<?php 	}	?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td>Total: </td>
					<td>$<?=$sum?>.00</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div id='payment-div'>
		<div id='shipping-div' class='ship-stripe'>
			<form action='/orders/add_ship' method='post' id='shipping-form'>
				<p>Address: <input type='text' name='address'></p>
				<p>City: <input type='text' name='city'></p>
				<p>State: <input type='text' name='state' maxlength="2"></p>
				<p>Zipcode: <input type='text' name='zipcode' maxlength-"5"></p>
				<input type='hidden' name='price' value='<?=$sum?>'>
				<button id='ship-btn'>Confirm Address</button>
			</form>
		</div>
		<div id='stripe-div' class='ship-stripe'>
		</div>
	</div>
</div>
</body>
</html>
