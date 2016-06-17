<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>md-cms DEMO</title>
		<meta name="description" content="На этой демо-витрине можно ознакомиться с меню ресторана Макдоналдс. Цены актуальны на ноябрь 2015" />
		<meta name="keywords" content="md-cms, макдоналдс, mcdonalds" />
		<meta property="og:image" content="<?=SITE_PATH;?>assets/images/social.jpg"/>

		<link href="assets/css/normalize.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/responsive.css" rel="stylesheet">
	</head>
  	<body>

  	<div class="container_full">
		<div class="tabs tabs_category_level1">
			<div class="adaptive_phone_menu">Меню</div>
			<?=show_menu($categorys[0]);?>
		</div>

		<div class="tabs_data data_level1">
			<? foreach ($categorys[0] as $category) { ?>
			<div id="<?=$category['ALIAS'];?>_block">
				<div class="tabs tabs_category_level2 subcategory<?=$category['ID'];?>">
					<?=show_menu($categorys[$category['ID']],$category['ALIAS']);?>
				</div>
				<div class="tabs_data data_level2">
					<? foreach ($categorys[$category['ID']] as $category_level2) { ?>
					<div id="<?=$category['ALIAS'].'_'.$category_level2['ALIAS'];?>_block">
						<?=show_items($items[$category_level2['ID']],$number_format);?>
					</div>
					<? } ?>
				</div>
			</div>
			<? } ?>
		</div>

		<div id="footer">
			<div class="button footer_button left" id="footer_button_cancel">Отмена</div>
			<div class="button footer_button right" id="footer_button_submit">Готово</div>
			<div id="cart">
				<div class="h1 slow">Мой заказ</div>
				<div class="submit_form">
					Этот заказ представлен верно?
					<div class="button left" id="submit_form_submit">Да</div><div class="button right" id="submit_form_cancel">Нет</div>
				</div>
				<div class="items_tovars_cart slow"></div>
				<div class="h2">
					<div class="left">Налог</div>
					<div class="right">RUB 0,00</div>
				</div>
				<div class="h3">
					<div class="left">Итого</div>
					<div class="right">RUB 0,00</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg"></div>
	<div class="popup">
		<!-- demo -- Вставьте карту, следуйте инструкции на пин-паде<br />Insert card, follow instruction on PinPad screen-->
	    <div class="zag">Подтверждение заказа</div>
	    <form action="send.php">
	    <input id="order_hidden" name="order" type="hidden" value="">
	    <table>
			<tr><td><label for="form_name">Имя:</label></td><td><input id="form_name" name="form_name" type="text" value=""></td></tr>
			<tr><td><label for="form_phone">Телефон: *</label></td><td><input id="form_phone" name="form_phone" type="text" value="" required></td></tr>
			<tr><td><label for="form_email">E-mail:</label></td><td><input id="form_email" name="form_email" type="email" value=""></td></tr>
	    </table>
	    <div class="submit">
	    	<button class="button">Отправить</button>
	    </div>
	    </form>
	</div>

	<script src="assets/js/jquery-2.1.4.min.js"></script>
	<script>
		var nalog_percent = <?=$config_tax;?>;						//налог, указывается в процентах
		var sound_on = <?=($sound_enable?"true":"false");?>;		//включить или нет звук

		if (sound_on) {
			var sound_click = new Audio("<?=$sound['click'];?>");	//звук при клике на товар
			var sound_go = new Audio("<?=$sound['go'];?>");    		//звук при улете товара в корзину
		}
		var save_cart = <?=($save_cart?"true":"false");?>;			//сохранять все товары в корзине
		var save_url = <?=($save_url?"true":"false");?>;			//переходить в нужную категорию
		var decimals = '<?=$number_format['decimals'];?>';			//число знаков после запятой
		var dec_point = '<?=$number_format['dec_point'];?>';		//разделитель дробной части
		var thousands_sep = '<?=$number_format['thousands_sep'];?>';//разделитель тысяч
	</script>
	<script src="assets/js/functions.js"></script>
    <!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter33483513 = new Ya.Metrika({ id:33483513, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/33483513" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
	</body>
</html>