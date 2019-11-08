<?php
/**
 * class User
 */

class User extends MY_controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('session');

  }
  function logout(){
    $this->session->sess_destroy();
    return redirect($_SERVER['HTTP_REFERER']);
  }
}

 ?>
