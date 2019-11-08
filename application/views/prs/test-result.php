<?php
DATE_DEFAULT_TIMEZONE_SET('Asia/kolkata');
//result generated
$p = new posts;
 ?>
 <script type="text/javascript">
   function printPage(){
     window.print();
   }
 </script>
<div class="container-fluid">
 <div class="right" style="color:var(--header2);border-color:rgba(100,155,50,0.5);">
   <h3 class="pl-2 pr-2 pt-2 border rounded row justify-content-between" style=" background:rgba(100,155,50,0.5);padding-bottom:50px;position:relative;bottom:-50px;margin-top:-50px;">
    <span>  Report Card </span>
    <span>
     <button class="btn btn-light rounded-circle" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?quote=<?=urlencode($og_title);?>&u=<?=base_url();?>tests/play/<?=bin2hex($post['test_id']);?>/<?=$post['test_slug'];?>?anonymus_access=true ')"><i class="fab fa-facebook text-primary"></i> </button>

     <button class="btn btn-light rounded-circle"  onclick="javascript:window.open('https://wa.me?text=<?=urlencode($og_title);?>%20 %0A<?=base_url();?>tests/play/<?=bin2hex($post['test_id']);?>/<?=$post['test_slug'];?>?anonymus_access=true' )"><i class="fab fa-whatsapp text-st-primary"></i> </button>
   </span>
   </h3>
   <?=$result;?>
    <div class="border rounded m-1 p-2">
    <span class="text-st-primary">  Share This Test with your circle </span><br>
      <?php $sharer = sharer_links($post['test_id'],base_url().'tests/play/'.bin2hex($post['test_id']).'/'.$post['test_slug'].'?anonymus_access=true',$post['test_slug']);?>

      <!-- <span class="more-hidden" style="display:none;"> -->
      <?php foreach ($sharer as $row): ?>
          <a href="<?=$row['href'];?>" target="<?=$row['target'];?>">
            <button class="share btn btn-light">
                <i class="<?=$row['class'];?>"></i>
            </button>
            <sup class="inside-link"><span class="counts"><?=$p->share_counts($row['name'],$post['test_id']);?></span></sup>
          </a>
      <?php endforeach; ?>
    </div>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Ad cb -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5230750731230756"
     data-ad-slot="3350608100"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

 </div>
 <div class="left p-3 bg-transparent">
   <div class="row justify-content-between">
     <h3 class=""><span><?=ucwords($post['test_title']);?>  (<?=count($questions);?> Questions) </span>
     </h3>
     <small><a href="sharer/print/<?=$post['test_slug'];?>"><i class="fa fa-print"></i> Print this</a>
     </small>
   </div>


 <?php function match_options($option,$ans){

   if ($option == $ans) {
     return "<i class='fa fa-check text-success'> </i> ". $option;
   }
   else{
     return "<i class='fa fa-times text-danger'> </i> ". $option;
   }
 } ?>

 <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Ad cb -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5230750731230756"
     data-ad-slot="3350608100"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<?php $i = 0; ?>
 <?php foreach ($questions as $row): ?>
   <?php if ($i%5 == 0 ): ?>

     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Ad cb -->
    <ins class="adsbygoogle"
         style="display:inline-block;width:728px;height:90px"
         data-ad-client="ca-pub-5230750731230756"
         data-ad-slot="3350608100"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
     <hr>
   <?php endif; ?>
  <p class="m-0">Q.<?=$row['qno'];?>. <?=$row['que_title'];?></p>
  <ol type="a" class="pl-3 ml-2">

    <li><?=match_options($row['a'],$row[$row['ans']]);?></li>
    <li><?=match_options($row['b'],$row[$row['ans']]);?></li>
    <li><?=match_options($row['c'],$row[$row['ans']]);?></li>
    <li><?=match_options($row['d'],$row[$row['ans']]);?></li>
  </ol>
  <div class="card bg-light border rounded">
      <p>Response provide : <?=$row['response'];?>.
          <?php if ($row['response']!=''): ?>
             <?=$row[$row['response']];?><br>
             <?php else: ?>
               Skipped (null) <br>
          <?php endif; ?>

      <?php if ($row['response']!='' && $row['response'] == $row['ans']): ?>
        <i class="fa fa-check-circle"></i> Correct <br>
        Marks : 1
        <?php else: ?>
          <i class="fa fa-times-circle"></i> Wrong <br>
          Marks : 0
      <?php endif; ?>
  </div>
  <p> Answer:
    <strong>(<?=$row['ans'];?>) <?=$row[$row['ans']];?></strong> <br>
    <?php if ($row['expl']!=''): ?>
      <strong>Explanation: </strong> <?=$row['expl'];?>
    <?php endif; ?>
   </p>
   <hr>
   <?php $i++; ?>
 <?php endforeach; ?>
 </div>
</div>
 <!-- </span> -->
<style media="screen">
  .card p{
    text-align: left;
    justify-content: center;
  }
  .card{
    max-width: 600px;
    margin :auto;
    padding: 20px;
  }
  .content-wrapper{
    padding:0px !important;
    margin: 0px!important;
    background: url('<?=image_dir();?>default/bg-pattern.png');
    min-height: 100vh;
  }
</style>

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Ad cb -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5230750731230756"
     data-ad-slot="3350608100"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
