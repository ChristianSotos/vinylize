<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Show Product</title>
		<link rel="stylesheet" type="text/css" href="/assets/admin_show_product.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	</head>
	<body>
		<div id="container">
			<?php $this->load->view('admin_partials/admin_header') ?>
			<div id="main_background">
				<div id= "order_info">
					<h3><label>Order ID: </label><?=$info['order_id']?></h3>
					<h4><label>Customer Shipping Info</label></h4>
					<p><label>Name: </label><?=$info['first_name']?></p>
					<p><label>Address: </label><?=$info['address']?></p>
					<p><label>City: </label><?=$info['city']?></p>
					<p><label>State: </label><?=$info['state']?></p>
					<p><label>Zip: </label><?=$info['zip']?></p>
					<h4><label>Order Total: </label><?=$info['total']?></h4>

				</div>
				<div id="shipping_status">
					<h3><label>Shipping: </label><?=$info['ship_name']?></h3>
				
					<table id="order_products_table">
					  <thead>
					    <th>Order ID</th>
					    <th>Item</th>
					    <th>Artist</th>
					    <th>Price</th>
					    <th>Quantity</th>
					    <th>Total</th>
					  </thead>
					  <tbody>
					<?php
					  foreach ($order as $product) {
					?>
					    <tr>
					      <td><?=$product['product_id']?></td>
					      <td><?=$product['product_name']?></td>
					      <td><?=$product['artist']?></td>
					      <td><?=$product['price']?></td>
					      <td><?=$product['quantity']?></td>
					      <td><?=$product['total']?></td>
					<?php
					};
					 ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
