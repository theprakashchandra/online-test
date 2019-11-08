<?php
/*
* test-edit.php
* Updated on : 07th Nov, 2019
*/
 ?>
<?php if ($post!=null): ?>
<form id="post-edit-form" action="tests/update_test" method="post" enctype="multipart/form-data">

  <!-- hidden inputs -->
  <input id="post-status" type="text" name="test_status" value="0" hidden>
  <input id="post-id" type="text" name="test_id" value="<?=$post['test_id'];?>" hidden>

<article class="left container" style="width:68%;"
  <p class="text-center">
    <button class="btn" onclick="javascript:history.go(-1);"><i class="fas fa-arrow-left p-2 border rounded-circle"></i> Exit</button>
    <button type="submit" id="draft" class="btn btn-warning rounded border p-1 m-1"><i class="fa fa-save"> </i> Draft</button>
      <button type="submit" id="submit" class="btn btn-st-primary  p-1 m-1"><i class="fa fa-paper-plane"> </i> submit </button>
      <?php if (is_admin() || is_editor()): ?>
        <button type="submit" id="review" class="btn btn-secondary p-1 m-1"><i class="fa fa-spinner"> </i> Review </button>
    <button type="submit" id="publish" class="btn btn-success  p-1 m-1"><i class="fa fa-save"> </i> publish </button>
      <?php endif; ?>
  <button type="submit" id="delete" class="btn btn-danger p-1 m-1"><i class="fa fa-delete"> delete</i></button>
  <p id="success-msg">  </p>

      <?=test_status($post['test_status']);?>
</p>
  <div class="article-area" style="width:95%;margin:auto; float:none;">

      <label class="quiz-not"> Title <i class="fas fa-arrow-right"></i> </label> <input class="input input-inline input-border-bottom text-st-primary" type="text" name="test_title" value="<?php echo $post['test_title']; ?>"><br>

       <label>Slug <i class="fas fa-arrow-right"></i><?php echo base_url();?></label> <input class=" input-border-bottom input-inline text-primary p-1" type="text" name="test_slug" value="<?=$post['test_slug']; ?>"><br>
    <hr>
  <!--\......................................................../
                   /post body/
   \............................................................./-->
    <h4 class="quiz-not"><label class="text-secondary"> Description <i class="fas fa-edit"></i></label>
     </h4>
    <div class="post-content bg-white border rounded p-2" style="min-height:200px;">
    <?php //jodit editor ;?>
    <textarea class="editable" id="postBody" name="test_body"><?=$post['test_body'];?></textarea>
      <script> var editor = new MediumEditor('.editable'); </script>
  </div>

      <?php $test_id = $post['test_id']; ?>
      <?php include(dirname(__FILE__).'/inc/test-edit.php');?>

</div>
</article>
<aside class="right bg-light">
   <div class="widget bg-white border p-1 m-1">
 <!--\......................................................../
                  /post summary/
  \............................................................./-->
     <h5><label>Summary : </label>  &nbsp; &nbsp;  &nbsp;<i class="fas fa-pen text-warning edit-summary">edit</i> </h5>
     <textarea class="post-summary-textarea plane-text" name="test_summary"><?=$post['test_summary'];?></textarea>

   </div>
</aside>
</form>
  <div class="card col-12 model-wrapper" id="csvImpFrm" style="background:rgba(0,0,0,0.3);">
  <div class="model-inner" style="width:70%;margin:auto;">
    <div class="model-header">
      <p class="float-left"><button class="model-close-btn btn btn-light rounded-circle"><i class="fa fa-arrow-left"></i></button>
        Import Questions to <?=$post['test_title'];?>
      </p>
      <button class="model-close-btn float-right btn btn-light rounded-circle"><i class="fa fa-times"></i></button>
    </div>
  <?php include(dirname(__FILE__).'/import/test-import.php');?>
  </div>
</div>
<?php endif; ?>


<style media="screen">
  .menu, .breadcrumb,.header{
    display: none!important;
  }
</style>
<?php
  // NOTE: below is the query for ajax form submition...
  // NOTE: this form is to update the existed posts..
 ?>

<script type="text/javascript">
$(function(){
  /*-----------------------------------------------------\
      copy html from editable div to textaraea
      class: st-post-plane-text to class: html-text
  ------------------------------------------------------*/
    //summary
  $('.edit-summary').click(function(){
    $('.post-summary-editor').attr('contenteditable',true);
    $('.post-summary-editor').html($('.post-summary-textarea').val());
    $('.post-summary-editor').css({'background':'#fff','border':'1px solid','resize':'both'});
  })
  $('.html-text').on('change',function(){
    var elm = $(this).data('target');
      $(elm).empty().append($(this).val());
  });
  /*-----------------------------------------------------\
      form submition query..
  ------------------------------------------------------*/
  //for publish
  $("#draft").click(function(){
    $('#post-status').val(0);
      $('#post-edit-form').submit();
  });
  $("#publish").click(function(){
    $('#post-status').val(1); //submitted..to admin editor...
    $('#post-edit-form').submit();
  });
  $('#post-edit-form').on('submit',function(e){
    e.preventDefault();
    var logId = $('#log-id').val();
      $.ajax({
        url:"tests/update_test",
        method :"POST",
        data : $("#post-edit-form").serialize(),
        beforeSend(){
          // $('#publish').html('<i class="fas fa-spinner"></i>publishing.....');
          $('#publish').attr('disabled','disabled');
          $('#draft').attr('disabled','disabled');
        },
        success : function(data){
          $('#draft').attr('disabled',false);
          $('#publish').attr('disabled',false);
          $('#success-msg').html(data);
        }
      });
    })

$(document).on('click','button',function(e){
  e.preventDefault();
})
});//end query....

</script>
<style media="screen">
  .post-edit-form{
    width: 100%!important;
  }

</style>
