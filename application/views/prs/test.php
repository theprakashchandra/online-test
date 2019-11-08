<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
DATE_DEFAULT_TIMEZONE_SET('Asia/kolkata');
?>
<div class="p-1 row justify-content-between m-0 bg-transparent border-bottom">
  <p class="p-1 col-md-4 m-0" style="white-space:nowrap;"><button class="btn btn-light border rounded-circle" disabled title="cancel test"><i class="fa fa-arrow-left"></i></button>
    <span class="p-2"><?=$post['test_title'];?></span>
  </p>
  <p class="text-center pl-2 text-secondary p-2">  <i class="fa fa-question-circle"> No. of Que. : <?=$ques_count;?> </i> <?=nbs(2);?> <br>
   <i class="fa fa-clock"> Time :  <?=test_time($ques_count);?> Minutes </i></p>

   <div id="timer" class="text-center">
     <div class="clock-wrapper">
         <span class="hours">00</span>
         <span class="dots">:</span>
         <span class="minutes">00</span>
         <span class="dots">:</span>
         <span class="seconds">00</span>
     </div>
   </div>

     <input type="number" id="num" class="form-control" min="0" value="<?=test_time($ques_count);?>" hidden>
     <input id="measure" class="form-control" value="m" hidden>

     <div class="p-0 text-right user" style="width:auto;">
       <p class="text-left float-right"><img src="<?=base_url();?>media/images/user-icon.png" alt="" height="30" width="30" align="left">
        <strong><?=$_SESSION['name'];?></strong> <br>
        <strong><span class="border rounded bg-light text-st-primary p-1"><?=roll_no($_SESSION['uid']);?></span> </strong>
      </p>
     </div>

</div>
<div class="test-start-window container" id="stPreTestWin" style="padding-bottom:150px;">
  <div class="float-right card-body text-center border rounded">
    <img src="<?=base_url();?>media/images/user-icon.png" alt="" height="150" width="150" align="none"><br>
    <h4>
      <strong><?=$_SESSION['name'];?></strong><br>
      <strong><span class="border rounded bg-light text-st-primary p-1"><?=roll_no($_SESSION['uid']);?></span> </strong>
    </h4> <?php // NOTE: 6 characters long , helper function roll_no(); ?>
  </div>

  <p class="text-warning row m-0 p-1">Please Note and Read these Guidelines carefully</p>
  <hr>
  <ol class="p-2">
    <li>This is a sample Aptitute Test to check your Progress. </li>
    <li>This test should be completed in a given time. And you can check your results just after the completion of test or may be after some time.</li>

    <li>Check only any one option from given 4 options, then click on the save <button class="btn btn-st-primary" disabled>save</button>or next button<button class="btn btn-st-primary" disabled>&gt;</button></li>
    <li>if you have a doubt then mark question for review <button class="btn btn-warning p-1" disabled>mark for review</button> </li>
    <li>To go to previous or next question click on <button class="btn btn-st-primary" disabled>&lt;</button> or <button class="btn btn-st-primary" disabled>&gt;</button></li>
    <li>To go to a particular question click on button showing the question no. i.e to go to Q.no 5 click on <button class="btn border rounded-circle" disabled>5</button>  button </li>
    <li>On the question navigation pannel identify the question by its color<br>
      <button class="btn btn-danger border rounded-circle" disabled>5</button> - Question not attempted or skipped<br>
      <button class="btn btn-success border rounded-circle" disabled>5</button> - Attempted Question<br>
      <button class="btn btn-warning border rounded-circle" disabled>5</button> - Attempted and marked for review<br>
       <button class="btn btn-info border rounded-circle" disabled>5</button> -currently active question <br>
       <button class="btn border rounded-circle" disabled>5</button> - Remaining Questions<br>
     </li>
     <li>To submit the test after completion of all Questions click on  <button class="btn btn-success" disabled>Submit Test</button> button</li>
     <li>After the completion of provided  time the test will submitted Atomatically, click on the confirm submit button </li>
  </ol>
  <hr>

<p class="text-center test-start-bottom p-2 border ">
Before clicking on the Start Button must Ensure you Have Read and understood above guidelines <br>
  <a href="javascript:void(0);" class="btn btn-st-primary test-starter p-2" id="start-countdown"> Start the Test  <i class="fa fa-arrow-right"> </i></a> </p>
