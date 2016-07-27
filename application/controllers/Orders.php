<?php 
Class Orders extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->model('product');
		$this->load->model('order');
	}
	function index(){
		$this->load->view('/admin/dashboard_orders');
	}

	function get_all_orders(){

		$orders = $this->order->get_all_orders();
		$data['orders'] = $orders;
		$this->load->view("/admin_partials/orders_table", $data);
	}
}
?>