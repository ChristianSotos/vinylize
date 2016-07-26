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
	function welcome(){
		$data['search'] = $this->input->post('search');
		$this->load->view('user/all_products', $data);
	}
	function show_product($id){
		$data['album_id'] = $id;
		$this->load->view('user/show_product', $data);
	}
}
?>