<?php
/*
  user helper
  function is_admin()
  function is_editor()
  function is_logged_in()
function is_test_author()
*/
if (!function_exists('is_admin')) {
  function is_admin(){
  	if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
  	return true;
  	}
  	else{
  		return false;
  	}
  }
}
if (!function_exists('is_editor')) {
  function is_editor(){
  	if (isset($_SESSION['role']) && $_SESSION['role']=='editor') {
  	return true;
  	}
  	else{
  		return false;
  	}
  }
}
if (!function_exists('is_moderator')) {
  function is_moderator(){
  	if (isset($_SESSION['role']) && $_SESSION['role']=='moderator') {
  	return true;
  	}
  	else{
  		return false;
  	}
  }
}
if (!function_exists('is_logged_in')) {
  function is_logged_in(){
  	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true) {
  	return true;
  	}
  	else{
  		return false;
  	}
  }
}
if (!function_exists('is_test_author')) {
  function is_test_author($id){
  	if (isset($_SESSION['uid']) && $_SESSION['uid']===$id) {
  	return true;
  	}
  	else{
  		return false;
  	}
  }
}
if (!function_exists('is_visitor')) {
  function is_visitor($id){
  	if (!isset($_SESSION['uid'])) {
  	return true;
  	}
  	else{
  		return false;
  	}
  }
}
