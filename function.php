<?php
const MSG01 = 'ginn'; 
const MSG02 = '不正なメールアドレス';
const MSG03 = '6文字以上で入力してください';
const MSG04 = '10文字以内で入力してくざさい';
function validRequired($str,$key) {
 global $err_msg;
  if ($str ==='') {
    $err_msg[$key]= MSG01;
  }
}
function validEmail($str,$key){
  global $err_msg;
if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
  $err_msg[$key]= MSG02;
  }
}
function validMinLen($str,$key,$min=6){
global $err_msg;
if (mb_strlen($str) < $min){
  $err_msg[$key]= MSG03;  
}
}
function validMaxLen($str,$key,$max=10){
  global $err_msg;
  if (mb_strlen($str) >= $max){
    $err_msg[$key]= MSG04;  
  }
  }
  function dbConnect () {
    $dsn = 'mysql:dbname=ginn;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $options = array();
    $dbh = new PDO($dsn,$user,$password,$options);
    return $dbh;
  }
  function querypost($dbh, $sql, $date) {
    global $err_msg;
    $stmt = $dbh->prepare(sql);
    if($stmt->execute($date)){
      return$stmt;
    } else{
      $err_msg['common'] =$ERR;
      return 0;

    }
  }