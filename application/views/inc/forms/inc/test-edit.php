<?php // NOTE: form for csv to mysql
$test_id = $post['test_id']; //from its parent file test_edit.php
 $tm = new tests_model;
$questions = $tm->get_test_questions($test_id);
  ?>
  <p class="p-2 m-2 bg-light border rounded"><a href="javascript:void(0);" data-target="#testQuestions" class="model-opener btn btn-light">View /Edit Questions</a></p>
<div id="testQuestions" class="table-responsive model-wrapper">
  <div class="model-inner" style="width:100%;margin:auto;">
    <div class="model-header" style="">
      <p class="float-left"><button class="model-close-btn btn btn-light rounded-circle"><i class="fa fa-arrow-left"></i></button>
        <?=ucwords($post['test_title']);?>
      </p>
      <button class="model-close-btn float-right btn btn-light rounded-circle"><i class="fa fa-times"></i></button>
    </div>
 <?php if ($questions!=''): ?>

   <table class="table table-bordered table-striped bg-light">
     <thead>
       <tr class="headings">
         <th>Action</th>
         <th>Test_id</th>
         <th>Q.No.</th> <!--test_id-->
         <th>Que title</th>
         <th>Que desc.</th>
         <th>Option 1 (o-1)</th>
         <th>Option 2 (b)</th>
         <th>Option 3 (c)</th>
         <th>Option 4 (d)</th>
         <th>Currect Option (ans)</th>
         <th>Explanation</th>
         <th>Type</th>
      </tr>
    <tbody>
   <?php foreach ($questions as $row): ?>
          <tr>
            <?php // NOTE: edit in place ?>
            <td>
              <?php if (is_test_author($post['test_id']) || is_admin() || is_editor()): ?>
                <a href="tests/delete_question/<?=bin2hex($row['que_id']);?>"><i class="fa fa-trash text-danger"> delete</i></a> <?=nbs();?>
                 <a data-target="#editorFrame" class="model-opener" href="tests/edit_question/<?=bin2hex($row['que_id']);?>" target="quiz_editor"><i class="fa fa-pen text-warning"> edit</i></a>
              <?php endif; ?>
            </td>
               <td class="input-cell"><?=$post['test_id'];?></td>
               <td class="input-cell"><?=$row['qno'];?></td>
               <td class="input-cell test-e-cell" data-field="que_title" data-value="<?=$row['que_title'];?>"><?=$row['que_title'];?></td>
               <td class="input-cell test-e-cell" data-field="que_desc" data-value="<?=$row['que_desc'];?>"><?=$row['que_desc'];?></td>
               <td class="input-cell test-e-cell" data-field="a" data-value="<?=$row['a'];?>"><?=$row['a'];?></td>
               <td class="input-cell test-e-cell" data-field="b" data-value="<?=$row['b'];?>"><?=$row['b'];?></td>
               <td class="input-cell test-e-cell" data-field="c" data-value="<?=$row['c'];?>"><?=$row['c'];?></td>
               <td class="input-cell test-e-cell" data-field="d" data-value="<?=$row['d'];?>"><?=$row['d'];?></td>
               <td class="input-cell test-e-cell" data-field="ans" data-value="<?=$row['ans'];?>">
                 <select class="border rounded" name="ans_e[]">
                   <option value="<?=$row['ans'];?>"><?=$row['ans'];?></option>
                    <option value="a"><?=$row['a'];?></option>
                     <option value="b"><?=$row['b'];?></option>
                      <option value="c"><?=$row['c'];?></option>
                       <option value="d"><?=$row['d'];?></option>
                 </select>
               </td>
               <td class="input-cell test-e-cell" data-field="expl" data-value="<?=$row['expl'];?>"><?=$row['expl'];?></td>
               <td class="input-cell test-e-cell" data-field="type" data-value="<?=$row['type'];?>"><?=$row['type'];?></td>
             </tr>
   <?php endforeach; ?>
         </tbody>
      </thead>
    </table>
 <?php endif; ?>

 <div class="model-wrapper" id="editorFrame">
   <div class="model-header row justify-content-between">
     <p class="p-2"><button class="model-close-btn btn rounded-circle"><i class="fa fa-arrow-left"></i></button>
     Edit Question </p>
       <button class="model-close-btn  btn rounded-circle"><i class="fa fa-times"></i> </button>
   </div>
   <iframe src="" width="100%" height="600" name="quiz_editor" seamless frameborder='0'></iframe>
 </div>
    </div>
  </div>

<p class="p-2 border rounded m-2 bg-light"><a data-target="#testQFrm" href="javascript:void(0);" class="model-opener btn btn-light"> <i class="fa fa-plus-circle"> </i>Add Questions to this Test</a></p>

