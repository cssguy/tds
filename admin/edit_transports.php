<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include dir."/functions_admin.php";
	$query_string='';
	foreach($_GET as $param => $value)
		{
			if ($param && $param!="id")
			{
				$query_string .="&$param=$value";	
			}      
		}
	include_once dir."/header_admin.php";
?>

<?php
		if(isset($_POST['aply']))
		{
			if(transport_save_edit ())
			{
				echo "<div class=\"alert-success\">
					<p>Запись транспорта с id=",$_POST['id']," успешно изменена</p>
				<button type=\"button\" class=\"ok\">OK</button></div>";
			}
			else
			{
				echo "<div class=\"alert-success\">
					<p>Не удалось изменить запись с id=",$_POST['id'],". Попробуйте позже.</p>
				<button type=\"button\" class=\"ok\">OK</button>
				</div>";
			}
		}
		$query_data=array();
		$result=transport_list_read($_GET['id']);
			if($query_data=mysqli_fetch_array($result))
			{	
				echo"<h1>Редактирование записи транспорта с id-".$_GET['id']."</h1>";
			}
			else{echo"запись отсутсвует";}
?>
<form accept-charset="UTF-8" action="" class="dp_form" id="new_transport" method="post" novalidate="novalidate"><div style="display:none">
<input name="utf8" type="hidden" value="✓">
<input name="id" type="hidden" value="<?php echo $_GET['id']?>"></div>
	
    <div><label for="transport_from_date">Транспорт свободен c</label><input id="transport_from_date" name="transport_from_date"  type="text" value="<?php if(isset($query_data['transport_from_date'])){echo date("d-m-Y", strtotime($query_data['transport_from_date']));}?>"></div>
	
    <div><label for="transport_till_date">Транспорт свободен по</label><input id="transport_till_date" name="transport_till_date" type="text"  value="<?php if(isset($query_data['transport_till_date'])){echo date("d-m-Y", strtotime($query_data['transport_till_date']));}?>"></div>
	
    <div><label for="transport_city"><abbr title="required">*</abbr> Город нахождения</label><input id="transport_city"  name="transport_city" type="text" value="<?php if(isset($query_data['transport_city'])){echo $query_data['transport_city'];} ?>"></div>
	
    <div><label for="transport_to_city">Город назначения</label><input  id="transport_to_city" name="transport_to_city" type="text" value="<?php echo $query_data['transport_to_city']; ?>"></div>
	
    <div><label for="transport_type">Тип транспорта</label><select id="transport_type" name="transport_type" >
	<?php
		foreach($transport_type_option as $value)
		{
			echo "<option value=$value ";
			if($value==$query_data['transport_type'])
			{
				echo " selected ";
			}
			echo ">$value</option>";
		}
	?>
</select></div>

    <div><label for="transport_capacity">Грузоподъемность, т</label><input id="transport_capacity" name="capacity" step="any" type="number" min="0" value="<?php echo $query_data['capacity']; ?>"></div>
	
    <div><label for="transport_volume">Объем груза, м³</label><input id="transport_volume" name="volume" step="any" type="number" min="0" value="<?php echo $query_data['volume']; ?>"></div>
	
    <div><label for="transport_payment_type">Вид платежа</label><select id="transport_payment_type" name="payment_type">
	<?php
		foreach($payment_type_option as $value)
		{
			echo "<option value=$value";
			if($value==$query_data['payment_type'])
			{
				echo " selected ";
			}
			echo ">$value</option>";
		}
	?></select></div>

    <div><label for="transport_payment_amount">Сумма, грн.</label><input id="transport_payment_amount" name="payment_amount" step="1" type="number" min="0" value="<?php echo $query_data['payment_amount']; ?>"></div>
	
    <div><label for="transport_phone"><abbr title="required">*</abbr>Телефон</label><input id="transport_phone" name="phone" type="tel" value="<?php echo $query_data['phone']; ?>"></div>
	
    <div><label for="transport_email">Email</label><input id="transport_email" name="email" value="<?php echo $query_data['email']; ?>"></div>
	
    <div><label for="transport_company_name"><abbr title="required">*</abbr>Компания или ФИО</label><input id="transport_company_name" name="company_name" type="text" value="<?php echo $query_data['company_name']; ?>"></div>

    <div><label for="transport_company_type">Специфика деятельности</label><select class="select optional" id="transport_company_type" name="company_type">
	<?php
		foreach($company_type_option as $value)
		{
			echo "<option value=$value";
			if($value==$query_data['company_type'])
			{
				echo " selected ";
			}
			echo ">$value</option>";
		}
	?></select></div>
	
	<div>Статус заявки</div>
	<div><input name="order_status" type="radio" id="0" value="0" <?php if($query_data['order_status']==0){echo " checked";}?>><label for="0">Ожидает</label></div>
	<div><input name="order_status" type="radio" id="1" value="1" <?php if($query_data['order_status']==1){echo " checked";}?>><label for="1">Одобрено</label></div>

  <div class="actions dp_apply">
    <input name="aply" type="submit" value="Сохранить изменения">
  </div>
  </form>
  <button class="return">Вернуться</button>

</div>
<script type="text/javascript">
  
  $(document).ready(function(){
    $(".alert-success").wrap("<div class='tds_modal'></div>");
    $(".ok").click(function(){
      $(".tds_modal").hide();
      $(".alert-success").hide();
	  $(location).attr('href',"index.php?<?php echo $query_string ?>");
    });
	    $(".return").click(function(){
	  $(location).attr('href',"index.php?<?php echo $query_string ?>");
    });
	
  });

</script>
</body>

</html>