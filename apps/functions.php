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
									'company_type');
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
					foreach($transport_array as $array_value)
						{//echo $array_value," --post-> ",$_POST[$array_value];
							//echo '<br>';
							if (!empty($_POST[$array_value]))
								{
									$query_fields.='`'.$array_value.'`, ';
									$temp_data=mysqli_real_escape_string($link_id, $_POST[$array_value]);
									$query_data.="'$temp_data', ";
									//echo $array_value,"  --!empty_post-",$_POST[$array_value];
									//echo '<br>-------------------------<br>';
									//echo '$temp_data='.$temp_data;
									//echo '<br>-------------------------<br>';
								}
						}
					$query_fields.='`created_at`, `updated_at`';
					$query_data.="'".$created."', '".$created."'";
					//echo $query_fields;
					//echo '<br>';
					//echo '<br>';
					//echo $query_data;
					//echo '<br>';
					$querry_result=mysqli_query($link_id, "INSERT INTO `transports` ($query_fields) VALUES ($query_data)");
					//echo mysqli_error($link_id);/**********ERROR************/
					mail($to_mail, "Поступила новая заявка свободного транспорта", "Поступила новая заявка свободного транспорта.", "From:$from_mail");
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
		{	global $from_mail;
			global $to_mail;
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
                                'company_type');
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
					mail($to_mail, "Поступила новая заявка на перевозку груза", "Поступила новая заявка на перевозку груза.", "From:$from_mail");
					return $querry_result;
				}
				else
				{
				//echo mysqli_error($link_id);/**********ERROR************/
					return '0';
				}
		}
?>