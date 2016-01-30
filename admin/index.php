<?php
session_start();
if (isset($_GET['do']) && $_GET['do']=='logout')
{
	unset($_SESSION['admin']);
	session_destroy();
}
if(!$_SESSION['admin']){
	header("Location: login.php");
	exit;
}
//error_reporting(E_ALL);
define ('dir', __DIR__);
include_once (dir."/functions_admin.php");
$query_string='';
	foreach($_GET as $param => $value)
		{
			if ($param && $param!="remove" && $param!="page")
			{
				$query_string.="&$param=$value";	
			}
		}
	if (isset($_GET['page']))
				{	
					$page = ($_GET['page'] - 1);
				}
			else 
				{$page = 0;}	
	get_control();
	include_once dir."/header_admin.php";
?>
<div class="content">
	<?php
		if (isset($_GET['remove'])&& isset($_GET['view']))
		{
			if(delete_row($_GET['remove'], $_GET['view']))
			{
				echo "Запись с id=",$_GET['remove']," успешно удалена<br><br>";
			}
			else
			{
				echo "Невозможно удалить запись с id=",$_GET['remove'];
			}
		}
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/
		if(isset($_POST['item']))
		{
			if(isset($_POST['del_items']))
			{
				if($result=delete_items($view_list))
				{
					echo "Записи с id=$result успешно удалены.";
				}
				else
				{
					echo "Удаление невозможно.";
				}
			}
			if(isset($_POST['approved_items']))
			{
				if($result=approved_waiting_items($view_list,1))
				{
					echo "Записи с id=$result успешно одобрены.";
				}
				else
				{
					echo "Операция невозможна.";
				}
			}
			if(isset($_POST['waiting_items']))
			{
				if($result=approved_waiting_items($view_list,0))
				{
					echo "Записи с id=$result в ожидании.";
				}
				else
				{
					echo "Операция невозможна.";
				}
			}
		}
	?>
	<!-- welcome -->
	<?php 
		if(empty($_GET['view']))
			{echo "Добро пожаловать в админ панель, выберите необходимый пункт меню.";}	
		elseif($_GET['view']=='transports')
			{include_once dir."/transports_admin.php";}
		elseif($_GET['view']=='cargos')
			{include_once dir."/cargos_admin.php";}
		elseif($_GET['view']=='drivers')
			{include_once dir."/drivers_admin.php";}
		$total_pages=total_rows($view_list);
		if($total_pages>1)
			{	echo "Страницы<br>";
				for($i = 1; $i <= $total_pages; $i++)
					{
						if($i==($page+1))
							{
								$now_page=" current_page";
							}
						else
							{
								$now_page="";
							}
						echo '<a href="?page=' . $i .$query_string.'" class="pages'.$now_page.'">' . $i . '</a>';
					}
			}
	?>
    </div>

  </div>
	<div class="alert-success" style="display:none">
		<p>Удалить запись?</p><br>
		<a href="" class="ok">Да</a>
		<a href="" class="cancel">Нет</a>
	</div>
<script type="text/javascript">
  
  $(document).ready(function(){
	$("a.remove").click(function(e,del){
        e.preventDefault(); 
		$(".ok").attr('href',$(this).attr('href'));
		$(".alert-success").wrap("<div class='tds_modal'></div>");
		$(".alert-success").show();
	});

	$(".cancel").click(function(){
		$(".tds_modal").hide();
      $(".alert-success").hide();
	  });
	$(".ok").click(function(del){
		$(".tds_modal").hide();
      $(".alert-success").hide();
	  location.href = $(this).attr('href');
	  });

 $("#check_all").change(function() {
		if($(this).is(':checked'))
			$(".check").prop('checked', true);
		else
			$(".check").prop('checked', false);
			
	});
  });

</script>
</body>
</html>