<?php
Class Order extends CI_Model{

	public function get_all_orders($data)
	{
		$query = "SELECT orders.id 'order_id',
				concat_ws(' ', users.first_name, users.last_name) 'name',
				orders.created_at 'date',
				concat_ws(' ', addresses.address, addresses.city, addresses.state, addresses.zip) 'address',
				SUM(products.price) 'total',
				ship_status.id 'ship_status_id'
				FROM orders
				JOIN users ON users.id = orders.user_id
				JOIN addresses ON orders.address_id = addresses.id
				JOIN order_products ON orders.id = order_products.order_id
				JOIN products ON products.id = order_products.product_id
				JOIN ship_status ON ship_status.id = orders.ship_status_id";


		if ($data['search'] !== null) {
			if ($data['ship_status'] !== 0) {
				//search and ship are not null
				$query .= " WHERE (order_id LIKE '%".$data['search']."%'
					OR users.first_name LIKE '%".$data['search']."%'
					OR users.last_name LIKE '%".$data['search']."%'
					OR addresses.address LIKE '%".$data['search']."%'
					OR addresses.city LIKE '%".$data['search']."%'
					OR addresses.state LIKE '%".$data['search']."%'
					OR addresses.zip LIKE '%".$data['search']."%')";

				$query .= " AND (ship_status.id = ".$data['ship_status'].")";
			}
			else {
				//search is not null but ship is null
				$query .= " WHERE order_id LIKE '%".$data['search']."%'
					OR users.first_name LIKE '%".$data['search']."%'
					OR users.last_name LIKE '%".$data['search']."%'
					OR addresses.address LIKE '%".$data['search']."%'
					OR addresses.city LIKE '%".$data['search']."%'
					OR addresses.state LIKE '%".$data['search']."%'
					OR addresses.zip LIKE '%".$data['search']."%'";
			}
		}
		else {
			//search is null but ship is not null
			if ($data['ship_status'] !== 0) {
				$query .= " WHERE ship_status.id = ".$data['ship_status'];
			}
		}

		$query .= " GROUP BY orders.id LIMIT ". $data['page_number']. ", 5";


		return $this->db->query($query)->result_array();
	}

	public function change_orders_ship_status($data)
	{
		$query = "UPDATE orders SET ship_status_id = ".$data['new_ship_status']." WHERE id = ".$data['order_id'];
		$this->db->query($query);
	}

	public function get_order($data)
	{
		$query = "SELECT orders.id 'order_id',
				products.id 'product_id',
				products.name 'product_name',
				concat_ws(' ', users.first_name, users.last_name) 'name',
				orders.created_at 'date',
				addresses.address 'address',
				addresses.city 'city',
				addresses.state 'state',
				addresses.zip 'zip',
				products.price 'price',
				SUM(products.price) 'total',
				ship_status.id 'ship_status_id'
				FROM orders
				JOIN users ON users.id = orders.user_id
				JOIN addresses ON orders.address_id = addresses.id
				JOIN order_products ON orders.id = order_products.order_id
				JOIN products ON products.id = order_products.product_id
				JOIN ship_status ON ship_status.id = orders.ship_status_id
				WHERE orders.id = ".$data['id'];
				return $this->db->query($query)->result_array();

		}
		public function get_info($data)
		{
			$query = "SELECT orders.id 'order_id',
					products.id 'product_id',
					products.name 'product_name',
					users.first_name 'first_name',
					concat_ws(' ', users.first_name, users.last_name) 'name',
					orders.created_at 'date',
					addresses.address 'address',
					addresses.city 'city',
					addresses.state 'state',
					addresses.zip 'zip',
					products.price 'price',
					SUM(products.price) 'total',
					ship_status.status 'ship_name',
					ship_status.id 'ship_status_id'
					FROM orders
					JOIN users ON users.id = orders.user_id
					JOIN addresses ON orders.address_id = addresses.id
					JOIN order_products ON orders.id = order_products.order_id
					JOIN products ON products.id = order_products.product_id
					JOIN ship_status ON ship_status.id = orders.ship_status_id
					WHERE orders.id = ".$data['id'];
					return $this->db->query($query)->row_array();
			}
			public function quantity($data)
			{
				$query = "SELECT product_id, COUNT(DISTINCT product_id)'quantity'
									FROM order_products WHERE order_id = ".$data['id']."
									GROUP BY product_id";
						// var_dump($query); die();
						return $this->db->query($query)->row_array();
			}
	}
?>
