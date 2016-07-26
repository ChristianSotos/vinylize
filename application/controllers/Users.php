<?php 
Class Users extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('user');
		$this->load->model('product');
	}
	function index(){
		$this->load->view('/user/login');
	}
	function to_reg(){
		$this->load->view('/user/registration');
	}
	function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('errors', validation_errors());
				redirect('/users');
		}
		$user = [
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
			];
		$user_info = $this->user->login($user);
		if($user_info== FALSE){
			$this->session->set_flashdata('errors', 'Email or Password is incorrect');
			redirect('/users');
		}
		$this->session->set_userdata($user_info);
		redirect('/products');

	}
	function register(){
		//BEGIN VALIDATION CHECK
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() === FALSE){
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/users/to_reg');
		}
		//END VALIDATION CHECK

		$new_user = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
			];
		$this->user->register($new_user);
	}
}
?>