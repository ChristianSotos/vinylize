
	<thead>
		<th>Order ID</th>
		<th>Name</th>
		<th>Date</th>
		<th>Billing Address</th>
		<th>Total</th>
		<th>Status</th>
	</thead>
	<tbody>
<?php  
	foreach ($orders as $order) {
?>
		<tr>
			<td><?=$order['order_id']?></td>
			<td><?=$order['name']?></td>
			<td><?=$order['date']?></td>
			<td><?=$order['address']?></td>
			<td><?=$order['total']?></td>
			<td><?=$order['status']?></td>
		</tr>			
<?php 
	} 
?>
	</tbody>

