<?php
if (!function_exists('test_time')) {
  function test_time($ques_count){
    $min = intval(ceil($ques_count +  $ques_count / 5));
    // if ($min >= 60) {
    //   $min0 = $min % 60;
    //   $hr = ($min - $min0)/60;
    //   return $hr . ' H :'. $min0 .' min';
    // }

      return $min ;

  }
}

if (!function_exists('roll_no')) {
  function roll_no($uid){
    $rn = '' . $uid;
    while (strlen($rn) < 6) {
      $rn = '0'.$rn;
    }
    return $rn;
  }
}
if (!function_exists('test_status')) {
  function test_status($status){
    switch ($status) {
    	case '1':
    		return '<i class="fa fa-check-circle text-success"> Published</i>';
    		break;
    	case '0':
    		return '<i class="fa fa-circle text-warning"> draft</i>';
    		break;
    		case '2':
    			return '<i class="fa fa-spinner text-secondary"> in review</i>';
    			break;
    	default:
    			return '<i class="fa fa-paper-plane text-st-primary">submitted</i>';
    		break;
    }
  }
}
 ?>
