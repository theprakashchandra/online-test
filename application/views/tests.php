<?php
/* tests.php view part
  * display all tests
  *
  */
 ?>
<div class="container-fluid m-0 p-3">
<?php if ($view=='single'): ?>
<article class="left">
  <h3><?=ucwords($post['test_title']);?></h3>
  <?php $tm = new tests_model; ?>
  <small class="text-info bg-light row m-0 justify-content-between">
    <small><?=$tm->test_questions_count($post['test_id']); ?> Questions</small>
     <small><?=$tm->test_results_count($post['test_id']); ?> Attempts</small>
  </small>
  <div class="border-top rounded p-3 bg-white">
      <?=$post['test_body'];?>

          <a href="tests/play/<?=bin2hex($post['test_id']);?>/<?=$post['test_slug'];?>/" class="btn btn-primary float-right btn-transparent  pl-3 pr-3"> Start Test </a>


  </div>

 <?php if ($questions!=''): ?>
   <table class="table table-responsive table-bordered">
     <thead>
       <tr class="headings">
         <!-- <th>Test_id</th> -->
          <th>Action</th>
         <th>Q.No.</th> <!--test_id-->
         <th>Que title</th>
         <th>Que desc.</th>
         <th>Option 1 (a)</th>
         <th>Option 2 (b)</th>
         <th>Option 3 (c)</th>
         <th>Option 4 (d)</th>
      </tr>
    <tbody>
   <?php foreach ($questions as $row): ?>
          <tr>
               <!-- <td class="input-cell"><?=$post['test_id'];?></td> -->
               <td class="input-cell">
                 <?php if (is_test_author($post['test_id']) || is_admin() || is_editor()): ?>
                   <a href="tests/delete_question/<?=bin2hex($row['que_id']);?>"><i class="fa fa-trash text-danger"> delete</i></a> <?=nbs();?>
                    <a data-target="#editorFrame" class="model-opener" href="tests/edit_question/<?=bin2hex($row['que_id']);?>" target="quiz_editor"><i class="fa fa-pen text-warning"> edit</i></a>
                 <?php endif; ?>
               </td>
               <td class="input-cell"><?=$row['qno'];?></td>
               <td class="input-cell"><?=$row['que_title'];?></td>
               <td class="input-cell"><?=$row['que_desc'];?></td>
               <td class="input-cell"><?=$row['a'];?></td>
               <td class="input-cell"><?=$row['b'];?></td>
               <td class="input-cell"><?=$row['c'];?></td>
               <td class="input-cell"><?=$row['d'];?></td>
             </tr>
   <?php endforeach; ?>
         </tbody>
      </thead>
    </table>

          <a href="tests/play/<?=bin2hex($post['test_id']);?>/<?=$post['test_slug'];?>/" class="btn btn-primary float-right pl-3 pr-3"> Start Test </a>


    <div class="model-wrapper" id="editorFrame">
      <div class="model-header row justify-content-between">
        <p class="p-2"><button class="model-close-btn btn rounded-circle"><i class="fa fa-arrow-left"></i></button>
        Edit Question </p>
          <button class="model-close-btn  btn rounded-circle"><i class="fa fa-times"></i> </button>
      </div>
      <iframe src="" width="100%" height="600" name="quiz_editor" seamless frameborder='0'></iframe>
    </div>
 <?php endif; ?>
 <style media="screen">right
   .content-wrapper{
     width: 95%;
   }
 </style>
</article>
 <!--////////////////////////////////single post ends here////////////////////////////////////////-->
 <?php else: ?>
  <div class="container p-2">
   <h3 class="border-bottom bg-white p-2 row justify-content-between">All Tests <small><a href="tests/generate/" class="float-right"> Generate A test </a></small></h3>
   <?php if (isset($tests) && $tests!=''): ?>
     <div class="row justify-content-around">
       <?php foreach ($tests as $row): ?>
         <div class="card col-md-3 col-sm-12 col-xs-12 p-0" style="min-width:300px;">
           <?php if ($row['test_img']!=''): ?>
             <?php $test_image = $row['test_img']; ?>
             <?php else: ?>
                <?php $test_image = base_url()."media/images/def_test_img.jpg"; ?>
           <?php endif; ?>
           <div class="card-body" style="background:url(<?=$test_image;?>);height:150px; width:100%;background-size:cover;">
           </div>
           <p class="card-body p-2 m-0">
             <strong><?=ucwords($row['test_title']);?></strong> <br>
             <?=$row['test_summary'];?>
           </p>
           <?php $tm = new tests_model; ?>
           <p class="text-info bg-light row m-0 justify-content-between">
             <small><?=$tm->test_questions_count($row['test_id']); ?>
             Questions</small>
              <small><?=$tm->test_results_count($row['test_id']); ?>
               Attempts</small>
           </p>

           <!--links-->
           <a href="tests/play/<?=bin2hex($row['test_id']);?>/<?=$row['test_slug'];?>/" class="btn btn-primary pl-3 pr-3"> <i class="far fa-clock"></i> Start Test </a>

          <?php if (is_admin() || is_editor() || is_test_author($row['test_id'])): ?>
              <a href="tests/view/<?=$row['test_slug'];?>" class="btn btn-st-primary">view test</a>
                <a href="tests/edit/<?=bin2hex($row['test_id']);?>/" class="btn btn-warning">Edit test</a>
          <?php endif; ?>
         </div>
       <?php endforeach; ?>

     </div>
     <?php else: ?>
       <p class="card-body p-2">
          Tests not Generated yet <br>
          <a href="tests/generate">Generate a Test</a>
       </p>
   <?php endif; ?>
 </div>
<?php endif; ?>
</div>
<style media="screen">
  a:hover{
    color: #000!important;
  }
  .content-wrapper{
    width: 95%!important;
  }
</style>
