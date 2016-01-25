<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include_once dir."/apps/arrays.php";
	include_once dir."/apps/db.inc";
	include_once  dir."/apps/functions.php";
	include_once (dir."/header.php");
?>

<p class="tds_back"><a href="<?php echo "$home_url";?>">вернуться назад</a></p>

    <h1>Добавить груз</h1>

    <form accept-charset="UTF-8" action="" class="dp_form" id="new_cargo" method="post" novalidate="novalidate"><div style="display:none"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="G9EeRC3biQlW6i6h2CiiON0cQDErXi9aN8NbihMQc9k="></div>

      <div><label  for="cargo_ship_from_date">Дата отправки груза c</label><input id="ship_from_date" name="ship_from_date" type="text"></div>
  	
      <div><label  for="cargo_ship_till_date">Дата отправки груза по</label><input id="ship_till_date" name="ship_till_date" type="text"></div>
  	
      <div><label for="cargo_ship_city"><abbr title="required">*</abbr> Город отправления</label><input id="cargo_ship_city" name="ship_city" type="text"></div>
  	
      <div><label for="cargo_ship_to_city">Город назначения</label><input  id="cargo_ship_to_city" name="ship_to_city" type="text"></div>
  	
      <div><label for="cargo_description">Описание груза</label><textarea id="cargo_description" name="description"></textarea></div>
  	
      <div><label for="cargo_transport_type">Какой нужен транспорт</label>

        <select class="select" id="cargo_transport_type" name="transport_type">
    	
        	<?php
        		foreach($transport_type_option as $value)
        		{
        			echo "<option value=$value>$value</option>";
        		}
        	?>
          
        </select>
      </div>


      <div><label for="cargo_weight">Сколько весит груз, т</label><input id="cargo_weight" name="weight" step="any" type="number" min="0"></div>
  	
      <div><label for="cargo_volume">Объем груза, м³ (если знаете)</label><input id="cargo_volume" name="volume"  step="any" type="number" min="0"></div>
  	
      <div><label for="cargo_payment_type">Вид платежа</label><select id="cargo_payment_type" name="payment_type">
  	<?php
  		foreach($payment_type_option as $value)
  		{
  			echo "<option value=$value>$value</option>";
  		}
  	?>
  	</select></div>

      <div><label for="cargo_payment_amount">Сумма, грн.</label><input id="cargo_payment_amount" name="payment_amount" step="any" type="number" min="0"></div>
  	
      <div><label for="cargo_phone"><abbr title="required">*</abbr> Телефон</label><input id="cargo_phone" name="phone" type="tel"></div>
  	
      <div><label for="cargo_email">Email</label><input id="cargo_email" name="email" ></div>
  	
      <div><label  for="cargo_company_name"><abbr title="required">*</abbr> Компания или ФИО</label><input  id="cargo_company_name" name="company_name" type="text"></div>
  	
      <div><label for="cargo_company_type">Специфика деятельности</label><select id="cargo_company_type" name="company_type">
  	<?php
  		foreach($company_type_option as $value)
  		{
  			echo "<option value=$value>$value</option>";
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
			if(cargo_new())
			{
				echo "<div class=\"alert-success\">
					<p>Ваша заявка на перевозку груза принята и будет опубликована на сайте после проверки администратором.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button></div>";
			}
			else
			{
				echo "<div class=\"alert-success\">
					<p>К сожалению, по техническим причинам мы не можем принять Вашу заявку. Попробуйте позже.</p>
				<button type=\"button\" class=\"ok\" data-dismiss=\"alert\" aria-hidden=\"true\">OK</button>
				</div>";
			}
		}
?>
<?php
	include_once (dir."/footer.php");
?>