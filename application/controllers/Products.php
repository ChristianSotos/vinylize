<?php 
Class Products extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->model('product');
	}
	function index(){
		$this->load->view('user/welcome');
	}
	function new_search($search = null){
		if($search){
			$sp_search = str_replace('%20', " ", $search);
			$data['search'] = $sp_search;
		} else{
			$data['search'] = $this->input->post('search');
		}
		$this->load->view('user/all_products', $data);
	}
	function show_product($id){
		$data['album_id'] = $id;
		$this->load->view('user/show_product', $data);
	}
	function add_to_cart($id, $name, $artist, $price, $qty){
		$product_exists = false;
		$sp_name = str_replace('%20', " ", $name);
		$sp_artist = str_replace('%20', " ", $artist);
		$productArray = [
			'id' => $id,
			'name' => $sp_name,
			'artist' => $sp_artist,
			'price' => $price,
			'qty' => $qty
			];
		$cartArray = $this->session->userdata('cart');
		foreach ($cartArray as &$cartProduct){
			if($id == $cartProduct['id']){
				$cartProduct['qty'] += $qty;
				$product_exists = true;
				break;
			}
		}
		if(!$product_exists){
			array_push($cartArray, $productArray);
		}
		$this->session->set_userdata('cart', $cartArray);
		$cartCount = $this->session->userdata('cart_count');
		$this->session->set_userdata('cart_count', ($cartCount + $qty));
		$this->load->view('/partials/header');
	}
	function to_cart(){
		$data['cart'] = $this->session->userdata('cart');
		$this->load->view('user/cart', $data);
	}

	function admin_dashboard(){
		$this->load->view('/admin/dashboard_products');
	}

	function get_all_products($page, $search=null){

		if ($search == "") {
			$data['search'] = null;
		}
		else {
			$data['search'] = $search;
		}
		$data['page_number'] = $page;
		$products = $this->product->get_all_products($data);
		$data['products'] = $products;
		$this->load->view('/admin_partials/products_table', $data);
	}
}
?>