<?php
defined('BASEPATH') OR exit('No direct script access allowed');
DATE_DEFAULT_TIMEZONE_SET('Asia/kolkata');
$time =date('Y-m-d h:i:s');
 ?>
<div class="container text-center bg-white center p-3">
    <div class="login-form text-center center form" id="login-form">

        <p class="form-header p-2 text-secondary">
          <a class="float-left" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"> </i></a>
          <span class="text-dark sns">Login for Online Test</span></p>
        <hr>
    	<form id="loginform" action="login/process" method="POST" name="loginform" class="text-center">

        <?php if (isset($_SESSION['err_msg'])): ?>
            <div class="text-danger border rounded bg-warning"><?=@$_SESSION['err_msg'];?></div>
        <?php endif; ?>

        <?php if (isset($_SERVER['HTTP_REFERER'])) :?>
           <input type="url" name="refrer" value="<?=$_SERVER['HTTP_REFERER'];?>" hidden/>
        <?php endif; ?>
        <label for="userName"><big><i class="fa fa-user-circle rounded-circle"></i> </big></label>
    		<input id="userName" class="input input-inline input-border-bottom m-2" name="user_name" size="20" type="text" placeholder='username' value="anonymus" /> <br>
        <label for="userPass"><big><i class="fa fa-lock rounded-circle"></i></big></label>
    		<input id="userPass" class="input input-inline input-border-bottom  m-2" name="pass" size="20" type="password" placeholder="password" value="12345678"/>

    		<input id="loginBtn" class="input-full rounded border-0 btn btn-primary"  name="login" type="submit" value="Log In" />
      </form>
      <br>
      <p class="text-center">
         <a href="login?form=reg-form" data-target="#reg-form" class="form-toggle">Create Account</a>
       </p>
  </div>

  <div id="reg-form" class="form text-center">
    <form class="reg-form" action="login/process" method="POST" name="regform" class="">
      <h3>Create a Simple Account</h3>
      <?php if (isset($_SESSION['err_msg'])): ?>
          <div class="text-danger border rounded bg-warning"><?=@$_SESSION['err_msg'];?></div>
      <?php endif; ?>

       <input type="text" name="name" class="input input-inline input-border-bottom m-2" placeholder="Your Name" id="nameInput"> <br>
         <input type="text" name="user_name" class="input-inline input-border-bottom m-2" placeholder="User Name" id="unameInput"> <small class="text-warning">*remember this Username for future logins</small>
       <input type="password" name="pass" class="input input-inline input-border-bottom m-2" placeholder="Password">
       <input class="btn btn-primary input" type="submit" name="register" value="Sign Up">
    </form><br>
           <p class="text-center">
              <a href="login?form=login-form" data-target="#login-form" class="form-toggle">Sign In</a>
            </p>
  </div>
</div> <!--forms wrapper-->
<style media="screen">
#reg-form{
  display: none;
}
</style>


<script type="text/javascript">
  $(function(){
    var url = new URL(window.location.href);
    var formID = url.searchParams.get('form');
    if (formID != undefined ) {
      $('#'+formID).show();
        $('.form').not('#'+formID).hide();
    }
    $(document).on('click','.form-toggle',function(){
      var target = $(this).data('target');
      $(target).show();
      $('.form').not(target).hide();
    })
    $('#nameInput').on('change',function(){
      $('#unameInput').val($(this).val().split(' ').join('_'));
    })
    $('#unameInput').on('change',function(){
      $('#unameInput').val($(this).val().split(' ').join('_'));
    })
  })
</script>
