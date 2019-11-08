 <?php
/**
 * class home main class index_page
 *  if posts will display posts otherwise defaults
 */
class Home extends MY_controller
{

  public function __construct()
  {
    parent::__construct();
          $this->load->model('tests_model','test');
      $this->load->library('user_agent');
      $this->load->helper('user');
  }

  public function index(){
    /* show login form */
    if (!is_logged_in()) {
      $data['title'] = "Online test Login";
      $this->load->view('inc/header',$data);
        $this->load->view('forms/login',$data);
          $this->load->view('inc/footer',$data);
    }
    else {
      $data['title'] = "Online test Login";
          $data['view'] = "";
      $this->load->view('inc/header',$data);
        $this->load->view('tests',$data);
          $this->load->view('inc/footer',$data);
    }
  }
}
