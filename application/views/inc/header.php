<?php
/*
  * file : header.php ->views/inc/header.php
  * author : Prakash Chandra
  * Updated on : 07th nov,2019
  * module : Online Tests Portal
*/
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <base href="<?=base_url();?>">
    <title><?=@$title;?></title>

    <!--meta part -->
    <meta name="og-title" content="<?=@$title;?>">
    <?php if (isset($ogimage) && $ogimage!=''): ?>
      <meta name="og:image" content="<?=$ogimage;?>">
      <?php else: ?>
    <?php endif; ?>
    <?php if (isset($desc) && $desc!=''): ?>
      <meta name="og:description" content="<?=$desc;?>">
      <meta name="description" content="<?=$desc;?>">
      <?php else: ?>
      <meta name="description" content="attempt online tests, check progress">
    <?php endif; ?>

    <meta name="author" content="Prakash Chandra">

    <!--jQuery Cdn -->
    <script
  			  src="https://code.jquery.com/jquery-3.4.1.js"
  			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  			  crossorigin="anonymous"></script>
    <!--bootstrap -->
    <?=link_tag('themes/bootstrap/css/bootstrap.min.css');?>
    <?=link_tag('themes/bootstrap/css/bootstrap.css');?>
    <script src="themes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!--timer for test time-->
    <script type="text/javascript" src="themes/timer/js/script.js"></script>
    <link rel="stylesheet" href="themes/timer/css/style.css">

    <!--fontawesome -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!--medium editor-->
  <script type='text/javascript' src='themes/editors/plane_text/plane-text.js'></script>
  <script src="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/js/medium-editor.min.js"></script>

   <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
   <!--styles / inernal-->
   <link rel="stylesheet" href="themes/css/style.css">
   <script src="themes/js/model.js" charset="utf-8"></script>
  </head>
  <body>
    <div class="row m-0 main-wrapper">
     <!-- sitename , logo extra below this line..-->
