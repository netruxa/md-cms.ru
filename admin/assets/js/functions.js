$(".tabs ul li a").click(function() {
	$(this).parent().addClass('active').siblings().removeClass('active');
 	$($(this).attr('href')+"_block").addClass('active').siblings().removeClass('active');
});

$(".tabs li:first-child a").trigger('click');
if (location.hash)
	$("a[href="+location.hash+"]").trigger('click');


var rusChars = new Array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ч','ц','ш','щ','э','ю','я','ы','ъ','ь', ' ', '\'', '\"', '\#', '\$', '\%', '\&', '\*', '\,', '\:', '\;', '\<', '\>', '\?', '\[', '\]', '\^', '\{', '\}', '\|', '\!', '\@', '\(', '\)', '\-', '\=', '\+', '\/', '\\', '_');
var transChars = new Array('a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','ch','c','sh','csh','e','u','ya','y','', '', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '-');

function convert2EN(text)
{
  	text = text.toLowerCase();

  	var to = "";
  	var len = text.length;
  	var character, isRus;
  	for(var i=0; i < len; i++)
    	{
		    character = text.charAt(i,1);
		    isRus = false;
		    for(var j=0; j < rusChars.length; j++)
	      	if(character == rusChars[j])
				{
			        isRus = true;
			        break;
		        }

    		to += (isRus) ? transChars[j] : character;
    	}

  	return to;
}

function renderImage(file,where) {
	var reader = new FileReader();
	reader.onload = function(event) {
    	the_url = event.target.result;
    	$(where).html("<img src='" + the_url + "' />");
  	}

	reader.readAsDataURL(file);
}

$(document).ready(function() {
    $(".drag-table").tableDnD({
    	dragHandle: 	'.drag',
    	onDragClass:	'selected'
    });
});

$("#category_block .drag-table").on('input','input.name',function() {
    url=$(this).parents('tr').find('input.url');
    //if ($(url).val()=='')
    $(url).val(convert2EN($(this).val()));
});

$(".drag-table").on('change','input[type=file]',function() {
    console.log(this.files);
    renderImage(this.files[0],$(this).parents('td').find('.prev_img'));
});

$(".drag-table").on('change','.action_copy input,.action_source input',function() {
    $(this).parents('td').find('.prev_img').html('<img src="'+$(this).val()+'">');
});

$('.filter_items_category select').prepend('<option value="0" selected>Фильтр по категориям</option>').change(function() {	$("#items_block .drag-table tbody tr").hide();
	$("#items_block .drag-table tbody tr.category"+$(this).val()).show();
});

$(".drag-table").on('click','.upload_block_drop',function() {
    $(this).find('.dropdown').slideToggle(100);
    return false;
    //$(this).prev().find('input').trigger('click');
});

$(".drag-table").on('click','.dropdown a',function() {
   	if ($(this).attr('data-action')=='upload') {   		$(this).parents('td').find('.upload_block input').trigger('click');
   		$(this).parents('td').find('.upload_block').show().siblings().hide();
   		$(this).parents('td').find('.upload_block_drop').removeClass('btn-info').addClass('btn-success');
   	}

   	if ($(this).attr('data-action')=='copy') {
   		$(this).parents('td').find('.action_copy').show().siblings().hide();
   		$(this).parents('td').find('.action_copy input').focus();
   		$(this).parents('td').find('.upload_block_drop').removeClass('btn-success').addClass('btn-info');
   	}

   	if ($(this).attr('data-action')=='source') {
   		$(this).parents('td').find('.action_source').show().siblings().hide();
   		$(this).parents('td').find('.action_source input').focus();
   		$(this).parents('td').find('.upload_block_drop').removeClass('btn-success').addClass('btn-info');
   	}

   	if ($(this).attr('data-action')=='delete') {
   		$(this).parents('td').find('.prev_img').html('');
   		$(this).parents('td').find('.upload_block').show().siblings().hide();
   		$(this).parents('td').find('.upload_block_drop').removeClass('btn-info').addClass('btn-success');
   	}
});