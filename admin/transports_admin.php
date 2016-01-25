<!-- transport list -->
		<div>Последние добавления транспорта</div>
			 <form action="" method="post">
			 <input type="submit" name="del_items" value="Удалить выбранные" onclick="return confirm('Вы действительно хотите удалить выбранные записи?');">
			 <input type="submit" name="approved_items" value="Одобрить выбранные">
			 <input type="submit" name="waiting_items" value="Не одобрить выбранные">
				<table>
					<thead>
						<tr><th><input type="checkbox" name="check_all" value="" id="check_all" >Отметить все</th>
	<?php
						foreach($transport_admin_array as $key => $value)
						{	
							if($transport_sort_admin_array[$key]==true){
								echo "<th><a href=\"".$_SERVER['PHP_SELF']."?page=",($page+1),"&view=$view_list&order_by=$key&";
								if(isset($_GET['order_by'])&&($_GET['order_by']==$key)&&($_GET['up_down']=='asc'))
									{echo "up_down=desc";}
								else 
									{echo "up_down=asc";}
								echo "\">$value</a></th>";
							}
							else{
								echo "<th>",$value,"</th>";
							}
						}
	?>

						<th>действия</th>
						</tr>
					</thead>
	
					<tbody>
					<?php
						if($result=transport_list_admin($page))
						{
							if(mysqli_num_rows($result))
								{	
									while($query_data=mysqli_fetch_array($result)){
										echo '<tr><td><input type="checkbox" name="item[]" class="check" value="'.$query_data['id'].'"></td>';
										echo"<td>",month_convert($query_data['transport_from_date']),"</td>";
										echo"<td>",month_convert($query_data['transport_till_date']),"</td>";
										echo"<td>";
										echo htmlspecialchars($query_data['transport_city'], ENT_QUOTES, "UTF-8");
										echo "</td><td>";
										echo htmlspecialchars($query_data['transport_to_city'], ENT_QUOTES, "UTF-8");
										echo "</td><td>";
										echo $query_data['transport_type'];
										echo"</td><td>";
										echo htmlspecialchars($query_data['company_name'], ENT_QUOTES, "UTF-8");
										echo "</td>";
										echo"<td>",$query_data['phone'],"</td><td>";
											if ($query_data['order_status'])
											{echo "Одобрено";}
											else 
											{echo"Ожидает";}
										echo"</td><td>",
										"<a href=\"edit_transports.php?page=",($page+1),$query_string,"&id=",$query_data['id'],"\">Редактировать</a> ";
										echo "<a class=\"remove\" href=\"index.php?page=",($page+1),$query_string,"&remove=",$query_data['id'],"\">Удалить</a>";
										echo "</td></tr>";
									}
								}
							else
							{
								echo "<tr><td colspan=\"9\">Отсутствуют предложения по транспорту.</td></tr>";
							}
						}
						else {
							echo "<tr><td colspan=\"9\">Невозможно подключиться к базе данных.</td></tr>";
						}
			echo "</tbody></table></form>";
	?>	