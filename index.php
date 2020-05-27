<?php
require('function.php');


if ($_POST) {
  echo $_POST['email'];
  $email= $_POST['email'];
  $pass= $_POST['password'];
  $pass_re= $_POST['password-re'];

  validRequired($email, 'email');
  validEmail($email, 'email');
  validMinLen($pass, 'pass');
  validMaxLen($pass, 'pass');

  if(empty($err_msg)){
    try{
      $dbh=dbConnect();
      $sql='INSERT INTO users(email,password,created_at) VALUES(:email,:password,:created_at)';
      $data=array(':email' => $email, ':password'=> $pass, 'created_at' => date("Y-m-d H:i:s"));
      $stmt=queryPost($dbh,$sql,$data);
      if($stmt){
        echo 'success';
      }
    }catch(Exception $e){
      echo '失敗' .$e->getMessage();
    }
  }
  

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>user</h1>
<form action="" method="post">
mail 
<label for="" class= "<?php if(!empty($err_msg['email'])) echo 'err';?>">
<input type="text" name="email">
</label>
<div class="<?php if(!empty($err_msg)) echo 'err'; ?>">
<?php
if(!empty($err_msg['email'])) {
  echo $err_msg['email'];
}
?>
</div> 
パスワード 
<label for="" class= "<?php if(!empty($err_msg['pass'])) echo 'err';?>">
</label>
<div class="<?php if(!empty($err_msg)) echo 'err'; ?>">
<?php
if(!empty($err_msg['pass'])) {
  echo $err_msg['pass'];
}
?>
</div> 

<input type="text" name="password">
パスワード再入力
<label for="" class= "<?php if(!empty($err_msg['pass_re'])) echo 'err';?>">
</label>
<div class="<?php if(!empty($err_msg)) echo 'err'; ?>">
<?php
if(!empty($err_msg['pass_re'])) {
  echo $err_msg['pass_re'];
}
?>
</div> 

<input type="text" name="password-re">
<input type="submit" value="登録する">
</form>
</body>
</html>