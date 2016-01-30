<?php
/******************************/
	function total_rows($table_name){
		global $page_site;
			if($link_id=db_connect ())
			{
				if($result = mysqli_query($link_id, "SELECT `id` FROM $table_name"))
					{
						$total_pages=mysqli_num_rows($result);
						$total_pages = ceil($total_pages / $page_site);
						return $total_pages;
					}
			}
	}
/* отображение транспорта на главной */
	function transport_list()
		{	global $page_site;
			if($link_id=db_connect ())
			{
				$result=mysqli_query($link_id, "SELECT transport_city, transport_to_city, transport_type, capacity, created_at, volume FROM transports WHERE DATE(transport_till_date) >= DATE(NOW()) AND  `order_status`=1 ORDER BY transport_till_date DESC LIMIT $page_site");
				return $result;
			}
			else
			{
				//echo mysqli_error($link_id);/**********ERROR************/
				return 0;
			}
		}
/******************************/
	function cargos_list()
		{
			global $page_site;
			if($link_id=db_connect ())
			{
				$result=mysqli_query($link_id, "SELECT ship_city, ship_to_city, transport_type, description, weight,created_at, volume FROM cargos WHERE DATE(ship_till_date) >= DATE(NOW()) AND `order_status`=1 ORDER BY ship_till_date DESC LIMIT $page_site");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/******************************/
	function transport_new()
		{	global $from_mail;
			global $to_mail;
			global $home_url;
			$query_fields='';
			$query_data='';
			$headers= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "From: $from_mail\r\n";
			$message='<html>
									<head>
										<title>Поступила новая заявка свободного транспорта.</title>
									</head>
									<body><b>Поступила новая заявка свободного транспорта.</b><br><br>';
			$transport_array=array('transport_from_date'=>'транспорт свободен с',
														'transport_till_date'=>'транспорт свободен по',
														'transport_city'=>'город нахождения ',
														'transport_to_city'=>'город назначения ',
														'transport_type'=>'тип транспорта',
														'capacity'=>'грузоподъемность, т',
														'volume'=>'объем груза, м³',
														'payment_type'=>'тип оплаты',
														'payment_amount'=>'сумма оплаты',
														'phone'=>'номер телефона',
														'email'=>'email',
														'company_name'=>'компания или ФИО',
														'company_type'=>'специфика деятельности');
			if(empty($_POST['transport_from_date']))
				{$_POST['transport_from_date']=date('Y-m-d');}
			else{$_POST['transport_from_date']=date('Y-m-d', strtotime($_POST['transport_from_date']));}
			if(empty($_POST['transport_till_date']))
				{	
					$_POST['transport_till_date'] = date('Y-m-d', strtotime("+7 days", strtotime($_POST['transport_from_date'])));
				}
			else{$_POST['transport_till_date']=date('Y-m-d', strtotime($_POST['transport_till_date']));}
			$created=date('Y-m-d H:i:s');
			if($link_id=db_connect ())
				{
					foreach($transport_array as $key=>$array_value)
						{
							if (!empty($_POST[$key]))
								{
									$query_fields.='`'.$key.'`, ';
									$temp_data=mysqli_real_escape_string($link_id, $_POST[$key]);
									$query_data.="'$temp_data', ";
									$message.="<b>$array_value</b> : $temp_data<br>\r\n";
								}
						}
					$query_fields.='`created_at`, `updated_at`';
					$query_data.="'".$created."', '".$created."'";
					$message.="<br><b>Дата создания заявки</b> : $created<br><b><a href=\"$home_url/admin/index.php?view=transports\">Перейти на сайт.</a></b><br></body></html>";
					$querry_result=mysqli_query($link_id, "INSERT INTO `transports` ($query_fields) VALUES ($query_data)");
					//echo mysqli_error($link_id);/**********ERROR************/
					if($querry_result){
						mail($to_mail, "Поступила новая заявка свободного транспорта", $message, $headers);
						return $querry_result;
					}
				}
				else
				{
				//echo mysqli_error($link_id);/**********ERROR************/
					return '0';
				}
		}
/******************************/
	function cargo_new()
		{	global $from_mail;
			global $to_mail;
			global $home_url;
			$query_fields='';
			$query_data='';
			$headers= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "From: $from_mail\r\n";
			$message='<html>
									<head>
										<title>Поступила новая заявка по перевозке груза.</title>
									</head>
									<body><b>Поступила новая заявка по перевозке груза.</b><br><br>';
			$cargo_array=array( 'ship_from_date'=>'загрузка с', 
                          'ship_till_date'=>'загрузка по', 
                          'ship_city'=>'город отправления', 
                          'ship_to_city'=>'город назначения', 
                          'description'=>'описание груза', 
                          'transport_type'=>'какой нужен транспорт', 
                          'weight'=>'вес груза, т', 
                          'volume'=>'объём груза, м³', 
                          'payment_type'=>'вид платежа', 
                          'payment_amount'=>'сумма оплаты', 
                          'phone'=>'номер телефона', 
                          'email'=>'email', 
                          'company_name'=>'имя компании или ФИО', 
                          'company_type'=>'Специфика деятельности');
			if(empty($_POST['ship_from_date']))
				{$_POST['ship_from_date']=date('Y-m-d');}
			else{$_POST['ship_from_date']=date('Y-m-d', strtotime($_POST['ship_from_date']));}
			if(empty($_POST['ship_till_date']))
				{	$_POST['ship_till_date'] = date('Y-m-d', strtotime("+7 days", strtotime($_POST['ship_from_date'])));
				}
			else{$_POST['ship_till_date']=date('Y-m-d', strtotime($_POST['ship_till_date']));}
			$created=date('Y-m-d H:i:s');
			if($link_id=db_connect ())
				{
					foreach($cargo_array as $key=>$array_value)
						{
							if (!empty($_POST[$key]))
								{
									$query_fields.='`'.$key.'`, ';
									$temp_data=mysqli_real_escape_string($link_id, $_POST[$key]);
									$query_data.="'$temp_data', ";
									$message.="<b>$array_value</b> : $temp_data<br>\r\n";
								}
						}
					$query_fields.='`created_at`, `updated_at`';
					$query_data.="'$created', '$created'";
					$message.="<br><b>Дата создания заявки</b> : $created<br><b><a href=\"$home_url/admin/index.php?view=cargos\">Перейти на сайт.</a></b><br></body></html>";
					$querry_result=mysqli_query($link_id, "INSERT INTO `cargos` ($query_fields) VALUES ($query_data)");
					if($querry_result){
						mail($to_mail, "Поступила новая заявка на перевозку груза.", $message, $headers);
						return $querry_result;
					}
				}
				else
				{
				//echo mysqli_error($link_id);/**********ERROR************/
					return '0';
				}
		}
?>