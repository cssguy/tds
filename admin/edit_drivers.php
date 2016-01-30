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
			if(driver_save_edit ())
			{
				echo "<div class=\"alert-success\">
					<p>Запись водителя с id=",$_POST['id']," успешно изменена</p>
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
		$result=driver_list_read($_GET['id']);
			if($query_data=mysqli_fetch_array($result))
			{	
				echo"<h1>Редактирование записи водителя с id-".$_GET['id']."</h1>";
			}
			else{echo"запись отсутсвует";}
?>
<form accept-charset="UTF-8" action="" class="dp_form" id="new_transport" method="post" novalidate="novalidate"><div style="display:none">
<input name="utf8" type="hidden" value="?">
<input name="id" type="hidden" value="<?php echo $_GET['id']?>"></div>
	
    <div><label for="driver_name">Имя водителя</label><input id="driver_name" name="name"  type="text" value="<?php echo $query_data['name'];?>"></div>
	
    <div><label for="driver_phone">Номер телефона</label><input id="driver_phone" name="phone" type="text"  value="<?php echo $query_data['phone'];?>"></div>
		
		<div><label for="driver_location">Место расположения водителя</label><input id="driver_location" name="location" type="text"  value="<?php echo $query_data['location'];?>"></div>
		
		<div><label for="driver_details">Дополнительная информация</label><input id="driver_details" name="details" type="text"  value="<?php echo $query_data['details'];?>"></div>

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