<?php
Class Product extends CI_Model{

	public function get_all_products($data)
	{
		$query = "SELECT products.id 'product_id', products.spotify_id 'spotify_id', products.name 'name', products.artist 'artist', products.price 'price',  COUNT(order_products.product_id) 'quantity_sold'
					FROM products
					JOIN order_products ON products.id = order_products.product_id";

		if ($data['search'] !== null) {
			$query .= " WHERE products.id LIKE '%".$data['search']."%'
			OR products.spotify_id LIKE '%".$data['search']."%'
			OR products.name LIKE '%".$data['search']."%'
			OR products.artist LIKE '%".$data['search']."%'
			OR products.price LIKE '%".$data['search']."%'";
		}

		$query .= " GROUP BY products.id LIMIT ".$data['page_number'].", 5";
		return $this->db->query($query)->result_array();
	}
}
?>