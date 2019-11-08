<?php if (isset($test) && $test!=''): ?>
<div class="row row4 crousel-wrapper" style="width:100%;">
  <button class="scroll-btn prev btn btn-light">&lt;</button>
  <button class="scroll-btn next btn btn-light">&gt;</button>
  <div class="content-crousel" style="margin:auto;">

  <?php foreach ($test as $row): ?>
    <div class="col-md-3 col-sm-6 col-xs-12 m-1 card cd-2 p-0 pt-0" style="min-width:400px!important;">
      <img src="<?=$row['post_img'];?>" alt="<?=$row['post_title'];?>" height="150" width="100%" align="none" class="m-0 p-0">
      <p class="card-body p-2 mt-6 mb-0" style="background:rgba(255,255,255,0.6);margin-top:-50px;">
        <strong><?=ucwords($row['post_title']);?></strong>     <br>
        <?php $tm = new tests_model; ?>
        <span class="text-info">(<?=$tm->test_questions_count($row['post_id']); ?> Questions , <?=$tm->test_results_count($row['post_id']);?> attempts)</span>
        <br>
        <?=$row['post_summary'];?>
      </p>
     <a href="tests/view/<?=$row['post_slug'];?>" class="btn btn-st-primary">view test</a>
    </div>
  <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
