<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=1024">
		<title>md-cms: admin panel</title>

		<link href="assets/css/normalize.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
	</head>
  	<body>
    <!--pre style="font-size:10px;">
  	<?print_r($categorys);?>
  	<?print_r($_POST);?>
  	<?print_r($_FILES);?>
    </pre-->
    <div class="container">

    <div class="tabs tabs_admin">
		<ul>
			<li class="active"><a href="#category">Редактор категорий</a></li>
			<li><a href="#items">Редактор товаров</a></li>
			<li><a href="#orders">Список заказов</a></li>
		</ul>
	</div>

	<div class="tabs_data">
		<div class="active" id="category_block">
		    <h1>Редактор категорий</h1>
		  	<form enctype="multipart/form-data" method="POST">
		  	<input name="edit_file" type="hidden" value="category">
		  	<table class="drag-table">
				<thead>
					<tr>
						<td><img src="assets/images/move_cursor.png"></td>
						<!--td>ID</td-->
						<td width="250">Картинка</td>
						<td>Название</td>
						<td>URL</td>
						<td>Статус</td>
						<td>Родительская категория</td>
					</tr>
				</thead>
				<tbody>
				<?
				$i_ID_category=0;
				foreach ($categorys[0] as $category) {
				if ($category['ID']>$i_ID_category) $i_ID_category=$category['ID'];
				?>
				<tr>
					<td class="drag">:<input name="ID[<?=$category['ID'];?>]" type="hidden" value="<?=$category['ID'];?>"></td>
					<td>
						<div class="prev_img"><? if ($category['IMG']) echo '<img src="'.$category['IMG_SRC'].'"><input name="IMG['.$category['ID'].']" type="hidden" value="'.$category['IMG'].'">'; ?></div>

						<div>
							<div class="copy_block action_copy btn-info">Скопировать с<br /><input name="IMG_COPY[<?=$category['ID'];?>]" type="text" value=""></div>
							<div class="copy_block action_source btn-info">Указать URL адрес<br /><input name="IMG_SOURCE[<?=$category['ID'];?>]" type="text" value=""></div>
							<div class="upload_block btn-success">Выбрать файл<input name="IMG[<?=$category['ID'];?>]" type="file" accept="image/*"></div>
                        </div>

                        <div class="upload_block_drop btn-success"><span class="caret"></span><ul class="dropdown"><li><a href="#" data-action="upload">Загрузить с компьютера</a></li><li><a href="#" data-action="copy">Скопировать с источника</a></li><li><a href="#" data-action="source">Указать источник</a></li><li><a href="#" data-action="delete">Удалить картинку</a></li></ul></div>
					</td>
					<td><input name="NAME[<?=$category['ID'];?>]" type="text" value="<?=$category['NAME'];?>" class="name"></td>
					<td><input name="ALIAS[<?=$category['ID'];?>]" type="text" value="<?=$category['ALIAS'];?>" class="url"></td>
					<td><input name="STATUS[<?=$category['ID'];?>]" type="checkbox" value="1" <? if ($category['STATUS']) echo 'checked';?>></td>
					<td><?=show_select($categorys[0],$category['ID']);?></td>
				</tr>
				<? if (isset($categorys[$category['ID']]))

					foreach ($categorys[$category['ID']] as $category) {
					if ($category['ID']>$i_ID_category) $i_ID_category=$category['ID'];
					?>
					<tr>
						<td class="drag">:<input name="ID[<?=$category['ID'];?>]" type="hidden" value="<?=$category['ID'];?>"></td>
						<td>
						<div class="prev_img"><? if ($category['IMG']) echo '<img src="'.$category['IMG_SRC'].'"><input name="IMG['.$category['ID'].']" type="hidden" value="'.$category['IMG'].'">'; ?></div>

						<div>
							<div class="copy_block action_copy btn-info">Скопировать с<br /><input name="IMG_COPY[<?=$category['ID'];?>]" type="text" value=""></div>
							<div class="copy_block action_source btn-info">Указать URL адрес<br /><input name="IMG_SOURCE[<?=$category['ID'];?>]" type="text" value=""></div>
							<div class="upload_block btn-success">Выбрать файл<input name="IMG[<?=$category['ID'];?>]" type="file" accept="image/*"></div>
                        </div>

                        <div class="upload_block_drop btn-success"><span class="caret"></span><ul class="dropdown"><li><a href="#" data-action="upload">Загрузить с компьютера</a></li><li><a href="#" data-action="copy">Скопировать с источника</a></li><li><a href="#" data-action="source">Указать источник</a></li><li><a href="#" data-action="delete">Удалить картинку</a></li></ul></div>
					</td>
						<td><input name="NAME[<?=$category['ID'];?>]" type="text" value="<?=$category['NAME'];?>" class="name"></td>
						<td><input name="ALIAS[<?=$category['ID'];?>]" type="text" value="<?=$category['ALIAS'];?>" class="url"></td>
						<td><input name="STATUS[<?=$category['ID'];?>]" type="checkbox" value="1" <? if ($category['STATUS']) echo 'checked';?>></td>
						<td><?=show_select($categorys[0],$category['ID'],$category['PARENT']);?></td>
					</tr>
					<? } ?>

				<? } ?>
				</tbody>
		  	</table>

		  	<div class="buttons">
		  		<button class="right btn-success">сохранить ></button>
		  		<button id="add_new_item_category" class="left btn-warning">добавить новую категорию +</button>
			</div>
		  	</form>
  		</div>

  		<div id="items_block">
		    <h1>Редактор товаров</h1>
		  	<form enctype="multipart/form-data" method="POST">
		  	<input name="edit_file" type="hidden" value="items">
		  	<table class="drag-table">
				<thead>
					<tr>
						<td><img src="assets/images/move_cursor.png"></td>
						<!--td>ID</td-->
						<td width="250">Картинка</td>
						<td>Название</td>
						<td>Цена</td>
						<td>Статус</td>
						<td class="filter_items_category">Категория <?=show_select_all($categorys);?></td>
					</tr>
				</thead>
				<tbody>
				<?
				$i_ID_item=0;
				foreach ($items as $category_ID=>$items_data)
				foreach ($items_data as $item) {
				if ($item['ID']>$i_ID_item) $i_ID_item=$item['ID'];
				?>
				<tr class="category<?=$item['PARENT'];?>">
					<td class="drag">:<input name="ID[<?=$item['ID'];?>]" type="hidden" value="<?=$item['ID'];?>"></td>
					<td>
						<div class="prev_img"><? if ($item['IMG']) echo '<img src="'.$item['IMG_SRC'].'"><input name="IMG['.$item['ID'].']" type="hidden" value="'.$item['IMG'].'">'; ?></div>

						<div>
							<div class="copy_block action_copy btn-info">Скопировать с<br /><input name="IMG_COPY[<?=$item['ID'];?>]" type="text" value=""></div>
							<div class="copy_block action_source btn-info">Указать URL адрес<br /><input name="IMG_SOURCE[<?=$item['ID'];?>]" type="text" value=""></div>
							<div class="upload_block btn-success">Выбрать файл<input name="IMG[<?=$item['ID'];?>]" type="file" accept="image/*"></div>
                        </div>

                        <div class="upload_block_drop btn-success"><span class="caret"></span><ul class="dropdown"><li><a href="#" data-action="upload">Загрузить с компьютера</a></li><li><a href="#" data-action="copy">Скопировать с источника</a></li><li><a href="#" data-action="source">Указать источник</a></li><li><a href="#" data-action="delete">Удалить картинку</a></li></ul></div>
					</td>
					<td><input name="NAME[<?=$item['ID'];?>]" type="text" value="<?=$item['NAME'];?>" class="name"></td>
					<td><input name="PRICE[<?=$item['ID'];?>]" type="text" value="<?=$item['PRICE'];?>" class="price"></td>
					<td><input name="STATUS[<?=$item['ID'];?>]" type="checkbox" value="1" <? if ($item['STATUS']) echo 'checked';?>></td>
					<td><?=show_select_all($categorys,$item['ID'],$item['PARENT']);?></td>
				</tr>
				<? } ?>
				</tbody>
		  	</table>

		  	<div class="buttons">
		  		<button class="right btn-success">сохранить ></button>
		  		<button id="add_new_item" class="left btn-warning">добавить новый товар +</button>
			</div>
		  	</form>
  		</div>

  		<div id="orders_block">
  			<h1>Список заказов</h1>
  			<div class="items_orsers">
  			<?
  			$handle = opendir($path_orders);
  			while (false !== ($file = readdir($handle)))
	        {
	            if (preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})\.order/",$file,$a))
	            {
				echo '<div class="item"><a href="'.$file.'">'.$a[3].'.'.$a[2].'.'.$a[1].' '.$a[4].':'.$a[5].':'.$a[6].'</a><div class="order_detail"></div></div>';
	            }
	        }
	        ?>
	        </div>
  		</div>
  	</div>

