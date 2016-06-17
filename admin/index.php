<?
	include '../config.php';

	if (!is_writable($file_category)) echo '<div class="system_error">Файл с категориями '.$file_category.' недоступен на запись!</div>';
	if (!is_writable($file_items)) echo '<div class="system_error">Файл с товарами '.$file_items.' недоступен на запись!</div>';
	if (!is_writable($path_images)) echo '<div class="system_error">Папка с изображениями товаров '.$path_images.' недоступна на запись!</div>';
	if (!is_writable($path_orders)) echo '<div class="system_error">Папка с заказами '.$path_orders.' недоступна на запись!</div>';
	if ($save_backup && !is_writable($path_backups)) echo '<div class="system_error">Папка с бэкапами '.$path_backups.' недоступна на запись!</div>';

	if (isset($_POST['edit_file']) && $_POST['edit_file']=='category') {
    	$content='';
    	foreach ($_POST['ID'] as $i=>$id) {
    		$name_file=$_POST['IMG'][$i];
    		if ($_POST['IMG_SOURCE'][$i]) $name_file=$_POST['IMG_SOURCE'][$i];
    		if ($_POST['IMG_COPY'][$i]) {	    		$a=explode('.',$_POST['IMG_COPY'][$i]);
	    		$extension=explode('?',end($a));
    			$name_file=md5('c'.$i.'-'.rand(0,999)).'.'.$extension[0];
    			copy($_POST['IMG_COPY'][$i], $path_images.$name_file);
    		}
    		if ($_FILES['IMG']['tmp_name'][$i]) {
    			$a=explode('.',$_FILES['IMG']['name'][$i]);
    			$extension=explode('?',end($a));
    			$name_file=md5('c'.$i.'-'.rand(0,999)).'.'.$extension[0];
    			move_uploaded_file($_FILES['IMG']['tmp_name'][$i], $path_images.$name_file);
    		}

    		$content.=$id.$glue.htmlspecialchars($_POST['NAME'][$i]).$glue.$_POST['ALIAS'][$i].$glue.intval($_POST['STATUS'][$i]).$glue.$name_file.$glue.$_POST['PARENT'][$i]."\n";
    	}

    	if ($save_backup) copy($file_category,$path_backups.'category.'.date("YmdHis"));

    	$handle = fopen($file_category, 'w');
		fwrite($handle, $content);
		fclose($handle);

		header('Location: '.$_SERVER['PHP_SELF']);exit;
    }

    if (isset($_POST['edit_file']) && $_POST['edit_file']=='items') {
    	$content='';
    	foreach ($_POST['ID'] as $i=>$id) {
    		$name_file=$_POST['IMG'][$i];
    		if ($_POST['IMG_SOURCE'][$i]) $name_file=$_POST['IMG_SOURCE'][$i];
    		if ($_POST['IMG_COPY'][$i]) {
	    		$a=explode('.',$_POST['IMG_COPY'][$i]);
	    		$extension=explode('?',end($a));
    			$name_file=md5('i'.$i.'-'.rand(0,999)).'.'.$extension[0];
    			copy($_POST['IMG_COPY'][$i], $path_images.$name_file);
    		}
    		if ($_FILES['IMG']['tmp_name'][$i]) {
    			$a=explode('.',$_FILES['IMG']['name'][$i]);
    			$extension=explode('?',end($a));
    			$name_file=md5('i'.$i.'-'.rand(0,999)).'.'.$extension[0];
    			move_uploaded_file($_FILES['IMG']['tmp_name'][$i], $path_images.$name_file);
    		}

    		$content.=$id.$glue.htmlspecialchars($_POST['NAME'][$i]).$glue.$_POST['PRICE'][$i].$glue.intval($_POST['STATUS'][$i]).$glue.$name_file.$glue.$_POST['PARENT'][$i]."\n";
    	}

    	if ($save_backup) copy($file_items,$path_backups.'items.'.date("YmdHis"));

    	$handle = fopen($file_items, 'w');
		fwrite($handle, $content);
		fclose($handle);

		header('Location: '.$_SERVER['PHP_SELF']);exit;
    }

	if (isset($_GET['action']) && $_GET['action']=='AjaxShowOrder') {		$a=file_get_contents($path_orders.$_GET['id']);

		die($a);
	}
	//parse categorys from file, create assoc array $categorys
	$categorys=array();

	$handle = fopen($file_category, "r");
	$content = fread($handle, filesize($file_category));
	fclose($handle);

	$tmp_data_line=explode("\n",$content);
	for ($i=0;$i<count($tmp_data_line)-1;$i++) {
		$tmp_data=explode($glue,$tmp_data_line[$i]);

			foreach ($tmp_data as $a=>$b) {
				if ($a==4 && $b)
					if (!strstr($b,'/')) $tmp_data['IMG_SRC']=SITE_PATH.IMAGES_PATH.$b; else $tmp_data['IMG_SRC']=$b;
				$tmp_data[$name_array_categorys[$a]]=$b;
			}
			$categorys[$tmp_data[5]][]=$tmp_data;

	}


    //parse items from file, create assoc array $items
	$items=array();

	$handle = fopen($file_items, "r");
	$content = fread($handle, filesize($file_items));
	fclose($handle);

	$tmp_data_line=explode("\n",$content);
	for ($i=0;$i<count($tmp_data_line)-1;$i++) {
		$tmp_data=explode($glue,$tmp_data_line[$i]);

			foreach ($tmp_data as $a=>$b) {
				if ($a==4 && $b)
					if (!strstr($b,'/')) $tmp_data['IMG_SRC']=SITE_PATH.IMAGES_PATH.$b; else $tmp_data['IMG_SRC']=$b;
				$tmp_data[$name_array_items[$a]]=$b;
			}
			$items[$tmp_data[5]][]=$tmp_data;

	}


	include 'functions.php';
	include 'template.php';
?>