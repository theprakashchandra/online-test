<?php
/**
 * tests.php
 * generate tests../ view tests /
 */
class Tests extends MY_controller
{

  function __construct()
  {
    parent::__construct();
      $this->load->model('tests_model','tests');
      $this->load->helper('tests');
        $this->load->helper('user');
    $this->load->library('form_validation');
  }

  function index(){
    $data['tests']=$this->tests->get_tests();

    $data['title'] = 'Online tests';
    $data['desc'] = "Better Practice with mock tests, check your progress";
      $data['ogimage'] = '';//later put an image for this topic
    $data['view']='';

    $this->load->view('inc/header',$data);

    $this->load->view('tests',$data);
    $this->load->view('inc/footer',$data);
  }
  function view($slug){
    $data['post'] = $this->tests->get_tests($slug);
    $data['questions'] = $this->tests->get_test_questions($data['post']['test_id']);
    $data['author']=$this->tests->author($data['post']['test_author']);
    $data['title']=$data['post']['test_title'];
    $data['desc'] = $data['post']['test_summary'];
      $data['ogimage'] = $data['post']['test_img'];
    $data['view']='single';
     if ($data['post']!=null) {

     $this->load->view('inc/header',$data);
      $this->load->view('tests',$data);
       $this->load->view('inc/footer',$data);
  }
}
  function play($test_id , $slug=''){ //hex
    $tid = hex2bin($test_id);
    $data['post'] = $this->tests->get_tests_by_id($tid);
    $data['questions'] = $this->tests->get_test_questions($tid);
    $data['ques_count'] = $this->tests->test_questions_count($tid);
    $data['author']=$this->tests->author($data['post']['test_author']);
    $data['title']=$data['post']['test_title'];
    $data['desc'] = $data['post']['test_summary'];

    $this->load->view('inc/header',$data);
    $this->load->view('prs/test',$data);
    $this->load->view('inc/footer',$data);
}
   function test_submit(){
     $this->load->library('user_agent');
    $output = "<span class='text-danger'>something went wrong! please try after sometime</span>";
     $test_id = $this->input->post('test_id');
      $session_id = $this->tests->test_session($this->session->name);
       $que_id = $this->input->post('que_id[]');
       $true = $this->input->post('true_option[]');
       $uid = $this->input->post('uid');
       $ip =  md5($this->input->ip_address().$this->agent->browser().' '.$this->agent->version());
        $roll_no = $this->input->post('roll_no');
        for ($i=0; $i < count($que_id) ; $i++) {
          $data = array(
            'test_id' => $test_id,
            'session_id' => $session_id, //id of Unique test attempt
            'uid' => $uid,
            'roll_no' => $roll_no,
            'user_ip' => $ip,
            'que_id' => $que_id[$i],
            'true_option' => $true[$i],
            'response' => $this->input->post('option'.$que_id[$i])
          );
          $this->tests->save_test_responses($data); //tests model
        }
        //generate results
        $result_id = $this->tests->generate_test_result($session_id,$uid,$ip);
        // getting result of current test , from model tests_model
        $result = $this->tests->get_test_result($result_id);

        // $post  = $this->
        $output = '<div class="card p-2"> <h3> Report Card  (Result Id : '. $result_id .'  Session ID : '. $result['session_id'] .') </h3>';

          $output .= '<a href="tests/test_result/" class="btn btn-st-primary"> Check Result  <i class="fa fa-arrow-right"> </i></a>';
          $output .= '</div>';
          $this->session->set_userdata('rid',$result_id);
          echo $output;
   }

