<?
	include 'config.php';

	//parse categorys from file, create assoc array $categorys
	$categorys=array();

	$handle = fopen($file_category, "r");
	$content = fread($handle, filesize($file_category));
	fclose($handle);

	$tmp_data_line=explode("\n",$content);
	for ($i=0;$i<count($tmp_data_line)-1;$i++) {
		$tmp_data=explode($glue,$tmp_data_line[$i]);
		if ($tmp_data[3]) {
			foreach ($tmp_data as $a=>$b) {				if ($a==4 && $b && !strstr($b,'/')) $b=SITE_PATH.IMAGES_PATH.$b;
				$tmp_data[$name_array_categorys[$a]]=$b;
			}
			$categorys[$tmp_data[5]][]=$tmp_data;
		}
	}


    //parse items from file, create assoc array $items
	$items=array();

	$handle = fopen($file_items, "r");
	$content = fread($handle, filesize($file_items));
	fclose($handle);

	$tmp_data_line=explode("\n",$content);
	for ($i=0;$i<count($tmp_data_line)-1;$i++) {
		$tmp_data=explode($glue,$tmp_data_line[$i]);
		if ($tmp_data[3]) {
			foreach ($tmp_data as $a=>$b) {
				if ($a==4 && $b && !strstr($b,'/')) $b=SITE_PATH.IMAGES_PATH.$b;
				$tmp_data[$name_array_items[$a]]=$b;
			}
			$items[$tmp_data[5]][]=$tmp_data;
		}
	}


	include 'functions.php';
	include 'template.php';
?>