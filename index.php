<?php
include'head.php';
?>

<style>
body{
 background-image: url("fotos/5.jpg");
background-repeat:no-repeat;
background-size: 100%;
}
</style>

<script>
	function clean(textarea){
	 textarea.value="";
	}



</script>

<?php

if(isset($_POST["button_submit"])) {

	$sql = "INSERT INTO mensagens (mensagem, aprovacao)
    VALUES('" .$_POST['mensagem']. "','0');";


    if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
      header("Location: mensagemtrump.php?id=" . $last_id . "");
    } else {
      echo 'Tenta outra vez';
    } 

};

$username = '';
$pass = ''; 
$error = false;
$usernameError = '';
$passError = '';

 if( isset($_POST['btn-login']) ) { 

  // prevent sql injections/ clear user invalid inputs
  $username = trim($_POST['username']);
  $username = strip_tags($username);
  $username = htmlspecialchars($username);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
    
  if (!$error) {
   
   $password = hash('sha256', $pass); // password hashing using SHA256
  
   $res=mysqli_query($conn,"SELECT * FROM administradores WHERE username='$username'");
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res); 
   
   if( $count == 1 && $row['password']==$password ) {
    $_SESSION['idAdmin'] = $row['idAdmin'];
    header("Location: mensagens.php");
   } else {
    $errMSG = "Username ou password incorrectas, tente outra vez.";
    echo $errMSG;
   }
    
  }
  
 }

?>
<body>



	<div id="homepage">


	<div id="menu_login">
		<button class="botao_login" onclick="document.getElementById('popup').style.display='block'"></button>
	</div>
	
	<div id="down_side">
		<div id="div_title">
		<h1>Qual a mensagem que queres que Trump transmita ao mundo?</h1>
		</div>

		<div id="div_form">
		<form method="post" action="index.php" id="homepage_form">
		
		<textarea class='textarea' rows="4" cols="50" name="mensagem" onfocus="clean(this)" maxlength="240" autofocus>
		</textarea>
		<br>
		<input type="submit" name="button_submit" class="botao_submit">
		</form>
		</div>
	</div>



	<div id="login_form">

		<div id="popup" class="popup">
		  
		  <form method="post" class="popup_form animate" action="index.php"?>">

		    <div class="imgcontainer">
		      <span onclick="document.getElementById('popup').style.display='none'" class="close" title="Close Modal">&times;</span>
		      <img src="fotos/img_avatar2.jpg" alt="Avatar" class="avatar">
		    </div>

		    <div id="container">
		       <h2> Acesso reservado a administradores.</h2>

		      <input type="username" placeholder="Enter Username" name="username" required>
		      <input type="password" placeholder="Enter Password" name="pass" required>
		        
		      <button type="submit" id="btn_login" name="btn-login">Login</button>
		   
		    <div class="container" style="background-color:#f1f1f1">
		      <button type="button" onclick="document.getElementById('popup').style.display='none'" class="cancelbtn">Cancel</button>
		    </div>
		     </div>

		  </form>
		</div>

	</div>
	    
    </div>

</body>

<?php 

ob_end_flush(); 
$conn->close();

?>