</div>

 <div class="st-tests-window container hidden table-responsive" id="stTestsWin">
   <div class="left">
     <form id="ResForm" class="form" action="tests/test_submit" method="post">
        <input type="text" name="test_id" value="<?=$post['test_id'];?>" hidden>
        <input type="text" name="uid" value="<?=$_SESSION['uid'];?>" hidden>
        <input type="text" name="roll_no" value="<?=roll_no($_SESSION['uid']);?>" hidden>
          <input type="text" name="total_que" value="<?=$ques_count;?>" hidden>
          <?php
            $tm = new tests_model;
            // echo $tm->get_session_id();
            // NOTE: Unique session id
           ?>
           <input type="text" name="session_id" value="<?=$tm->get_session_id();?>" hidden>
         <?php $mcq = $questions; ?>
           <?php include(dirname(dirname(__FILE__)).'/inc/crousel/test-que.php'); ?>

          <p class="test-start-bottom p-2 border ">
            <button type="button" class="btn btn-success rounded-circle attempted-que" disabled>0</button> <small>Attempted</small>
            <button type="button" class="btn btn-warning rounded-circle marked-review-que" disabled>0</button><small>Attempted & marked for review </small>
            <button type="button" class="btn btn-danger rounded-circle skipped-que" disabled>0</button> <small>Skipped/ not Attempted</small>
            <button type="button" class="btn border btn-dark rounded-circle unseen-que" disabled><?=$ques_count;?></button> <small>Unseen / not Attempted</small>

              <!-- attempted/ not attempted-->
              <!-- <input name="attempted" value="0" class="attempted-que" hidden>
                <input name="attempted" value="0" class="attempted-que" hidden>
                  <input name="attempted" value="0" class="attempted-que" hidden>
                    <input name="attempted" value="0" class="attempted-que" hidden> -->

              <input type="submit" id="stTestSubmit" class="btn btn-success save-and-next p-2 float-right" value="Submit Test">
            </p>
      </form>
   </div>
    <div class="right">
        <?php $i = 0;?>
        <?php foreach ($questions as $row): ?>
           <a href="javascript:void(0);" class="ques-nav nav<?=$i;?> btn border rounded-circle" data-target="#slide<?=$row['que_id'];?>" id="qNav<?=$row['que_id'];?>">
             <?=$row['qno'];?>
           </a>
           <?php $i++; ?>
        <?php endforeach; ?>
    </div>
 </div>
 <!--/model for feedback form-/-->
 <div class="model-wrapper" id="reportQue">
   <div class="model-inner">
     <div class="model-body bg-light p-3">
         <form class="feedback-form" action="tests/report_que" method="post">
           <p class="p-3 border-bottom row justify-content-between">
             <span class="btn text-primary model-close-btn border rounded"><i class="fa fa-arrow-left"> </i> cancel</span>
             <!-- <span class="btn bnt-dark model-close-btn rounded-circle"><i class="fa fa-times"></i></span> -->
                <input type="submit" id="r_submit" value="send Report" class="btn-st-primary p-2 border rounded">
           </p>
           <p class="p-2"><?=$_SESSION['name'];?>, what do you want to report about this Question?</p>
           <input type="text" name="r_uid" value="<?=$_SESSION['uid'];?>" hidden>
           <input type="text" name="r_que_id" value="" id="r_qid" hidden>
           <select class="input" name="r_reason">
              <option value="wrong Question or wrong options">wrong Question or wrong options</option>
              <option value="not from syllabus">not from syllabus</option>
               <option value="having trouble in slecting /submitting">having trouble in slecting/submitting</option>
               <option value="others">others ( please explain)</option>
           </select>
           <textarea name="r_expl" class="form-control input" placeholder="explain.. Why You are reporting this?"></textarea>

         </form>
     </div>
   </div>
 </div>

 <div id="testCofirmWin" class="model-wrapper">
 <div class="model-inner" style="width:70%;margin:auto;">
   <div class="model-body bg-light border rounded p-3">
     <p class="p-3 m-2"> Success! <i class="fa fa-check-circle text-success"></i> you have completed your test</p>
     <p class="border rounded bg-white p-3 m-2">
       Here is a short summary of your Questions Attempted <br> <br>
       <button type="button" class="btn btn-dark rounded-circle" disabled> <?=$ques_count;?> </button> - Total Questions <br> <br>
       <button type="button" class="btn btn-success rounded-circle attempted-que" disabled>0</button> - Attempted <br> <br>
       <button type="button" class="btn btn-danger rounded-circle skipped-que" disabled>0</button> - Skipped/Not Attempted <br><br>
       <button type="button" class="btn border btn-dark rounded-circle unseen-que" disabled><?=$ques_count;?></button> - Unseen/ Not Attempted <br><br>
     </p>
     <button class="st-confirm btn btn-st-primary" data-value="1"> confirm Submit</button>
     <button class="st-confirm btn btn-warning" data-value="0" id="noSubmit">No! Return to test</button>

   </div>
 </div>
 </div>
