<?php
/*
 * test-que.php ,
 * Updated : 08th nov,2019 By:Prakash Chandra
 * this file have listing of all test questions and visible one by one
 * important file for tests attempt
 */
 ?>

<div class="row row1 crousel-wrapper" style="width:100%;background:transparent!important;">

  <div class="content-crousel rounded" style="background:inherit!important;">
    <?php if (isset($mcq) && $mcq!=''): ?>
        <?php $i = 0;?>
        <?php $mcq_count = count($mcq);?>
    <?php foreach ($mcq as $mcq) : ?>
       <div class="col-12 content-slide slide<?=$i;?>" id="slide<?=$mcq['que_id'];?>" style="background:inherit!important;">

         <div class="ols-content" style="width:100%;background:inherit!important;">

           <input type="text" name="que_id[]" value="<?=$mcq['que_id'];?>" hidden>
            <input type="text" name="true_option[]" value="<?=$mcq['ans'];?>" hidden>

           <p>Q.<?=$mcq['qno'];?> of <?=$mcq_count;?>
              <a href="javascript:void(0);" data-target="#quesControl<?=$mcq['que_id'];?>" class="st-dropdown-opener btn rounded-circle float-right"><i class="fa fa-ellipsis-h"></i></a>
            </p>
          <p class="text-normal">
             Q.<?=$mcq['qno'];?>: <?=$mcq['que_title'];?>
          </p>

          <div class="st-dropdown" id="quesControl<?=$mcq['que_id'];?>">
              <div class="st-dropdown-content">
                <ul>
                  <li> <a href="javascript:void(0);" class="report-this" data-qid="<?=$mcq['que_id'];?>"><i class="fa fa-exclamation-circle"> </i> report or feedback</a></li>
                </ul>
              </div>
          </div>
        </div>

              <div class="">
                <style media="screen">
                  ul li ,p{
                    font-size: 20px;
                  }
                  .bg-white{
                    background: #fff!important;
                  }
                  small{
                    font-size: 12px;
                  }
                </style>
                <?php // NOTE: options part ?>
                  <ul>
                    <li class="t-mcq-option btn"> <button class="btn rounded-circle"><input type="radio" name="option<?=$mcq['que_id'];?>" value="a"></button>(A) <?=$mcq['a'];?></li>
                    <li class="t-mcq-option btn"> <button class="btn rounded-circle"><input type="radio" name="option<?=$mcq['que_id'];?>" value="b"> </button>(B)  <?=$mcq['b'];?></li>
                    <?php if ($mcq['c']!=''): ?>
                      <li class="t-mcq-option btn"> <button class="btn rounded-circle"><input type="radio" name="option<?=$mcq['que_id'];?>" value="c"> </button>(C) <?=$mcq['c'];?></li>
                    <?php endif; ?>
                    <?php if ($mcq['d']!=''): ?>
                        <li class="t-mcq-option btn"><button class="btn rounded-circle"> <input type="radio" name="option<?=$mcq['que_id'];?>" value="d"> </button>(D) <?=$mcq['d'];?></li>
                    <?php endif; ?>
                  </ul>
                  <script type="text/javascript">
                    $(function(){
                      var radio = '';
                      $('.t-mcq-option').on('click',function(){
                        radio = $(this).children('button').children('input:radio[name=option<?=$mcq['que_id'];?>]');
                        radio.attr('checked','checked');
                            $('input:radio:checked').parents('button').addClass('btn-primary');
                            $('input:radio:checked').parents('li').siblings('li').children('button').removeClass('btn-primary');
                            $('.checked-required').attr('disabled',false);

                      })
                    })
                  </script>

            </div>
            <?php if ($i < $mcq_count-1): ?>
                <button data-direction="next" data-nav="#qNav<?=$mcq['que_id'];?>" data-target="#slide<?=$mcq['que_id'];?>" href="javascript:void(0);" class="test-quiz-nav quiz-next btn border rounded btn-light text-primary">next &gt;</button>
            <?php endif; ?>
            <?php if ($mcq_count-1 - $i < $mcq_count-1): ?>
              <button data-direction="prev" data-nav="#qNav<?=$mcq['que_id'];?>" data-target="#slide<?=$mcq['que_id'];?>" href="javascript:void(0);" class="test-quiz-nav quiz-prev btn btn-light border rounded btn-light text-primary">&lt; prev</button>
            <?php endif; ?>
               <button class="checked-required btn btn-warning mark-review test-quiz-nav m-1" data-task="review" data-direction="next" data-nav="#qNav<?=$mcq['que_id'];?>" data-target="#slide<?=$mcq['que_id'];?>" disabled> mark for review</button>
                <button class="checked-required btn btn-info test-quiz-nav" data-task="save" data-direction="next" data-nav="#qNav<?=$mcq['que_id'];?>" data-target="#slide<?=$mcq['que_id'];?>" disabled> save and next</button>
        </div>
          <?php $i++;?>

      <?php endforeach; ?>
       <div class="col-12 content-slide" id="slideEndTest">
         This is the end of test
       </div>
    <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
  $(function(){
      Array.prototype.remByVal = function(val) {
      for (var i = 0; i < this.length; i++) {
          if (this[i] === val) {
              this.splice(i, 1);
              i--;
          }
      }
      return this;
      }
    //array
      var attempted = [];
      var review = [];
      var skipped = [];
      var unseen = [];

    $(document).on('click','.test-quiz-nav',function(){
    var target = $(this).data('target');
    var nav =  $(this).data('nav');
    var nav_next = $(nav).next().attr('id');
      var nav_prev = $(nav).prev().attr('id');
    var next_id = $(target).next().attr('id');
    var prev_id = $(target).prev().attr('id');
    if ($(this).data('direction')=='prev') {
          $('#'+prev_id).show();
          $('.content-slide').not('#'+prev_id).hide();
          $('.slide0').not('#'+prev_id).hide();
          $('#'+nav_prev).addClass('btn-info');
          $('.ques-nav').not('#'+nav_prev).removeClass('btn-info');
    }
    else {
      $('#'+next_id).show();
      $('.content-slide').not('#'+next_id).hide();
      $('.slide0').not('#'+next_id).hide();
      $('#'+nav_next).addClass('btn-info');
      $('.ques-nav').not('#'+nav_next).removeClass('btn-info');
      if ($(target+' input:radio').is(':checked')) {
        $(nav).addClass('btn-success');
          $(nav).removeClass('btn-warning');
          $(nav).removeClass('btn-danger');
            $('.checked-required').attr('disabled','disabled');
            attempted.remByVal(target); //remove if exists
            skipped.remByVal(target);
              review.remByVal(target);
              attempted.push(target); //add as attempted
            if ($(this).data('task')=='review') { //review marked
                review.remByVal(target);
                review.push(target);
                $(nav).addClass('btn-warning');
                  $(nav).removeClass('btn-success');
            }
            else if ($(this).data('task')=='save') {
                attempted.remByVal(target); //remove if exists
                attempted.push(target); // add array
                review.remByVal(target);
                $(nav).addClass('btn-success');
                  $(nav).removeClass('btn-warning');
            }
      }
      else {
        $(nav).addClass('btn-danger');
          skipped.remByVal(target);
        skipped.push(target);
      }
    }
      $('.attempted-que').html(attempted.length);
      $('.marked-review-que').html(review.length);
      $('.skipped-que').html(skipped.length);
      var que_count = "<?=$ques_count;?>";
      $('.unseen-que').html((que_count) - (attempted.length + skipped.length));
    })
  })
</script>
