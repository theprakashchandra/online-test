<?php
/* --------------------------------------------------------------------\
	 classes for authentication
	 MY_controller set entry to the admin pannel and ohter backened trace
\----------------------------------------------------------------------*/

class MY_controller extends CI_controller{
	public function __construct(){

		parent::__construct();
			$this->load->model('login_model');
								$this->load->library('user_agent');
	/*------------------------------------------------\
			login authentication
	\------------------------------------------------*/
		if (!$this->session->logged_in):
			return redirect('login');
		endif;
	}
}
