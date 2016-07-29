<?php
Class Orders extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->model('product');
		$this->load->model('order');
	}
	function index(){
		$this->session->set_userdata('page_number', 0);

		if ($this->session->userdata('admin_level') == 9) {
			$this->load->view('/admin/dashboard_orders');
		}
		elseif ($this->session->userdata('admin_level') == 0) {
			redirect('/products/to_home');
		}
		else {
			redirect('/users');
		}	
	}

	function get_all_orders($page, $ship_status=null, $search=null){
		//set name
		$data = array();

		if ($search == "") {
			$data['search'] = null;
		}
		else {
			$data['search'] = $search;
		}

		if ($ship_status == 'Show%20All') {
			$data['ship_status'] = 0;
		}
		elseif ($ship_status == 'Shipped') {
			$data['ship_status'] = 1;
		}
		elseif ($ship_status == 'Order%20in%20Process') {
			$data['ship_status'] = 2;
		}
		elseif ($ship_status == 'Cancelled') {
			$data['ship_status'] = 3;
		}

		//compare $page to page number in session
		if ($page == 0) {
			$this->session->set_userdata('page_number', 0);
		}
		else {
			$new_page_number = $page / 5;
			$this->session->set_userdata('page_number', $new_page_number);
		}
		$data['page_number'] = $page;
		$orders = $this->order->get_all_orders($data);

		$data['orders'] = $orders;
		$this->load->view("/admin_partials/orders_table", $data);
	}

	function search_all_orders($search)

	{
		$search_this = $search;
		$orders = $this->order->search_all_orders($search_this);
		// var_dump($orders); die();
		$data['orders'] = $orders;
		$this->load->view("/admin_partials/orders_table", $data);
	}


	function change_orders_ship_status($ship_status, $order_id)
	{
		$data['new_ship_status'] = $ship_status;
		$data['order_id'] = $order_id;
		$this->order->change_orders_ship_status($data);
		redirect('/orders');
	}

	function add_ship(){
		$shipping_info = [
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zipcode' => $this->input->post('zipcode')
		];
		$this->session->set_userdata('ship_info', $shipping_info);
		$this->load->view('/partials/stripe');
	}

	function add_order(){
		$user_id = $this->session->userdata('id');
		$ship_info = $this->session->userdata('ship_info');
		$cart = $this->session->userdata('cart');
		$this->order->add_order($user_id, $ship_info, $cart);
	}


	function show($id){
		$num =intval($id);
		$data['id'] = $id;
		$order = $this->order->get_order($data);
		$info = $this->order->get_info($data);
		// var_dump($order); die();
		$data = array(
			'order'=> $order,
			'info'=>$info
		);
		if ($this->session->userdata('admin_level') == 9) {
			$this->load->view("/admin/show_product", $data);
		}
		elseif ($this->session->userdata('admin_level') == 0) {
			redirect('/products/to_home');
		}
		else {
			redirect('/users');
		}	
	}
}
?>
