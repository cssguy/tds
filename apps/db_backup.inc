<?php
/*-подключение к бд-*/
	function db_connect()
		{
			$dbhost='tds.in.ua';// расположение сайта
			$dbusername='live01_datauser'; // имя пользователя бд
			$dbuserpass='16kcxo88';// пароль к бд
			$db_name='live01_tds';// имя самой бд
			@$link_id=mysqli_connect($dbhost, $dbusername, $dbuserpass, $db_name);
			if($link_id)
			{
				mysqli_set_charset($link_id, "utf8");
				return $link_id;
			}
			else
			{
				return 0;
			}
		}
?>