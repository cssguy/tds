<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include_once dir."../../apps/arrays.php";
	include_once dir."/functions_admin.php";
	include_once dir."/header_admin.php";
?>

<h1>Добавить водителя</h1>
<form accept-charset="UTF-8" action="" class="dp_form" id="new_transport" method="post" novalidate="novalidate"><div style="display:none">
<input name="utf8" type="hidden" value="?"></div>
	
    <div><label for="driver_name">Имя водителя</label><input id="driver_name" name="name"  type="text" value="<?php echo $query_data['name'];?>"></div>
	
    <div><label for="driver_phone">Номер телефона</label><input id="driver_phone" name="phone" type="text"  value="<?php echo $query_data['phone'];?>"></div>
		
		<div><label for="driver_location">Место расположения водителя</label><input id="driver_location" name="location" type="text"  value="<?php echo $query_data['location'];?>"></div>
		
		<div><label for="driver_details">Дополнительная информация</label><input id="driver_details" name="details" type="text"  value="<?php echo $query_data['details'];?>"></div>

  <div class="actions dp_apply">
    <input name="commit" type="submit" value="Добавить водителя">
  </div>
  </form>

</div>

</div>


<?php
		if(isset($_POST['commit']))
		{
			if(driver_new())
			{
				echo "<div class=\"alert-success\">
					<p>Анкета нового водителя принята.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button></div>";
			}
			else
			{
				echo "<div class=\"alert-success\">
					<p>К сожалению, по техническим причинам невозможно сохранить анкету водителя. Попробуйте позже.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button>
				</div>";
			}
			//$error=transport_new();
			//echo $error;
		}
?>
<script type="text/javascript">
  
  $(document).ready(function(){
    $(".alert-success").wrap("<div class='tds_modal'></div>");

    $(".ok").click(function(){
      $(".tds_modal").hide();
      $(".alert-success").hide();
	  $(location).attr('href',"index.php?view=drivers");
    });
  });

</script>

</body>

</html>