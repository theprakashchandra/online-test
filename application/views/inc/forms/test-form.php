<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form class="post-form container" action="tests/insert_test" method="post" enctype="multipart/form-data">
<article class="left">
  <?php
  DATE_DEFAULT_TIMEZONE_SET('Asia/kolkata');
 $date = date('Y-m-d H:i:s');
  ?>

  <div class="p-2 m-2 rounded border">
    <div class="row justify-content-between m-0 border-bottom p-2">
      <a href="javascript:history.go(-1);"><i class="fa fa-arrow-left"> back</i></a>  <span>Create New Test</span>
    </div>

      <input type="text" name="test_author" value="<?=$_SESSION['uid'];?>" hidden>
      <input type="text" name="test_time" value="<?=$date;?>" hidden >
      <table width="100%">
        <tr>
          <td colspan="2"><label> <i class="fa fa-pen"></i> Test title </label>
          <input style="width:100%;" class="input-title input input-border-bottom" type="text" name="test_title" value="<?=set_value('test_title');?>" placeholder="title of Test">
            <label class="text-danger" ><?= form_error('test_title');?></label>

          </td>
        </tr>
        <tr>
          <td colspan="2" class="pb-2 mb-2"><label> <i class="fa fa-globe"> </i> Test slug : </label>

          <?php if (isset($slug) && $slug!=''): ?>
              <?php $slug = $slug;?>
            <?php else: ?>
              <?php $slug = set_value('test_slug');?>
          <?php endif; ?>

          <span class="bg-light p-3 rounded"><?=base_url();?><input class="input-inline input-slug p-2" type="text" name="test_slug" value="<?=$slug;?>" placeholder="test-slug"></span>


            <label class="text-danger"> <?= form_error('test_slug');?></label>
          </td>
        </tr>

        <tr>
          <td colspan="2"><label><i class="fa fa-edit"></i> Test summary </label>
            <textarea class="input input-border-bottom plane-text" name="test_summary" placeholder="write a short summary you can edit it later.."><?=set_value('test_title');?></textarea>
            <script type="text/javascript">
            // $('.plane-text').planeTextEditer();
            </script>
          </td>
        </tr>
      </table><br>
  </div>
</article>
<aside class="right">

    <h1><button class="btn btn-primary next-btn" type="submit" name="inser_post" value="next"> next &nbsp;&nbsp; <i class="fa fa-arrow-right"></i> </button></h1>

</aside>
  </form>

<?php // NOTE: after submition this page redirect to edit post page ?>


<script type="text/javascript">
$(function(){
    $('.input-title').on('change',function(){
      $(this).val($(this).val().toUpperCase());
    $('.input-slug').val($(this).val().replace(/ /g,'-').toLowerCase());
    });
});

</script>

<style media="screen">
  .left{
    width: 70%;
    float: left;
  }
  .post-form{
    width: 100%;
  }
  @media screen and (max-width : 600px){
    .left{
      width: 100%;
    }
  }
</style>
