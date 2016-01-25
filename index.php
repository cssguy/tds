<?php
//error_reporting(E_ALL);
	define ('dir', __DIR__);
	include_once dir."/apps/arrays.php";
	include_once dir."/apps/db.inc";
	include_once dir."/apps/functions.php";
	include_once (dir."/header.php");
?>

    <div class="tds_intro">

      <div class="tds_logo">
        <img src="images/tds-logo.png" alt="Транспортно-диспетчерская служба">
      </div>

      <div class="tds_intro_content">

        <p>Данный сервис выполняет организацию грузоперевозок по всей Украине.</p>

        <p>Добавляйте свой груз или транспорт, мы постараемся выполнить Вашу заявку как можно быстрее.</p>

        <p>Добавление заявки абсолютно бесплатное. Комиссия в размере 5% от стоимости доставки взымается только в том случае, если сделка состоялась.</p>

        <p>По вопросам размещения заявок или сотрудничества, обращайтесь по телефону:<br/>
        (050) 574-15-63<br/>
        (067) 613-37-92<br/>
        или отправьте запрос на email: <a href="mailto:support@tds.in.ua">support@tds.in.ua</a></p>
      </div>

    </div>

    <div class="tds_actions">

      <a href="transport_new.php">Добавить транспорт</a>
      <a href="cargo_new.php">Добавить груз</a>

      <div class="clearfix"></div>
      
      <div class="tds_data">
        <h4>Предложения свободного транспорта по Украине</h4>
        <table>
          <thead>
            <tr>
              <th>Дата</th>
              <th>Пункт загрузки — Пункт выгрузки</th>
              <th colspan="2">Тех. данные</th>
            </tr>
          </thead>
          <tbody>	
  	  <?php

  		if($result=transport_list())
  		{
  			if(mysqli_num_rows($result))
  			{	
  				while($query_data=mysqli_fetch_array($result)){
  				echo "<tr><td>";
  				echo "<p>",date("d/m", strtotime($query_data["created_at"])),"</p>";
  				echo "<p>",date("H:i", strtotime($query_data["created_at"])),"</p>";
  				echo "</td><td>";
  				echo "<p>",$query_data["transport_city"]," <span>&mdash;</span> ",$query_data["transport_to_city"],"</p>";
  				echo "<p>",$query_data["transport_type"],"</p>";
  				echo "</td><td><p>",$query_data["capacity"],"т.</p>";
  				echo "<p>&nbsp;</p></td><td><p>";
  				echo $query_data["volume"],"м³";
  				echo "</p><p>&nbsp;</p></td></tr>";
  				}
  			}
  			else
  				{
  					echo "<tr><td colspan=\"3\">Нет свободного транспорта.</td></tr>";
  				}
  		}
  		else
  			{
  				echo "<tr><td colspan=\"3\">Ошибка подключения к базе данных. Попробуйте позже.</td></tr>";
  			}
  		?> 
          </tbody>
        </table>
        <h4>Заявки на грузоперевозки по Украине</h4>
        <table>
          <thead>
              <tr>
                <th>Дата</th>
                <th>Пункт загрузки — Пункт выгрузки</th>
                <th colspan="2">Тех. данные</th>
              </tr>
          </thead>
          <tbody>
  		<?php
  		
  		if ($result=cargos_list())
  		{
  			if(mysqli_num_rows($result))
  			{
  				while($query_data=mysqli_fetch_array($result)){
  				echo "<tr><td>";
  				echo "<p>",date("d/m", strtotime($query_data["created_at"])),"</p>";
  				echo "<p>",date("H:i", strtotime($query_data["created_at"])),"</p>";
  				echo "</td><td>";
  				echo "<p>",$query_data["ship_city"]," <span>&mdash;</span> ",$query_data["ship_to_city"],"</p>";
  				echo "<p>",$query_data["transport_type"],"</p>";
  				echo "</td><td><p>",$query_data["weight"],"т.</p>";
  				echo "<p>&nbsp;</p></td><td><p>";
  				echo $query_data["volume"],"м³";
  				echo "</p><p>&nbsp;</p></td></tr>";
  				}
  			}
  			else
  			{
  				echo "<tr><td colspan=\"3\">На данный момент заявок нет.</td></tr>";
  			}
  		}
  		else
  		{
  			echo "<tr><td colspan=\"3\">Ошибка подключения к базе данных. Попробуйте позже.</td></tr>";
  		}
  		?>
          </tbody>
        </table>
      </div>

    </div>

    <div class="tds_guide">

      <div class="step step1">
        <h4>Шаг 1</h4>
        <p>У вас есть товар, который нужно доставить или свободный транспорт?</p>
        <span><i class="fa fa-long-arrow-left"></i></span>
        <span><i class="fa fa-long-arrow-right"></i></span>
        <div><i class="fa fa-desktop"></i></div>
        <div><i class="fa fa-truck"></i></div>
      </div>

      <div class="step step2">
        <h4>Шаг 2</h4>
        <p>Оставьте заявку</p>
        <div><i class="fa fa-pencil-square-o"></i></div>
      </div>

      <div class="step step3">
        <h4>Шаг 3</h4>
        <p>Получите подтверждение <br/>по телефону</p>
        <div><i class="fa fa-check-square-o"></i></div>
      </div>

    </div>

    <div class="clearfix"></div>
  

<?php
	include_once (dir."/footer.php");
?>
