 <?php
/**
 * tests_model.php
 * this class holds all the database queries related to tests
 * db table : test_ =>test_type : test; table:test_que =>
 * controller : tests.php
 * @author: prakash Chandra
 * @link : https://solotutes.com //origin of code
 */
class Tests_model extends CI_model
{
  function get_tests($slug=FALSE){ //test_slug where test_type=>test
    if ($slug == FALSE)
    {
      $this->db->select('*');
       $this->db->from('tests');

       $this->db->join('users', 'users.uid = tests.test_author');
       $this->db->order_by('test_update_time','DESC');
       $query = $this->db->get();
       if ($query->num_rows()>0) {
          return $query->result_array();
       }
       else{
         return null;
       }
    }
    $this->db->select('*');
     $this->db->from('tests');
     $this->db->join('users', 'users.uid = tests.test_author');
     // $this->db->join('test_que', 'test_que.test_id = tests.test_id');
     $this->db->where(array('test_slug'=>$slug));
       $query = $this->db->get();
     if ($query->num_rows()>0 ) {
      return $query->row_array();
     }
     else{
       return null;
     }
  }
  function get_test_questions($test_id){
    $this->db->where('test_id',$test_id);
    $query = $this->db->get('test_que');
    if ($query->num_rows()>0) {
      return $query->result_array();
    }
    else{
      return null;
    }
  }
  function test_questions_count($test_id){
    $query = $this->db->get_where('test_que',array('test_id'=>$test_id));
    return $query->num_rows();
  }
  function test_results_count($test_id){
    $query = $this->db->get_where('test_results',array('test_id'=>$test_id));
    return $query->num_rows();
  }
  function get_next_question_number($test_id){ //for adding questions
    $query = $this->db->get_where('test_que',array('test_id'=>$test_id));
    return $query->num_rows() + 1 ;
  }
  //get question by que_id
  function get_question($qid){ //for deleting questions
    $query = $this->db->get_where('test_que',array('que_id'=>$qid));
    return $query->row_array();
  }
//check for session_id to filter multiple time test submission by same user
function get_session_id(){
    $this->load->dbforge();
  if (!$this->db->field_exists('true_option', 'test_responses')){
    $this->dbforge->add_column('test_responses',array(
      'true_option' => array(
          'type' => 'VARCHAR',
          'constraint' => '4'
  ),
  'session_id' => array(
      'type' => 'INT',
      'constraint' => '11'
    ),
  ));
  }
    $result = $this->db->order_by('session_id','DESC')->limit(1)->get('test_responses');
    if ($result->num_rows()>0) {
      return $result->row_array()['session_id'] + 1;
    }
    else{
      return 1;
    }
}

//save test responses
  function save_test_responses($data){
    $this->db->insert('test_responses',$data);
  }

// now get data from test responses and save as result
  function generate_test_result($session_id,$uid,$ip=null){
    $table = "test_responses";
    if ($ip !='') {
      $where = array("session_id"=>$session_id,'uid'=>$uid,"user_ip"=>$ip);
    }
    else{
      $where = array("session_id"=>$session_id,'uid'=>$uid);
    }
    $total_Q = $this->db->from($table)->where($where)->count_all_results();
    $attempted = $this->db->from($table)->where($where)->where('response!=',null)->count_all_results();
    $skiped = $this->db->from($table)->where($where)->where('response',null)->count_all_results();
    $responses = $this->db->from($table)->where($where)->get()->result_array();
    $correct = 0;
    foreach ($responses as $row) {
       if ($row['response'] == $row['true_option']) {
          $correct++;
       }
       $uid = $row['uid'];
        $roll_no = $row['roll_no'];
        $test_id = $row['test_id'];
    }
    $correct = $correct;
    $marks = $correct * 1;
    $uid = $uid;
    $roll_no = $roll_no;
    $test_id = $test_id;

//insert into test results table
    $data =array(
      'uid' => $uid,
      'roll_no' => $roll_no,
      'test_id' => $test_id,
      'total_questions' => $total_Q,
      'answered' => $attempted,
      'correct' => $correct,
      'incorrect' => $attempted - $correct,
      'marks' => $marks,
      'session_id' => $session_id,
      'user_ip' => $ip,
      'name' => $this->session->name
    );
    $this->db->insert('test_results',$data);
    return $this->db->insert_id();
  }
  function get_test_result($result_id){
      $query = $this->db->get_where('test_results',array('result_id'=>$result_id));
      return $query->row_array();
  }
  function question_wise_report($test_id,$ip,$session_id,$uid){
    $this->db->select("*");
    $this->db->from("test_que");
    $this->db->join("test_responses","test_responses.que_id = test_que.que_id");
    $this->db->where(array(
      "test_id" => $test_id,
      "session_id" => $session_id,
      "user_ip" => $ip,
      "uid" => $uid,
    ));
    // $this->db->group_by('que_id');
    $query = $this->db->get();
    return $query->result_array();
  }
  function get_tests_by_id($id){
    // $this->db->from('tests');
    // join users table if tests generated by multiple users */
    $sql = $this->db->get_where('tests',array('test_id'=>$id));
    if ($sql->num_rows()>0) {
      return $sql->row_array();
    }
    else{
      return null;
    }
  }
  function author($id){
    $sql = $this->db->get_where('users',array('uid'=>$id));
    if ($sql->num_rows()>0) {
       return $sql->row_array()['name'];
    }
    else {
      return "Anonymus";
    }
  }
}