<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/jquery.tablednd.js"></script>
<script src="assets/js/functions.js"></script>
<script>
var i_ID_category=<?=$i_ID_category;?>;
var i_ID_item=<?=$i_ID_item;?>;

$("#add_new_item_category").click(function() {
    i_ID_category++;
	append='<tr>'+
    		'<td class="drag">:<input name="ID['+i_ID_category+']" type="hidden" value="'+i_ID_category+'"></td>'+
			'<td>'+
				'<div class="prev_img"><input name="IMG['+i_ID_category+']" type="hidden" value=""></div>'+
				'<div>'+
					'<div class="copy_block action_copy btn-info">Скопировать с<br /><input name="IMG_COPY['+i_ID_category+']" type="text" value=""></div>'+
					'<div class="copy_block action_source btn-info">Указать URL адрес<br /><input name="IMG_SOURCE['+i_ID_category+']" type="text" value=""></div>'+
					'<div class="upload_block btn-success">Выбрать файл<input name="IMG['+i_ID_category+']" type="file" accept="image/*"></div>'+
                '</div>'+
				'<div class="upload_block_drop btn-success"><span class="caret"></span><ul class="dropdown"><li><a href="#" data-action="upload">Загрузить с компьютера</a></li><li><a href="#" data-action="copy">Скопировать с источника</a></li><li><a href="#" data-action="source">Указать источник</a></li><li><a href="#" data-action="delete">Удалить картинку</a></li></ul></div>'+
			'</td>'+
			'<td><input name="NAME['+i_ID_category+']" type="text" value="" class="name"></td>'+
			'<td><input name="ALIAS['+i_ID_category+']" type="text" value="" class="url"></td>'+
			'<td><input name="STATUS['+i_ID_category+']" type="checkbox" value="1" checked></td>'+
			'<td><?=show_select($categorys[0]);?></td>'+
		'</tr>';
   	append=append.replace("PARENT[]","PARENT["+i_ID_category+"]");

	$("#category_block .drag-table").append(append).tableDnD({
    	dragHandle: 	'.drag',
    	onDragClass:	'selected'
    });

    return false;
});

