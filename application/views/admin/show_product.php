<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Show Product</title>
		<link rel="stylesheet" type="text/css" href="/assets/admin_dashboard_orders.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	</head>
	<body>
		<h1>Hello</h1>
		<div>
			<p><label>Order ID:</label><?=$info['order_id']?></p>
			<p><label>Customer Shipping Info:</label></p>
			<p><label>Name:</label><?=$info['first_name']?></p>
			<p><label>Address:</label><?=$info['address']?></p>
			<p><label>City:</label><?=$info['city']?></p>
			<p><label>State</label><?=$info['state']?></p>
			<p><label>Zip:</label><?=$info['zip']?></p>
		</div>
		<div id="single_order_table">
			<table id="order_products_table">
			  <thead>
			    <th>Order ID</th>
			    <th>Item</th>
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
			      <td><?=$product['price']?></td>
			      <td><?=$quantity['quantity']?></td>
			      <td><?=$product['total']?></td>

			      <td>
			<?php
			};
			 ?>
			</tbody>
			</table>

		</div>
		<div id="shipping_status">
			<label>Shipping:</label><?=$info['ship_name']?>
		</div>
	</body>
</html>
