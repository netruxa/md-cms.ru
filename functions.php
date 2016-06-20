<?
function show_menu($categorys,$url=false) {
	$return='<ul>';
	foreach ($categorys as $category) {
		if ($url) $link=$url.'_'.$category['ALIAS']; else $link=$category['ALIAS'];
		$return.='<li class="category'.$category['ID'].'"><a href="#'.$link.'">';
		if ($category['NAME']) $return.='<span>'.$category['NAME'].'</span>';
		if ($category['IMG']) $return.='<img src="'.$category['IMG'].'" alt="'.$category['NAME'].'">';
		$return.='</a></li>';
	}
	$return.='</ul>';

	return $return;
}

function show_items($items,$number_format) {
	$return='<div class="items_tovars">';
	foreach ($items as $item) {
		$return.='<div class="item item'.$item['ID'].'" data-id="'.$item['ID'].'">';
		$return.='<div class="img"><img src="assets/images/no-image.png" data-src="'.$item['IMG'].'" alt="'.$item['NAME'].'"></div>';
		if ($item['NAME']) $return.='<div class="name">'.$item['NAME'].'</div>';
		if ($item['PRICE']) $return.='<div class="price">'.number_format($item['PRICE'],$number_format['decimals'],$number_format['dec_point'],$number_format['thousands_sep']).'</div>';
		$return.='</div>';
	}
    $return.='</div>';

	return $return;
}
?>