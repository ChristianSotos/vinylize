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

	function add_order($user_id, $ship_info, $cart){
		$ship_query = "INSERT INTO addresses (address,city,state,zip,created_at,updated_at) VALUES (?,?,?,?,NOW(),NOW())";
		$ship_values = array($ship_info['address'], $ship_info['city'], $ship_info['state'], $ship_info['zipcode']);
		$this->db->query($ship_query, $ship_values);
		$ship_id = $this->db->insert_id();

		$order_query = "INSERT INTO orders (created_at,updated_at,user_id,address_id,ship_status_id) VALUES (NOW(),NOW(),?,?,2)";
		$order_values = array($user_id, $ship_id);
		$this->db->query($order_query, $order_values);
		$order_id = $this->db->insert_id();

		foreach($cart as $product){
			$unique_check = $this->db->query("SELECT * FROM products WHERE spotify_id = '".$product['id']."'")->row_array();
			
			if($unique_check == null){
				$product_query = "INSERT INTO products (spotify_id,name,artist,price,created_at) VALUES (?,?,?,?,NOW())";
				$product_values = array($product['id'], $product['name'], $product['artist'], $product['price']);
				$this->db->query($product_query, $product_values);
				$product_id = $this->db->insert_id();
			} else{
				$product_id = $unique_check['id'];
			}

			$op_query = "INSERT INTO order_products (order_id, product_id) VALUES (?,?)";
			$op_values = array($order_id, $product_id);
			$this->db->query($op_query, $op_values);
		}
	}

	public function get_order($data)
	{
		$query = "SELECT orders.id 'order_id',
				products.id 'product_id',
				products.name 'product_name',
				products.artist 'artist',
				concat_ws(' ', users.first_name, users.last_name) 'name',
				orders.created_at 'date',
				addresses.address 'address',
				addresses.city 'city',
				addresses.state 'state',
				addresses.zip 'zip',
				products.price 'price',
				SUM(products.price) 'total',
				COUNT(order_products.product_id)'quantity',
				ship_status.id 'ship_status_id'
				FROM orders
				JOIN users ON users.id = orders.user_id
				JOIN addresses ON orders.address_id = addresses.id
				JOIN order_products ON orders.id = order_products.order_id
				JOIN products ON products.id = order_products.product_id
				JOIN ship_status ON ship_status.id = orders.ship_status_id
				WHERE orders.id = ".$data['id']." GROUP BY products.id";
				return $this->db->query($query)->result_array();

		}
		public function get_info($data)
		{
			$query = "SELECT orders.id 'order_id',
					products.id 'product_id',
					products.name 'product_name',
					products.artist 'artist',
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
	}
}
?>