   function test_result(){ //result_id
     if (isset($_GET['rid']) || @$_GET['rid']!='') {
        $id = $_GET['rid'];
     }
     else{
       if (isset($this->session->rid)) {
          $id = $this->session->rid;
       }
       else{
         return "An Error Occured! result id required";
       }

     }
     $result = $this->tests->get_test_result($id);
     if ($result=='') {
       echo "Argument error ! Result needs a valid id";
       return null;
     }
     $post = $this->tests->get_tests_by_id($result['test_id']);
     $data['post'] = $this->tests->get_tests_by_id($result['test_id']);
     $data['title'] = " test completion report card " . $post['test_title'] ;
     $data['og_image'] = ucwords($post['test_img']);
      $data['og_desc'] = "Test Your Basics, start " .$post['test_title']. " absolutely free";
      $data['og_title'] = "I got " . $result['marks']/$result['total_questions']*100 .' % marks in '. $post['test_title'] .'\n';
     $output = '<div class="card row m-0" style="background:url('.base_url().'media/images/default/bg-pattern.png);background-size:cover;display:flex-block;"> <p>Test Attempted : '.anchor('tests/play/'.bin2hex($post['test_id']).'/'.$post['test_slug'].'?anonymus_access=true',ucwords($post['test_title'])) .'</p>';
     $output .= ' <p class="p-2 m-0"> Total Questions : <strong>'. $result['total_questions'] .'</strong></p>
       <p class="p-2 m-0">Attempted : <strong class="border rounded-circle p-2 text-info">'. $result['answered'] .'</strong>'. br(2) .'
        Skipped : <strong class="border rounded-circle p-2 text-warning">'. ($result['total_questions'] - $result['answered'] ) .'</strong></p>
       <p class="p-2 m-0">Correct Responses : <strong class="border rounded-circle p-2 text-success">'. $result['correct'] .'</strong> '. br(2) .'
       Incorrect Responses : <strong class="border rounded-circle p-2 text-danger">'. $result['incorrect'] .'</strong></p>
       <p span class="p-2 m-2">Marks Obtained </p><h3><strong class="p-2 m-3">'. $result['marks'] .'</strong> <strong class="border rounded p-2 m-0"> '. ($result['marks']/$result['total_questions']*100) .'%</strong></h3> <hr>
       <small>Result Generated : '. date('d-M-Y H:i:s',strtotime($result['test_time'])) . nbs(2).' (Result Id : '. $id . nbs(2).' Session Id : '. $result['session_id'] . nbs(2).'  IP : '. $result['user_ip']  .nbs(2).'  User :  '. $result['name'] .' )</small>
     ';
       $output .= '</div>';

        $data['result'] = $output;
        $data['questions'] = $this->tests->question_wise_report($result['test_id'],$result['user_ip'], $result['session_id'],$result['uid']);

        // $data['response'] = $this->tests->get_test_questions($result['test_id']);
        $this->load->view('inc/header',$data);
          $this->load->view('prs/test-result',$data);
        $this->load->view('inc/footer');
   }

   function merit_list($test_id = null,$test_slug=null){
     if ($test_id == null) {
       return null;
     }
    $post = $this->tests->get_tests_by_id($test_id);
    $data['title']= 'Result for test ' . $post['test_title'];
     $data['list'] = $this->tests->generate_merit($test_id);
      $this->load->view('inc/header',$data);
     $this->load->view('prs/tests/merit-list',$data);
     $this->load->view('inc/footer',$data);
   }

  function generate(){
    $data['title']='Generate test';
    $data['desc'] = "Generate tests for students";
      $data['ogimage'] = '';//later put an image for this topic
    $this->load->view('inc/header',$data);
    $this->load->view('inc/forms/test-form',$data);
    $this->load->view('inc/footer',$data);
  }

