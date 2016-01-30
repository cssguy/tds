<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include_once dir."../../apps/arrays.php";
	include_once dir."/functions_admin.php";
	include_once dir."/header_admin.php";
?>

<h1>Добавить транспорт</h1>
<form accept-charset="UTF-8" action="" class="dp_form" id="new_transport" method="post" novalidate="novalidate"><div style="display:none"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="G9EeRC3biQlW6i6h2CiiON0cQDErXi9aN8NbihMQc9k="></div>

    <div><label for="transport_from_date">Транспорт свободен c</label><input id="transport_from_date"  name="transport_from_date"  type="text"></div>
	
    <div><label for="transport_till_date">Транспорт свободен по</label><input id="transport_till_date" name="transport_till_date" type="text"></div>
	
    <div><label for="transport_city"><abbr title="required">*</abbr> Город нахождения</label><input id="transport_city"  name="transport_city" type="text"></div>
	
    <div><label for="transport_to_city">Город назначения</label><input  id="transport_to_city" name="transport_to_city" type="text"></div>
	
    <div><label for="transport_type">Тип транспорта</label><select id="transport_type" name="transport_type">
	<?php
		foreach($transport_type_option as $value)
		{
			echo "<option value=\"$value\">$value</option>";
		}
	?>
</select></div>

    <div><label for="transport_capacity">Грузоподъемность, т</label><input id="transport_capacity" name="capacity" step="any" type="number" min="0"></div>
	
    <div><label for="transport_volume">Объем груза, м³</label><input id="transport_volume" name="volume" step="any" type="number" min="0"></div>
	
    <div><label for="transport_payment_type">Вид платежа</label><select id="transport_payment_type" name="payment_type">
	<?php
		foreach($payment_type_option as $value)
		{
			echo "<option value=\"$value\">$value</option>";
		}
	?>
	</select></div>

    <div><label for="transport_payment_amount">Сумма, грн.</label><input id="transport_payment_amount" name="payment_amount" step="1" type="number" min="0"></div>
	
    <div><label for="transport_phone"><abbr title="required">*</abbr>Телефон</label><input id="transport_phone" name="phone" type="tel"value=""></div>
	
    <div><label for="transport_email">Email</label><input id="transport_email" name="email"></div>
	
    <div><label for="transport_company_name"><abbr title="required">*</abbr>Компания или ФИО</label><input id="transport_company_name" name="company_name" type="text"></div>

    <div><label for="transport_company_type">Специфика деятельности</label><select class="select optional" id="transport_company_type" name="company_type">
	<?php
		foreach($company_type_option as $value)
		{
			echo "<option value=\"$value\">$value</option>";
		}
	?>
	</select></div>
	<div>Статус заявки</div>
	<div><input name="order_status" type="radio" id="0" value="0" checked><label for="0">Ожидает</label></div>
	<div><input name="order_status" type="radio" id="1" value="1"><label for="1">Одобрено</label></div>
  <div class="actions dp_apply">
    <input name="commit" type="submit" value="Добавить заявку">
  </div>
 
</form>

</div>


<?php
		if(isset($_POST['commit']))
		{
			if(transport_new())
			{
				echo "<div class=\"alert-success\">
					<p>Заявка свободного транспорта принята.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button></div>";
			}
			else
			{
				echo "<div class=\"alert-success\">
					<p>К сожалению, по техническим причинам невозможно сохранить заявку. Попробуйте позже.</p>
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
	  $(location).attr('href',"index.php?view=transports");
    });
  });

</script>

</body>

</html>