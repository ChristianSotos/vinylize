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
		$this->load->view('/admin/dashboard_orders');
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


		//set ship status
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

	function add_order(){

	}


	function show($id){
		$num =intval($id);
		$data['id'] = $id;
		$order = $this->order->get_order($data);
		$info = $this->order->get_info($data);
		$quantity = $this->order->quantity($data);
		// var_dump($order); die();
		$data = array(
			'order'=> $order,
			'info'=>$info,
			'quantity'=>$quantity
		);
		$this->load->view("/admin/show_product", $data);
	}
}
?>
