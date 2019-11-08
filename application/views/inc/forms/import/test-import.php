
<p class="p-3"> Import Questions From Csv file</p>
    <form class="import-form" action="tests/import/csv" method="post" enctype="multipart/form-data">
      <input type="file" name="csv_file" id="csvImport">
      <input id="postId" name="test_id" value="<?=$test_id;?>" hidden>
      <input type="submit" name="" value="import" id="importBtn">
    </form>

    <p id="msgImport"></p>
    <div class="table-responsive">
     <table class="table table-striped table-bordered" id="data-table">
      <thead>
       <tr>
        <th>Qno</th>
        <th>Q title</th>
        <th>DESC</th>
        <th>O 1</th>
        <th>O 2</th>
        <th>O 3</th>
        <th>O 4</th>
        <th>Ans</th>
        <th>Expl</th>
      </thead>
     </table>
    </div>
<script type="text/javascript">
  $(function(){
    //csv import
    // $(document).on('change','input[type=file]',function(){
    //   $(this).parent().submit();
    // });
      $(document).on('submit','.import-form',function(e){
        e.preventDefault();

          $.ajax({
            url : "tests/import/csv",
            data : new FormData(this),
            method : "POST",
            dataType:'json',
            contentType:false,
            cache:false,
            processData:false,
            beforeSend : function(){
              $('#importBtn').attr('disabled','disabled');
              $('#importBtn').css('cursor','not-allowed');
              $('#msgImport').html('<i class="fa fa-spin fa-spinner"></i> importing.....');
            },
            success : function(jsonData){
            if (jsonData.type =='err') {
              $('#msgImport').html(jsonData.msg);
            }
            else{
              $('#msgImport').html('<i class="text-success fa fa-check-circle"> imported</i>');
              $('#csv_file').val('');
                $('#data-table').DataTable({
                 data  :  jsonData,
                 columns :  [
                  { data : "qno" },
                  { data : "que_title" },
                  { data : "que_desc" },
                  { data : "a" },
                  { data : "b" },
                  { data : "c" },
                  { data : "d" },
                  { data : "ans" },
                  { data : "expl" }
                 ]
                });
            }
            }
          })
      });
  })
</script>