<style media="screen">
  a:hover{
    color: unset!important;
  }
 .content-wrapper{
   padding:0px !important;
   margin: 0px!important;
   background: url('<?=image_dir();?>default/bg-pattern.png');
   min-height: 100vh;
 }
 .model-wrapper{
   background: rgba(0,255,0,0.4);
   padding: 100px 30px;
 }
 ol li{
   padding: 3px;
   margin: 3px;
 }
 .test-start-window{
   max-height: 90vh;
   height: auto;
   overflow: auto;
   margin-bottom: 150px;
   padding-bottom: 100px;
 }
 .test-start-bottom{
   position: fixed;
   bottom: 0px;
   margin: 0px;
   top: auto;
   left: 0px;
   width: 100%;
   background: #fff;
   height: auto;
 }
 .st-tests-window{
   padding-bottom: 100px!important;
   margin-bottom: 180px!important;
 }
 input[type=submit]{
   width: auto!important;
   border-radius: 3px!important;
 }
 @media screen and (max-width : 600px){
   .model-wrapper,.model-inner,.model-body{
     margin-top: 0px;
     margin-left: opx;
     margin-right: 0px;
     padding: 0px;
   }
   .st-tests-window .right{
     padding-top: 5px;
     margin-top: 5px;
     text-align: center;
   }
   .left , form, .st-tests-window, .crousel-wrapper{
     width: 100%;
     padding: 0px!important;
     margin: 0px;
   }
   button,input[type=submit]{
     padding: 3px;
     font-size: 18px;
     height: auto;
     width: auto;
   }
   .header p{
     font-size: 16px;
     padding: 5px;
     /* display: block!important; */
   }
   .header.row{
     /* display: block !important; */
   }
   .header .user{
     /* width: 100%!important; */
     float: right!important;
   }
   .user p{
     /* min-width: 300px; */
   }
   .model-inner{
     width: 100%!important;
   }
   .test-start-window .card-body , .test-start-window .card-body img{
     width: 100%;
   }

 }
 .st-tests-window,.crousel-wrapper {
   background: transparent;
   padding: 20px;
 }
 #ResForm,.left{
   background: transparent!important;
   padding: 3px 10px;
 }
 .t-mcq-option{
   width: 100%;
   box-shadow: 0 0 0 0!important;
   text-align: left;
 }
</style>
<script type="text/javascript">

  $(function(){
    $(document).keydown(function(e){
      var target = $(e.target);
      if (target.is('.form-control')) {
        return true;
      }
      else{
            return false;
      }
    }); // keyboard not required

      $('button').attr('type','button');

      $('.nav0').addClass('btn-info');

      $(document).on('click','.test-starter',function(){
        $('#stPreTestWin').hide();
        $('#stTestsWin').removeClass('hidden');
        //time countdown
      })
      $(document).on('click','.ques-nav',function(){
      var target = $(this).data('target');
      $(target).show();
      $('.content-slide').not(target).hide();
      $(this).addClass('btn-info');
      $('.ques-nav').not(this).removeClass('btn-info');
      })


    $('form#ResForm').on('submit',function(e){
      e.preventDefault();
      var form = $(this);
      $('#testCofirmWin').show();
      $(document).on('click','.st-confirm',function(){
        var confirm = $(this).data('value');
        if (confirm === 1 ) {
          $.ajax({ //insert responses and show result on success
            url : "tests/test_submit",
            data : form.serialize(),
            method : "POST",
            beforeSend : function(){
              $('#testCofirmWin .model-body').html('<i class="fa fa-spin fa-spinner text-info"></i> submitting and Generating Result');
            },
            success : function(data){
              $('#testCofirmWin .model-body').html(data);
            }
          })
        }
        else if (confirm === 0) {
          $('#testCofirmWin').hide();
        }
      })

    })
    $('.report-this').on('click',function(){
      $('#reportQue').show();
      $('#r_qid').val($(this).data('qid'));
    })
    //submit form with ajax
    $('form.feedback-form').on('submit',function(e){
      e.preventDefault();
    })
  })
</script>
