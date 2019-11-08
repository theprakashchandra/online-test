<?php if (isset($que)): ?>
  <div class="p-3 container">
    <form class="quiz-form" action="tests/update_question" method="post">
        <input type="text" name="que_id" value="<?=$que['que_id'];?>" hidden>
        <p class="row m-0 justify-content-between">
          <label> Question no : <input class="input-inline input-border-bottom p-2" type="number" name="qno" value="<?=$que['qno'];?>"> </label>
            <input type="submit" value="update quiz" class="btn btn-primary">
        </p>
      <label> Question : </label>
      <input  class="input input-border-bottom" type="text" name="que_title" value="<?=$que['que_title'];?>">
      <label> Question Description : </label>
      <textarea name="que_desc" class="plane-text1 input-border-bottom" placeholder="suggestions for this question, if any..."><?=$que['que_desc'];?></textarea>
      <script type="text/javascript">
        $('.plane-text1').planeTextEditer({
          wrapperCss : {
            minHeight  : '50px'
          }
        })
      </script>
      <table width="100%">
       <tr>
         <td>option 1 :</td>
         <td><input class="input input-border-bottom quiz-option" type="text" name="a" value="<?=$que['a'];?>"> </td>
       </tr>
       <tr>
         <td>option 2 :</td>
         <td><input class="input input-border-bottom quiz-option" type="text" name="b" value="<?=$que['b'];?>"> </td>
       </tr>
       <tr>
         <td>option 3 :</td>
         <td><input class="input input-border-bottom quiz-option" type="text" name="c" value="<?=$que['c'];?>"> </td>
       </tr>
       <tr>
         <td>option 4 :</td>
         <td><input class="input input-border-bottom quiz-option" type="text" name="d" value="<?=$que['d'];?>"> </td>
       </tr>
       <tr>
         <td>correct option :</td>
         <td>
           <select class="input input-border-bottom" name="ans">
             <option value="<?=$que['ans'];?>" selected><?=$que[$que['ans']];?></option>
             <optgroup label="changed options" class="true-option">

             </optgroup>
           </select>
       </tr>
       <tr>
         <td>explanation :</td>
         <td>
            <textarea name="expl" class="plane-text2 input input-border-bottom p-2" placeholder="explain your answer if any"><?=$que['expl']; ?></textarea>
            <script type="text/javascript">
              $('.plane-text2').planeTextEditer({
                wrapperCss : {
                  minHeight  : '50px'
                }
              })
            </script>
         </td>
       </tr>
      </table>
      <input type="submit" value="update Question" class="btn btn-primary float-right input">
    </form>
  </div>
<?php endif; ?>
<script type="text/javascript">
$('.quiz-option').on('change',function(){
  var options = '';
 for (var i = 0; i < $('.quiz-option').length; i++) {

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
         options += '<option value='+oVal+'>'+$('.quiz-option').eq(i).val()+'</option>';
       }
        $('.true-option').html(options);
})
</script>
