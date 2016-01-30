<?php
		include_once dir."../../apps/arrays.php";
		include_once dir."../../apps/db.inc";
		$page_admin=20;// количество записей на страницу в админке
		$up_down;
		$my_order;
		$view_list;
/**************************/
	function total_rows($table_name){
		global $page_admin;
			if($link_id=db_connect ())
			{
				if($result = mysqli_query($link_id, "SELECT `id` FROM $table_name"))
				{
					$total_pages=mysqli_num_rows($result);
					$total_pages = ceil($total_pages / $page_admin);
					return $total_pages;
				}
			}
	}
/*-сортировка записей-*/
	function get_control (){
			global $my_order;
			global $view_list;
			global $up_down;
			if(isset($_GET['view']))
				{$view_list=$_GET['view'];}
			if(!empty($_GET['order_by']))
			{	
				if(isset($_GET['up_down']))
					{
						$up_down=$_GET['up_down'];
					}
				else
				{
					$up_down='asc';
				}
				$my_order="ORDER BY ".$_GET['order_by']." ".$up_down;
			}
			else {
				$my_order='ORDER BY `id` DESC'; 
			}
	}
/*-список транспорта в админке-*/
	function transport_list_admin($page)
		{	
			global $page_admin;
			global $up_down;
			global $my_order; 
			$page=$page*$page_admin;
			if($link_id=db_connect ())
			{
				$result=mysqli_query($link_id, "SELECT id, transport_from_date,transport_till_date, transport_city, transport_to_city, transport_type, company_name, phone, order_status FROM transports $my_order LIMIT $page, $page_admin");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/*-список груза в админке-*/
	function cargos_list_admin($page)
		{
			global $page_admin;
			global $up_down;
			global $my_order;
			$page=$page*$page_admin;			
			if($link_id=db_connect ())
		{
				$result=mysqli_query($link_id, "SELECT id, ship_from_date,ship_till_date, ship_city, ship_to_city,  description, transport_type, company_name, phone, order_status FROM cargos $my_order LIMIT $page, $page_admin");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/*-список водителей в админке-*/
	function drivers_list_admin($page)
		{
			global $page_admin;
			global $up_down;
			global $my_order;
			$page=$page*$page_admin;			
			if($link_id=db_connect ())
		{
				$result=mysqli_query($link_id, "SELECT * FROM drivers $my_order LIMIT $page, $page_admin");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/*-преобразование даты к виду 1 января 2016-*/
	function month_convert($data="") {
		$month_names=array("января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");
		$data=strtotime($data);
		if ($data)
			{
				return date("d",$data)." ".$month_names[(date("n",$data)-1)]." ".date("Y",$data);
			}
		else 
			{
				return "не указана";
			}
	}
/*-чтение транспорта для редактирования-*/
	function transport_list_read($id)
		{
			if($link_id=db_connect ())
			{
				$result=mysqli_query($link_id, "SELECT * FROM transports WHERE id=$id");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/*-чтение груза для редактирования-*/
	function cargo_list_read($id)
		{
			if($link_id=db_connect ())
			{
				$result=mysqli_query($link_id, "SELECT * FROM cargos WHERE id=$id");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/*-чтение водителей для редактирования-*/
	function driver_list_read($id)
		{
			if($link_id=db_connect ())
			{
				$result=mysqli_query($link_id, "SELECT * FROM `drivers` WHERE id=$id");
				return $result;
			}
			else
			{
				return 0;
			}
		}
/*-сохранение редактирования транспорта-*/
	function transport_save_edit(){
		$transport_add=array();
			$transport_array=array('id',
									'transport_from_date',
									'transport_till_date',
									'transport_city',
									'transport_to_city',
									'transport_type',
									'capacity',
									'volume',
									'payment_type',
									'payment_amount',
									'phone',
									'email',
									'company_name',
									'company_type',
									'order_status');
		if($link_id=db_connect ())
			{
				foreach($transport_array as $array_value)
					{
						$transport_add[$array_value]=mysqli_real_escape_string($link_id,$_POST[$array_value]);
					}
			if(!$transport_add['transport_from_date'])
				{$transport_add['transport_from_date']=date('Y-m-d');}
			else{
					$transport_add['transport_from_date']=date('Y-m-d', strtotime($transport_add['transport_from_date']));
				}
				$transport_add['transport_till_date']=date('Y-m-d', strtotime($transport_add['transport_till_date']));
				$result_querry=mysqli_query($link_id, "UPDATE  `transports` SET 
						`transport_from_date`='$transport_add[transport_from_date]', 
						`transport_till_date`='$transport_add[transport_till_date]', `transport_city`='$transport_add[transport_city]', `transport_to_city`='$transport_add[transport_to_city]',    
						`transport_type`='$transport_add[transport_type]', 
						`capacity`='$transport_add[capacity]', 
						`volume`='$transport_add[volume]', 
						`payment_type`='$transport_add[payment_type]', `payment_amount`='$transport_add[payment_amount]',  
						`phone`='$transport_add[phone]', 
						`email`='$transport_add[email]',
						`company_name`='$transport_add[company_name]',
						`company_type`='$transport_add[company_type]', 
						`order_status`='$transport_add[order_status]' WHERE id='$transport_add[id]'");
				return $result_querry;
				}
	}
/*-сохранение редактирования груза-*/
	function cargo_save_edit(){
		$cargo_add=array();
			$cargo_array=array('id',
									'ship_from_date',
									'ship_till_date',
									'ship_city',
									'ship_to_city',
									'description',
									'transport_type',
									'weight',
									'volume',
									'payment_type',
									'payment_amount',
									'phone',
									'email',
									'company_name',
									'company_type',
									'order_status');
		if($link_id=db_connect ())
			{
				foreach($cargo_array as $array_value)
					{
						$cargo_add[$array_value]=mysqli_real_escape_string($link_id, $_POST[$array_value]);
					}
				if(!$cargo_add['ship_from_date'])
				{$cargo_add['ship_from_date']=date('Y-m-d');}
				else{$cargo_add['ship_from_date']=date('Y-m-d', strtotime($cargo_add['ship_from_date']));}
				$cargo_add['ship_till_date']=date('Y-m-d', strtotime($cargo_add['ship_till_date']));
				
				$result_querry=mysqli_query($link_id, "UPDATE  `cargos` SET 
						`ship_from_date`='$cargo_add[ship_from_date]', `ship_till_date`='$cargo_add[ship_till_date]', `ship_city`='$cargo_add[ship_city]', 
						`ship_to_city`='$cargo_add[ship_to_city]', 
						`description`='$cargo_add[description]',
						`transport_type`='$cargo_add[transport_type]', 
						`weight`='$cargo_add[weight]', 
						`volume`='$cargo_add[volume]', 
						`payment_type`='$cargo_add[payment_type]', `payment_amount`='$cargo_add[payment_amount]',  
						`phone`='$cargo_add[phone]', 
						`email`='$cargo_add[email]',
						`company_name`='$cargo_add[company_name]',
						`company_type`='$cargo_add[company_type]', 
						`order_status`='$cargo_add[order_status]' WHERE id='$cargo_add[id]'");
				return $result_querry;
				}
	}
/*-сохранение редактирования груза-*/
	function driver_save_edit(){
		$query_data='';
		$driver_array=array('id', 
									'name',
									'phone',
									'location',
									'details');
		if($link_id=db_connect ())
			{
				foreach($driver_array as $array_value)
					{
						$query_data.='`'.$array_value.'`=\''.mysqli_real_escape_string($link_id, $_POST[$array_value]).'\', ';
					}
				$query_data=rtrim($query_data,", ");
				$result_querry=mysqli_query($link_id, "UPDATE  `drivers` SET $query_data WHERE id='$_POST[id]'");
				return $result_querry;
			}
	}
/*-удаление из бд-*/	
	function delete_row($id, $table_name)
		{	
			if($link_id=db_connect ())
				{
				$result_querry=mysqli_query($link_id, "DELETE FROM $table_name WHERE id='$id'");
				return $result_querry;
				}
		}
/*****************************/	
	function transport_new()
		{	
			$query_fields='';
			$query_data='';
			$transport_array=array('transport_from_date',
									'transport_till_date',
									'transport_city',
									'transport_to_city',
									'transport_type',
									'capacity',
									'volume',
									'payment_type',
									'payment_amount',
									'phone',
									'email',
									'company_name',
									'company_type',
									'order_status');
			if(empty($_POST['transport_from_date']))
				{$_POST['transport_from_date']=date('Y-m-d');}
			else{$_POST['transport_from_date']=date('Y-m-d', strtotime($_POST['transport_from_date']));}
			if(empty($_POST['transport_till_date']))
				{$_POST['transport_till_date'] = date('Y-m-d', strtotime("+7 days", strtotime($_POST['transport_from_date'])));}
			else{$_POST['transport_till_date']=date('Y-m-d', strtotime($_POST['transport_till_date']));}
			$created=date('Y-m-d H:i:s');
			if($link_id=db_connect ())
				{
					foreach($transport_array as $array_value)
						{	
							if (!empty($_POST[$array_value]))
								{
									$query_fields.='`'.$array_value.'`, ';
									$temp_data=mysqli_real_escape_string($link_id, $_POST[$array_value]);
									$query_data.="'$temp_data', ";
								}
						}
					$query_fields.='`created_at`, `updated_at`';
					$query_data.="'".$created."', '".$created."'";
					$querry_result=mysqli_query($link_id, "INSERT INTO `transports` ($query_fields) VALUES ($query_data)");
					//echo mysqli_error($link_id);/**********ERROR************/
					return $querry_result;
				}
				else
				{
				//echo mysqli_error($link_id);/**********ERROR************/
					return '0';
				}
		}
/******************************/
	function cargo_new()
		{
			$query_fields='';
			$query_data='';
			$cargo_array=array( 'ship_from_date', 
                                'ship_till_date', 
                                'ship_city', 
                                'ship_to_city', 
                                'description', 
                                'transport_type', 
                                'weight', 
                                'volume', 
                                'payment_type', 
                                'payment_amount', 
                                'phone', 
                                'email', 
                                'company_name', 
                                'company_type',
								'order_status');
			if(empty($_POST['ship_from_date']))
				{$_POST['ship_from_date']=date('Y-m-d');}
			else{$_POST['ship_from_date']=date('Y-m-d', strtotime($_POST['ship_from_date']));}
			if(empty($_POST['ship_till_date']))
				{$_POST['ship_till_date'] = date('Y-m-d', strtotime("+7 days", strtotime($_POST['ship_from_date'])));}
			else{$_POST['ship_till_date']=date('Y-m-d', strtotime($_POST['ship_till_date']));}
			$created=date('Y-m-d H:i:s');
			if($link_id=db_connect ())
				{
					foreach($cargo_array as $array_value)
						{
							if (!empty($_POST[$array_value]))
								{
									$query_fields.='`'.$array_value.'`, ';
									$temp_data=mysqli_real_escape_string($link_id, $_POST[$array_value]);
									$query_data.="'$temp_data', ";
								}
						}
					$query_fields.='`created_at`, `updated_at`';
					$query_data.="'$created', '$created'";
					$querry_result=mysqli_query($link_id, "INSERT INTO `cargos` ($query_fields) VALUES ($query_data)");
					return $querry_result;
				}
				else
				{
				//echo mysqli_error($link_id);/**********ERROR************/
					return '0';
				}
		}
/*********************/
	function driver_new()
		{
			$query_fields='';
			$query_data='';
			$driver_array=array('name',
												'phone',
												'location',
												'details');
			if($link_id=db_connect ())
				{
					foreach($driver_array as $array_value)
						{
							if (!empty($_POST[$array_value]))
								{
									$query_fields.='`'.$array_value.'`, ';
									$temp_data=mysqli_real_escape_string($link_id, $_POST[$array_value]);
									$query_data.="'$temp_data', ";
								}
						}
					$query_fields=trim($query_fields,", ");
					$query_data=trim($query_data,", ");
					$querry_result=mysqli_query($link_id, "INSERT INTO `drivers` ($query_fields) VALUES ($query_data)");
					return $querry_result;
				}
				else
				{
				//echo mysqli_error($link_id);/**********ERROR************/
					return '0';
				}
		}
/*********************/
	function delete_items($table_name)
		{
			$del_items=$_POST['item'];
			$del_items=implode(',', $del_items);
			if($link_id=db_connect ())
				{
				$result_querry=mysqli_query($link_id, "DELETE FROM $table_name WHERE `id` IN ($del_items)");
				}
			if($result_querry)
			{
				return $del_items;
			}
			else
			{
				return '0';
			}
		}
	function approved_waiting_items($table_name, $status)
		{
			$app_wai_items=$_POST['item'];
			$app_wai_items=implode(',', $app_wai_items);
			if($link_id=db_connect ())
				{
				$result_querry=mysqli_query($link_id, "UPDATE $table_name SET `order_status`=$status WHERE `id` IN ($app_wai_items)");
				}
			if($result_querry)
			{
				return $app_wai_items;
			}
			else
			{
				return '0';
			}
		}
?>