<div class="card model-wrapper" id="testQFrm" style="background:rgba(0,0,0,0.2);">
  <div class="model-inner" style="width:70%;margin:auto;">
    <div class="model-header">
      <p class="float-left"><button class="model-close-btn btn btn-light rounded-circle"><i class="fa fa-arrow-left"></i></button>
          Add Questions to <?=$post['test_title'];?>
      </p>
      <button class="model-close-btn float-right btn btn-light rounded-circle"><i class="fa fa-times"></i></button>
    </div>
    <div class="model-body p-3" style="width:70%;margin:auto;">
      <input class="border rounded input" Type="text" name="test_id" value="<?=$post['test_id'];?>" hidden>
      <?php
          $tm = new tests_model;
          $Qno = $tm->get_next_question_number($post['test_id']);
       ?>
      <input class="border rounded input bg-light que-no-input" Type="text" name="qno" placeholder="question no. (i.e 1)" value="<?=$Qno;?>" hidden>
      <input class="border rounded input bg-light que-no-input" Type="text" name="qno_v" placeholder="question no. (i.e 1)" value="Q.No. <?=$Qno;?>" disabled>
      <!-- <label class="float-left">Question Title (Required) :</label> -->
      <input class="input-border-bottom rounded input" Type="text" name="que_title" placeholder="Question title">
      <p class="text-left"><!--Question Description (if any) :-->
        <textarea class="que-desc-input input-border-bottom rounded input" name="que_desc" placeholder="Que Description (if any)"></textarea>
      </p>
      <input class="input-border-bottom rounded input mcq-option" Type="text" name="a" placeholder="option 1 (a)">
      <input class="input-border-bottom rounded input mcq-option" Type="text" name="b" placeholder="option 2 (b)">
      <input class="input-border-bottom rounded input mcq-option" Type="text" name="c" placeholder="option 3 (c)">
      <input class="input-border-bottom rounded input mcq-option" Type="text" name="d" placeholder="option 4 (d)">
      <select class="input-border-bottom rounded input true-option" name="ans"><option value="">Select Correct Option</option></select>
      <script type="text/javascript">
        $(function(){
          $(document).on('change','select',function(e){
            e.preventDefault();
            $('textarea').val()
          })
        })
      </script>
      <p>
        <textarea class="input-border-bottom rounded input" name="expl" placeholder="Explain the Answer (Optional)"></textarea>
      </p>
      <input class="border rounded input" Type="text" name="type" placeholder="question type (mcq or dbq (description based))" hidden>
        <button type="button" id="addTestQue" class="btn btn-st-primary"> + Add </button>
    </div>
  </div>
</div>

<!---test import- -->
<p class="p-3 bg-light m-2 border rounded"><a href="javascript:void(0);" data-target="#csvImpFrm" class="model-opener btn btn-light"> <i class="fa fa-import"> </i>Import Questions From Csv file</a></p>
<?php // NOTE: file included aftre ending of this form ?>


<style media="screen">
  td textarea{
    width: 200px;
    max-height: auto;
    min-height: 50px;
    border-radius: 0;
    box-shadow: 0 0 0 0;
  }
  @media screen and (max-width : 600px){
    .model-inner, .model-body{
      width:100%!important;
    }
    .model-inner .input{
      width: unset!important;
      margin: auto;
    }
    .model-inner{
      padding: unset!important;
    }
    .model-inner .model-header p{
      white-space: nowrap;
      width: 80%;
      overflow: auto;
    }
    .post-content{
      width:100%!important;
    }
  }
  .content-wrapper{
    width: 98%;
  }
  .model-wrapper .input{
    margin: 5px!important;
  }
  .mcq-option ,.input{
    width: 100%!important;
  }
  .model-inner{
    background: #fff;
    padding: 5px;
    text-align: center;
  }
</style>

<script type="text/javascript">
  $(function(){
    //load #testQuestions after question added
    $(document).on('change','.mcq-option',function(){
      // $(this).val($(this).val().charAt(0).toUpperCase())
      var options = '';
      var oVal;
     for (var i = 0; i < $('.mcq-option').length; i++) {

       if (i == 0) {
         oVal = "a";
       }
       if (i == 1) {
         oVal = "b";
       }
       if (i == 2) {
         oVal = "c";
       }
       if (i == 3) {
         oVal = "d";
       }
      options += '<option value='+oVal+'>'+$('.mcq-option').eq(i).val()+'</option>';
    }
     $('.true-option').html(options);
   })

   $(document).on('click','#addTestQue',function(){
     var Qno = $('[name=qno]').val();
      var QDesc = $('[name=que_desc]').val();
     var dataStr = JSON.stringify({
       test_id : $('[name=test_id]').val(),
       qno : $('[name=qno]').val(),
       que_title : $('[name=que_title]').val(),
       que_desc : $('[name=que_desc]').val(),
       a : $('[name=a]').val(),
       b : $('[name=b]').val(),
       c : $('[name=c]').val(),
       d : $('[name=d]').val(),
       ans : $('[name=ans]').val(),
       expl : $('[name=expl]').val(),
      type : $('[name=type]').val()
   });
   if ($('[name=que_title]').val()!='') {
     $.ajax({
       url : "tests/add_questions",
       method : "POST",
       data : dataStr,
       dataType:'json',
       contentType:'application/json',
       cache:false,
       processData:false,
       beforeSend:function(){
         $('#addTestQue').text('processing..');
          $('#addTestQue').attr('disabled','disabled');
       },
       success:function(data){
         $('#addTestQue').text('Go');
          $('#addTestQue').attr('disabled',false);
          $('#addTestQue').siblings('.input').val('');
          $('#addTestQue').siblings('p').children('textarea').val('');
          $('.que-no-input').val(+Qno + 1);
            $('.que-desc-input').val(QDesc);
         $('#testQuestions').load(location.href +" #testQuestions");
       }
     })
   }
else{
  alert("empty form");
}
  })
});

</script>
