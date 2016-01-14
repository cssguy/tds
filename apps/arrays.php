<?php
	$home_url="http://tds.in.ua"; // url сайта
	$page_site=5; // количество записей на страницу на сайте
	$to_mail="example7777@@_ua@ukr.net, kiber_ua@rambler.ru";
	$from_mail='noreply@tds.in.ua';
/*-транспорт, который нужно выводить в админке-*/
	$transport_admin_array=array(
								'transport_from_date'=>'транспорт свободен с',
								'transport_till_date'=>'транспорт свободен по','transport_city'=>'город нахождения ',
								'transport_to_city'=>'город назначения ',
								'transport_type'=>'тип транспорта ',
								'company_name'=>'имя ',
								'phone'=>'телефон ',
								'order_status'=>'статус заявки ');
/*-поля транспорта, который нужно сортировать в админке-*/
	$transport_sort_admin_array=array(
								'transport_from_date'=>true,
								'transport_till_date'=>true,
								'transport_city'=>true,
								'transport_to_city'=>true,
								'transport_type'=>false,
								'company_name'=>false,
								'phone'=>false,
								'order_status'=>true);
/*-груз, который нужно выводить в админке-*/
	$cargos_admin_array=array(
								'ship_from_date'=>'загрузка с ',
								'ship_till_date'=>'загрузка по ',
								'ship_city'=>'город нахождения ',
								'ship_to_city'=>'город назначения ',
								'transport_type'=>'тип транспорта ',
								'company_name'=>'имя ',
								'phone'=>'телефон ',
								'order_status'=>'статус заявки ');
/*-груз, который нужно сортировать в админке-*/
	$cargos_sort_admin_array=array(
								'ship_from_date'=>true,
								'ship_till_date'=>true,
								'ship_city'=>true,
								'ship_to_city'=>true,
								'transport_type'=>true,
								'company_name'=>false,
								'phone'=>false,
								'order_status'=>true);
$transport_type_option=array("Цельномет","Тент","Контейнер","Изотерм","Реф.","Контейнеровоз","Бортовая","Самосвал","Зерновоз","Цистерна","Негабаритный","Платформа","Автовоз","Окновоз","Скотовоз","Меблевоз","Бензовоз","Бетоновоз");

$payment_type_option=array("Наличными","Безналичными");	

$company_type_option=array("Грузовладелец","Перевозчик","Диспетчер","Экспедитор","Логический оператор");
?>