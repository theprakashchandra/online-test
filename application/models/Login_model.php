<?php
class Login_model extends CI_model{

	public function __construct(){
		parent::__construct();
	}
	/*----------------------------------------------------\
			function find_user();
			parameters :2 normally;
			db identifiers 3 , name , pass and status
			return :  boolean;
	-----------------------------------------------------*/
	public function find_user($user_name, $pass){

		$query = $this->db->get_where('users',array('user_name'=>$user_name));
		if ($query->num_rows()>0) {
			foreach ($query->result() as $user) {
				$user = $query->row_array();
				$pass2 = $user['pass'];
				$user_name2 = $user['user_name'];
				$name = $user['name'];
				$uid = $user['uid'];
				$role = $user['user_role'];
				$email = $user['email'];
				if (md5($pass)===$pass2) {
					$this->session->set_userdata('logged_in',true);
					$this->session->set_userdata('name',$name);
						$this->session->set_userdata('user_name',$user_name2);
					$this->session->set_userdata('uid',$uid);
					$this->session->set_userdata('email',$email);
					$this->session->set_userdata('role',$role);
				}
				else{
						return '<span class="text-danger">incorrect password</span>';
				}
			}
		}
		else{
			return '<span class="text-warning">user not found</span>';
		}
	}
	function add_user($name,$user_name,$pass){
		$data = array(
			'name' => $name,
			'user_name' => $user_name,
			'pass' =>md5($pass),
			'user_role' =>'student'
		);
		$fields = array(
				'uid' => array(
								'type' => 'INT',
								'constraint' => 9,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
				),
				'name' => array(
								'type' => 'VARCHAR',
								'constraint' => '256'
				),
				'pass' => array(
								'type' =>'VARCHAR',
								'constraint' => '256'
				),
				'user_name' => array(
								'type' => 'VARCHAR',
								'constraint' => '256'
				),
				'user_role' => array(
								'type' => 'VARCHAR',
								'constraint' => '256'
				),
				'email' => array(
								'type' => 'VARCHAR',
								'constraint' => '256'
				)
			);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('uid', TRUE);
		$this->dbforge->create_table('users', TRUE); //create table if not exists
		$this->db->insert('users',$data);
		$uid = $this->db->insert_id();
		$this->session->set_userdata('logged_in',true);
		$this->session->set_userdata('name',$name);
		$this->session->set_userdata('user_name',$user_name);
		$this->session->set_userdata('uid',$uid);
	}
}
