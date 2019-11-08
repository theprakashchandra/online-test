<?php
class Login extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->dbforge();
		$this->load->helper('user');
		$this->load->model('login_model');
	}
	public function index(){
		if ($this->session->logged_in):
			return redirect(base_url());
		endif;
		$data['title']="Sign in for Online test";
		$this->load->view('inc/header',$data);
		$this->load->view('inc/forms/login');
		$this->load->view('inc/footer');
	}

	public function process(){
		/*------------------------------------------------\
							for normal request
		 ------------------------------------------------*/
		  $form = 'login-form'; //to load the form on error handling
			 $uname = $this->input->post('user_name');
			 $pass = $this->input->post('pass');
			 $this->form_validation->set_rules('user_name','UserName','required|trim');
			 $this->form_validation->set_rules('pass','Password','required');
			 if ($this->input->post('register')) {
				$form = 'reg-form';
			  $name = $this->input->post('name');
				$this->form_validation->set_rules('name','Name','required|trim');
				 $this->form_validation->set_rules('user_name','UserName','required|trim|min_length[5]|is_unique[users.user_name]');
				 	 $this->form_validation->set_rules('pass','Password','required|min_length[6]');
			 }
			 if ($this->form_validation->run()) {
				 if ($this->input->post('register')) {
					 $form = 'reg-form';
				 	$response = $this->login_model->add_user($name,$uname,$pass);
				 }
				 if ($this->input->post('login')) {
					 $form = 'login-form';
				 	 $response = $this->login_model->find_user($uname,$pass);
				 }
				if ($response=="") {
					return redirect($this->input->post('refrer'));
				}
				else {
						$this->session->set_flashdata('err_msg',$response);
						return redirect('login?form='.$form);
				}
			 }
			 else {
				 $this->session->set_flashdata('err_msg',validation_errors());
				 return redirect('login?form='.$form);
			 }
	}
}
?>
