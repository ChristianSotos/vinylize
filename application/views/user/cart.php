<html>
<head>
	<title>View Cart</title>
</head>
<body>
<?php 	$this->load->view('partials/header'); 	?>

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
					<td><?=($album['price']*$album['qty'])?></td>
				</tr>

<?php 	}	?>
			</tbody>
		</table>
	</div>
	<div id='payment-div'>
		<div id='shipping-div'>
			<form action='products/add_shipping' method='post'>
				<p>Address: <input type='text' name='address'></p>
				<p>City: <input type='text' name='city'></p>
				<p>State: <input type='text' name='state' maxlength="2"></p>
				<p>Zipcode: <input type='text' name='address' maxlength-"5"></p>
				<button id='ship-btn'>Confirm Address</button>
			</form>
		</div>
		<div id='stripe-div'>

		</div>
	</div>
</div>
</body>
</html>