<!-- drivers list -->
		<div>Анкеты водителей</div>
			 <form action="" method="post">
			 <input type="submit" name="del_items" value="Удалить выбранные" onclick="return confirm('Вы действительно хотите удалить выбранные записи?');">
				<table>
					<thead>
						<tr><th><input type="checkbox" name="check_all" value="" id="check_all" >Отметить все</th>
	<?php
						foreach($drivers_admin_array as $key => $value)
						{	
							if($drivers_sort_admin_array[$key]==true){
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
						if($result=drivers_list_admin($page))
						{
							if(mysqli_num_rows($result))
								{	
									while($query_data=mysqli_fetch_array($result)){
										?>
										<tr>
											<td>
												<input type="checkbox" name="item[]" class="check" value="<?php echo $query_data['id'];?>">
											</td>
											<td>
												<?php echo $query_data['name'];?>
											</td>
											<td>
												<?php echo $query_data['phone'];?>
											</td>
											<td>
												<?php echo $query_data['location'];?>
											</td>
											<td>
												<?php echo $query_data['details'];?>
											</td>
											<td>
										<?php echo "<a href=\"edit_$view_list.php?page=",($page+1),$query_string,"&id=",$query_data['id'],"\">Редактировать</a> ";
										echo "<a class=\"remove\" href=\"index.php?page=",($page+1),$query_string,"&remove=",$query_data['id'],"\">Удалить</a>";
										echo "</td></tr>";
									}
								}
							else
							{
								echo "<tr><td colspan=\"6\">Отсутствуют анкеты водителей.</td></tr>";
							}
						}
						else {
							echo "<tr><td colspan=\"6\">Невозможно подключиться к базе данных.</td></tr>";
						}
			echo "</tbody></table></form>";
	?>	