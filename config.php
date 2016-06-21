<?
	/*настраиваемые параметры*/
	define(SITE_PATH,'/demo/');				//папка, где находится md-cms. если в корне сайта, то '/'

	$save_backup=true;		//сохранять предыдущие версии файлов с категориями и товарами
	$save_cart=true;		//сохранять в локальном хранилище (куках) данные в корзине
	$save_url=true;			//при обновлении страницы переходить в выбранную категорию

	$send_mail=true;									//отправлять сообщение менеджеру
	define(MAIL_FROM,'info@md-cms.ru');					//от кого отправлять сообщение
	define(MAIL_TO,'info@md-cms.ru');        			//кому отправлять сообщение
	define(MAIL_SUBJECT,'Заявка с сайта md-cms.ru');	//тема отправляемого сообщения


	/*seo параметры для шаблона. если какой-либо параметр пуст, он не будет отображаться на сайте*/
	$seo['title']='md-cms DEMO';
	$seo['meta_description']='На этой демо-витрине можно ознакомиться с меню ресторана Макдоналдс. Цены актуальны на ноябрь 2015';
	$seo['meta_keywords']='md-cms, макдоналдс, mcdonalds';
	$seo['og_image']=SITE_PATH.'assets/images/social.jpg';
	$id_metrika='33483513';


	/*отображение в корзине*/
	$config_tax=18;							//налог в процентах

	$number_format['decimals']=2;			//Устанавливает число знаков после запятой
	$number_format['dec_point']=',';      	//Устанавливает разделитель дробной части
	$number_format['thousands_sep']=' ';  	//Устанавливает разделитель тысяч


	/*стандартные параметры, не рекомендуется изменять без надобности*/
	$glue='###';							//разделитель массива в файле. рекомендуется изменять только в том случае, если в названиях может содержаться ###

	define(IMAGES_PATH,'upload/images/');
	$file_category = $_SERVER['DOCUMENT_ROOT'].SITE_PATH.'upload/data/category.mdcms';	//адрес файла с категориями
	$file_items = $_SERVER['DOCUMENT_ROOT'].SITE_PATH.'upload/data/items.mdcms';      	//адрес файла с товарами
	$path_orders = $_SERVER['DOCUMENT_ROOT'].SITE_PATH.'upload/data/orders/';     		//папка с заказами
	$path_backups = $_SERVER['DOCUMENT_ROOT'].SITE_PATH.'upload/data/backups/';     	//папка с бэкапами файлов category.json и items.json
    $path_images = $_SERVER['DOCUMENT_ROOT'].SITE_PATH.IMAGES_PATH;

	$sound_enable=true;										//озвучка движений
	$sound['click']=SITE_PATH.'upload/sounds/click.mp3';	//звук при клике на товар
	$sound['go']=SITE_PATH.'upload/sounds/go.mp3';          //звук при улете товара в корзину

	$version_mdcms='1.1';
	$name_array_categorys=array(
		0=>'ID',
		1=>'NAME',
		2=>'ALIAS',
		3=>'STATUS',
		4=>'IMG',
		5=>'PARENT'
	);

	$name_array_items=array(
		0=>'ID',
		1=>'NAME',
		2=>'PRICE',
		3=>'STATUS',
		4=>'IMG',
		5=>'PARENT'
	);
?>