  function add_questions(){
    $input = json_decode(file_get_contents('php://input'),true);
    $data = array(
      "test_id"=>$input['test_id'],
      "qno"=>$input['qno'],
      "que_title"=>$input['que_title'],
      "que_desc"=>$input['que_desc'],
      "a"=>$input['a'],
      "b"=>$input['b'],
      "c"=>$input['c'],
      "d"=>$input['d'],
      "ans"=>$input['ans'],
      "expl"=>$input['expl'],
      "type"=>$input['type']
    );
    $this->db->insert('test_que',$data);
    echo $this->db->insert_id();
    exit;
  }
  function import($ext){ //import questions
    $filename = $_FILES['csv_file']['name'];
    $tmp = $_FILES['csv_file']['tmp_name'];
    $test_id = $this->input->post('test_id');
    if ($ext == 'csv') {

      $far = explode('.',$filename);
      if (end($far)!='csv') {
       $data = array('msg'=>"<span class='text-warning'>This is not a valid file, only CSV file is required!</span>",'type'=>'err');
       echo json_encode($data);
      }
      else{
        $file_data =  fopen($tmp,'r');
       fgetcsv($file_data);
          $i = 0;
       while($row = fgetcsv($file_data))
       {
         $data[]= array(
          "test_id"=>$test_id,
         "qno"=>$row[0],
         "que_title"=>$row[1],
         "que_desc"=>$row[2],
         "a"=>$row[3],
         "b"=>$row[4],
         "c"=>$row[5],
         "d"=>$row[6],
         "ans"=>$row[7],
         "expl"=>$row[8],
         "type"=>$row[9]
        );
       }
     foreach ($data as $key => $value) {
      $this->db->insert('test_que',$value);
     }
       echo json_encode($data);
      }
    } //csv ext..
  }
  function delete_question($qid){
      $qid = hex2bin($qid);
    $que = $this->tests->get_question($qid);
    $test_id = $que['test_id'];
    $qno = $que['qno'];
    if ($qid!='') {
      $this->db->from('test_que')->where(array('test_id'=>$test_id,'qno >'=>$qno));
      $res = $this->db->get()->result_array();
      $i = 0;
      foreach ($res as $row) {
        $this->db->where('que_id',$row['que_id']);
          $this->db->update('test_que',array('qno'=>$qno + $i));
          $i++;
      }
        $this->db->where('que_id',$qid);
        $this->db->delete('test_que');
      $ref = $_SERVER['HTTP_REFERER'];
      return redirect($ref);
    }
    else{
      echo "an error occured..!";
    }
  }
  function edit_question($qid=''){ //in hex
    if ($qid!='') {
      $qid = hex2bin($qid);
      $que = $this->db->get_where('test_que',array('que_id'=>$qid));
      $data['que'] = $que->row_array();
      $this->load->view('inc/header',$data);
        $this->load->view('inc/forms/inc/test-que-edit',$data);
          $this->load->view('inc/footer');
    }
    else {
      echo "an error occured!";
    }
  }
  function update_question(){
    if (isset($_POST['que_id']) && $this->input->post('que_id')!='') {
      $qid = $this->input->post('que_id');
      if ($qid !='') {
        $qid = $qid;
        $data = array(
          'qno'=>$this->input->post('qno'),
          'que_title'=>$this->input->post('que_title'),
          'que_desc'=>$this->input->post('que_desc'),
          'a'=>$this->input->post('a'),
          'b'=>$this->input->post('b'),
          'c'=>$this->input->post('c'),
          'd'=>$this->input->post('d'),
          'ans'=>$this->input->post('ans'),
          'expl'=>$this->input->post('expl')
        );
        $this->db->where('que_id',$qid);
        $this->db->update('test_que',$data);
        $ref = $_SERVER['HTTP_REFERER'];
        return redirect($ref);
      }
    }
    else{
      echo "an error occured..!";
    }
  }
  //private functions  for ajax
  function st_sess_test_iden(){ //anonymous test user
    $this->session->set_userdata('name',$this->input->post('name'));
  }

/* --------------------------------------------------------------------\
------------------------- test add edit/update section ----------------
------------------------------------------------------------------------*/
function edit($id=null){ //id in hex
    $test_id = hex2bin($id);
    $data['post'] = $this->tests->get_tests_by_id($test_id);
    $data['title'] = "edit : " .$data['post']['test_title'];
    $this->load->view('inc/header',$data);
    //check author
      if (is_test_author($data['post']['test_author']) || is_admin() || is_editor()) {
      $this->load->view('inc/forms/test-edit',$data);
      }
      else{
        return redirect('home');
      }
    $this->load->view('inc/footer',$data);
  }
  /*-------------------------------------------\
    insert tests...
  --------------------------------------------*/
  function insert_test(){
      $this->form_validation->set_rules('test_title','Test title','required|trim');
      $this->form_validation->set_rules('test_slug','Test slug',"required|trim|is_unique[tests.test_slug]");

          if ($this->form_validation->run()) {

            $data = array(
              'test_title'     => $this->input->post('test_title'),
              'test_slug'      => $this->input->post('test_slug'),
              'test_summary'   => $this->input->post('test_summary'),
              'test_author'    => $this->input->post('test_author'),
              'test_time'      => $this->input->post('test_time')
            );
            $this->db->insert('tests', $data);
              $test_id = $this->db->insert_id();
              return redirect('tests/edit/'.bin2hex($test_id));
            }
            else {
              $this->generate();
        }
  }
  function update_test(){
    $this->form_validation->set_rules('test_title','Post title','required|trim');
    $this->form_validation->set_rules('test_body','Post content',"required|trim");
    if ($this->form_validation->run()) {
        $data = array(
          'test_title'     => $this->input->post('test_title'),
          'test_slug'     => $this->input->post('test_slug'),
          'test_summary'   => $this->input->post('test_summary'),
          'test_body'      => $this->input->post('test_body'),
          'test_status'   => $this->input->post('test_status')
        );
       $this->db->where('test_id', $this->input->post('test_id'));
        $query =	$this->db->update('tests',$data);
        echo "post updated succesfully " . anchor($this->input->post('test_slug'),'view post'). $this->input->post('test_title');
      }
    else{
        echo "error! something went wrong";
    }
   }
}
