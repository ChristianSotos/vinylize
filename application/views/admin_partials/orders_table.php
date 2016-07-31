<link rel="stylesheet" type="text/css" href="/assets/admin_dashboard_orders.css">
<table id="orders_table">
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
			<td><a href="/orders/show/<?=$order['order_id']?>"><?=$order['order_id']?></a></td>
			<td><?=$order['name']?></td>
			<td><?=date_format(date_create($order['date']),"F jS Y")?></td>
			<td><?=$order['address']?></td>
			<td><?=$order['total']?></td>

			<td>
<?php
		$shipped = "";
		$process = "";
		$cancelled = "";
		if ($order['ship_status_id'] == 1){
			$shipped = "selected='selected'";
		}elseif ($order['ship_status_id'] == 2){
			$process = "selected='selected'";
		}else{
			$cancelled = "selected='selected'";
		}
?>
				<select id="<?=$order['order_id']?>" class="select_ship_status">
					<option value="1" <?=$shipped?> >Shipped</option>
					<option value="2" <?=$process?> >Order in Process</option>
					<option value="3" <?=$cancelled?> >Cancelled</option>
				</select>
			</td>
		</tr>
<?php
	}
?>
	</tbody>
</table>
<ul id="page_number_list">
	<li>First</li>
	<li>Back</li>
<?php for ($i=($this->session->userdata('page_number')+1); $i <= ($this->session->userdata('page_number')+5); $i++) {
?>
	<li <?php if ($i == $this->session->userdata('page_number')+1) {
		echo "class= 'bold'";
	} ?>
	><?=$i?></li>
<?php
	}
?>
	<li>Next</li>
</ul>
