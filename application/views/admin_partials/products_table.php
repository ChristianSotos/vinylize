<link rel="stylesheet" type="text/css" href="/assets/admin_dashboard_orders.css">
<table>
	<thead>
		<th>Product ID</th>
		<th>Spotify ID</th>
		<th>Name</th>
		<th>Artist</th>
		<th>Price</th>
		<th>Quantity Sold</th>
	</thead>
	<tbody>
<?php  	foreach ($products as $product) {
?>		<tr>
			<td><?=$product['product_id']?></td>
			<td><?=$product['spotify_id']?></td>
			<td><?=$product['name']?></td>
			<td><?=$product['artist']?></td>
			<td><?=$product['price']?></td>
			<td><?=$product['quantity_sold']?></td>
		</tr>
<?php   }
?>	</tbody>
</table>
<ul id="page_number_list">
	<li>First</li>
	<li>Back</li>
<?php for ($i=($this->session->userdata('page_number')+1); $i <= ($this->session->userdata('page_number')+5); $i++) {
?>	
	<li><?=$i?></li>
<?php  
	}
?>
	<li>Next</li>
</ul>
