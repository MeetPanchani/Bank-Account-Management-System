<?php
  $hostName='localhost';
  $database='meetbank';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  if(!$link)
  {
    echo 'Unable to connect with Database';
  }
 ?>
