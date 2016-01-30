<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include_once dir."/apps/arrays.php";
	include_once dir."/apps/db.inc";
	include dir."/apps/functions.php";
	include_once (dir."/header.php");
?>

<p class="tds_back"><a href="<?php echo "$home_url";?>">вернуться назад</a></p>

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

      <div class="actions dp_apply">
        <input name="commit" type="submit" value="Отправить заявку">
      </div>
    </form>
<?php
		if(isset($_POST['commit']))
		{
			if(transport_new())
			{
				echo "<div class=\"alert-success\">
					<p>Ваша заявка свободного транспрорта принята и будет опубликована на сайте после проверки администратором.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button></div>";
			}
			else
			{
				echo '<div class="alert-success">
					<p>К сожалению, по техническим причинам мы не можем принять Вашу заявку. Попробуйте позже.</p>
				<button type="button" class="ok" data-dismiss="alert" aria-hidden="true">OK</button>
				</div>';
			}
		}
?>

<?php
	include_once (dir."/footer.php");
?>