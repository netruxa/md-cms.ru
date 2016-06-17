<?
function show_select($categorys,$me=false,$selected=false) {
			$parent_select='<select name="PARENT['.$me.']"><option value="0">--- Не выбрано ---</option>';
			foreach ($categorys as $category) {
				if ($me && $category['ID']==$me) continue;
				$parent_select.='<option value="'.$category['ID'].'"';
				if ($selected && $category['ID']==$selected) $parent_select.=' selected';
				$parent_select.='>'.$category['NAME'].'</option>';
			}
			$parent_select.='</select>';

			return $parent_select;
}

function show_select_all($categorys,$me=false,$selected=false) {
			$parent_select='<select name="PARENT['.$me.']">';
			foreach ($categorys[0] as $category) {
				$parent_select.='<option value="'.$category['ID'].'"';
				if ($selected && $category['ID']==$selected) $parent_select.=' selected';
				$parent_select.='>'.$category['NAME'].'</option>';

				if (isset($categorys[$category['ID']]))
				foreach ($categorys[$category['ID']] as $category) {
					$parent_select.='<option value="'.$category['ID'].'"';
					if ($selected && $category['ID']==$selected) $parent_select.=' selected';
					$parent_select.='>- '.$category['NAME'].'</option>';
				}
			}
			$parent_select.='</select>';

			return $parent_select;
}
?>