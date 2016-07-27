<?php
Class Order extends CI_Model{

	public function get_all_orders()
	{
		$query = "SELECT orders.id 'order_id', 
			concat_ws(' ', users.first_name, users.last_name) 'name', 
			orders.created_at 'date',
			concat_ws(' ', addresses.address, addresses.city, addresses.state, addresses.zip) 'address',
			SUM(products.price) 'total',
			ship_status.status 'status'
			FROM orders
			JOIN users ON users.id = orders.user_id
			JOIN addresses ON orders.address_id = addresses.id
			JOIN order_products ON orders.id = order_products.order_id
			JOIN products ON products.id = order_products.product_id
			JOIN ship_status ON ship_status.id = orders.ship_status_id
			GROUP BY orders.id";

		return $this->db->query($query)->result_array();
	}


}
?>