<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include_once dir."../../apps/arrays.php";
	include_once dir."/functions_admin.php";
	include_once dir."/header_admin.php";
?>

  <h1>Добавить груз</h1>
  <form accept-charset="UTF-8" action="" class="dp_form" id="new_cargo" method="post" novalidate="novalidate"><div style="display:none"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="G9EeRC3biQlW6i6h2CiiON0cQDErXi9aN8NbihMQc9k="></div>

    <div><label  for="cargo_ship_from_date">Дата отправки груза c</label><input id="ship_from_date" name="ship_from_date" type="text"></div>
	
    <div><label  for="cargo_ship_till_date">Дата отправки груза по</label><input id="ship_till_date" name="ship_till_date" type="text"></div>
	
    <div><label for="cargo_ship_city"><abbr title="required">*</abbr> Город отправления</label><input id="cargo_ship_city" name="ship_city" type="text"></div>
	
    <div><label for="cargo_ship_to_city">Город назначения</label><input  id="cargo_ship_to_city" name="ship_to_city" type="text"></div>
	
    <div><label for="cargo_description">Описание груза</label><textarea id="cargo_description" name="description"></textarea></div>
	
    <div><label for="cargo_transport_type">Какой нужен транспорт</label><select class="select" id="cargo_transport_type" name="transport_type">
	
<?php
		foreach($transport_type_option as $value)
		{
			echo "<option value=\"$value\">$value</option>";
		}
	?>
</select></div>


    <div><label for="cargo_weight">Сколько весит груз, т</label><input id="cargo_weight" name="weight" step="any" type="number" min="0"></div>
	
    <div><label for="cargo_volume">Объем груза, м³ (если знаете)</label><input id="cargo_volume" name="volume"  step="any" type="number" min="0"></div>
	
    <div><label for="cargo_payment_type">Вид платежа</label><select id="cargo_payment_type" name="payment_type">
	<?php
		foreach($payment_type_option as $value)
		{
			echo "<option value=\"$value\">$value</option>";
		}
	?>
	</select></div>

    <div><label for="cargo_payment_amount">Сумма, грн.</label><input id="cargo_payment_amount" name="payment_amount" step="any" type="number" min="0"></div>
	
    <div><label for="cargo_phone"><abbr title="required">*</abbr> Телефон</label><input id="cargo_phone" name="phone" type="tel"></div>
	
    <div><label for="cargo_email">Email</label><input id="cargo_email" name="email" type="email"></div>
	
    <div><label  for="cargo_company_name"><abbr title="required">*</abbr> Компания или ФИО</label><input  id="cargo_company_name" name="company_name" type="text"></div>
	
    <div><label for="cargo_company_type">Специфика деятельности</label><select id="cargo_company_type" name="company_type">
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
			if(cargo_new())
			{
				echo "<div class=\"alert-success\">
					<p>Заявка на перевозку груза принята.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button></div>";
			}
			else
			{
				echo "<div class=\"alert-success\">
					<p>К сожалению, по техническим причинам не возможно принять заявку. Попробуйте позже.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button>
				</div>";
			}
		}
?>
<script type="text/javascript">
  
  $(document).ready(function(){
    $(".alert-success").wrap("<div class='tds_modal'></div>");

    $(".ok").click(function(){
      $(".tds_modal").hide();
      $(".alert-success").hide();
	  $(location).attr('href',"index.php?view=cargos");
    });
  });

</script>
</body>

</script>
</html>