<?php
	session_start();
		define ('dir', __DIR__);
		include_once dir."/functions_admin.php";
		if(isset($_POST['submit']))
		{
		if(isset($_POST['login'])&&isset($_POST['pass']))
		{
			if($link_id=db_connect ())
			{	$email=mysqli_escape_string($link_id, $_POST['login']);
				$encrypted_password=md5(mysqli_escape_string($link_id, $_POST['pass']));
				$result=mysqli_query($link_id, "SELECT `email`, `admin_id`, `encrypted_password` FROM admin_users");
			if($result)
				{	while($query_data=mysqli_fetch_array($result))
					{
					if(($query_data['encrypted_password'])==$encrypted_password && ($query_data['email'])==$email)
						{
							$_SESSION['admin']=$query_data['admin_id'];
						}
					else	
						{
							$message="Неверный логин или пароль";
						}
					}
				}
			else{
				$message="Пользователь не найден";
			}
			}
			else
			{
				$message="Невозможно подключиться к базе данных.";
			}
		}
		else{
			$message="Введите логин и пароль";
		}
		}
		else
		{
			$message="";
		}
	if(isset($_SESSION['admin']))
		{
			echo '<script type="text/javascript">window.location = "index.php"</script>';
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Диспетчер - панель администратора</title>
    <link rel="stylesheet" href="css/admin.css">
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" >
  </head>

  <body>
    <div class="main-wrap">
		<div class="message"><?php echo $message; ?></div>
        <form accept-charset="UTF-8" action="" method="post" class="login-main">
            <input name="login" type="text" placeholder="логин" class="box1 border1">
            <input name="pass" type="password" placeholder="пароль" class="box1 border2">
            <input name="submit" type="submit" class="send" value="Войти">
        </form>
    </div>
  </body>
</html>