$("#add_new_item").click(function() {
    i_ID_item++;
	append='<tr class="just_created">'+
    		'<td class="drag">:<input name="ID['+i_ID_item+']" type="hidden" value="'+i_ID_item+'"></td>'+
			'<td>'+
				'<div class="prev_img"><input name="IMG['+i_ID_item+']" type="hidden" value=""></div>'+
				'<div>'+
					'<div class="copy_block action_copy btn-info">Скопировать с<br /><input name="IMG_COPY['+i_ID_item+']" type="text" value=""></div>'+
					'<div class="copy_block action_source btn-info">Указать URL адрес<br /><input name="IMG_SOURCE['+i_ID_item+']" type="text" value=""></div>'+
					'<div class="upload_block btn-success">Выбрать файл<input name="IMG['+i_ID_item+']" type="file" accept="image/*"></div>'+
                '</div>'+
				'<div class="upload_block_drop btn-success"><span class="caret"></span><ul class="dropdown"><li><a href="#" data-action="upload">Загрузить с компьютера</a></li><li><a href="#" data-action="copy">Скопировать с источника</a></li><li><a href="#" data-action="source">Указать источник</a></li><li><a href="#" data-action="delete">Удалить картинку</a></li></ul></div>'+
			'</td>'+
			'<td><input name="NAME['+i_ID_item+']" type="text" value="" class="name"></td>'+
			'<td><input name="PRICE['+i_ID_item+']" type="text" value="" class="price"></td>'+
			'<td><input name="STATUS['+i_ID_item+']" type="checkbox" value="1" checked></td>'+
			'<td><?=show_select_all($categorys);?></td>'+
		'</tr>';
   	append=append.replace("PARENT[]","PARENT["+i_ID_item+"]");

	$("#items_block .drag-table").append(append).tableDnD({
    	dragHandle: 	'.drag',
    	onDragClass:	'selected'
    });

    if ($('.filter_items_category select').val()>0)
    $(".just_created").find('select option[value='+$('.filter_items_category select').val()+']').attr('selected','selected');

    $(".just_created").removeClass("just_created");

    return false;
});

$(".items_orsers .item a").click(function() {
	order_detail=$(this).parent().find('.order_detail');
	$(order_detail).slideToggle();
	if ($(order_detail).html()=='')
		$.get('index.php?action=AjaxShowOrder&id='+$(this).attr('href'), function(data) {
        	$(order_detail).html(data);
		});

    return false;
});
</script>
	<? if ($id_metrika) { ?><!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter<?=$id_metrika;?> = new Ya.Metrika({ id:<?=$id_metrika;?>, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/<?=$id_metrika;?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter --><? } ?>
	</body>
</html>