var selected_item = false;
var animation = false;
var loaded_i = 0;
var console_debug = true;
$(".tabs ul li a").click(function() {
	$(this).parent().addClass('active').siblings().removeClass('active');
 	$($(this).attr('href')+"_block").addClass('active').siblings().removeClass('active');
    if (console_debug) console.log('tabs ul li '+$(this).attr('href'));

    $($(this).attr('href')+"_block img:visible").each(function() {
	    var img_src=$(this).attr('data-src');
        $(this).attr('src',img_src);

        loaded_i++;
        if (console_debug) console.log('load '+loaded_i+' img:'+$(this).attr('alt'));
    });

 	if (animation) {
 		block_top=$($(this).attr('href')+"_block").offset().top-60;
 		$("html, body").stop().animate({ scrollTop: block_top }, 600);
 	}
});

function number_format(number) {
	var i, j, kw, kd, km;

	// input sanitation & defaults
	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 2;
	}
	if( dec_point == undefined ){
		dec_point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = ".";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if( (j = i.length) > 3 ){
		j = j % 3;
	} else{
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


	return km + kw + kd;
}


function show_popup(block) {
	$(".bg").show();
	$("."+block).show();
}

function check_summ_in_cart() {
	if (save_cart) localStorage.setItem("md_cms_cart", $('.items_tovars_cart').html());

	all_sum=0;

	$(".items_tovars_cart .item").each(function( index ) {
	  	tovar_price_text=$(this).find('.price').text();
	  	tovar_price=+tovar_price_text.replace(dec_point,".").replace(thousands_sep,"");
	  	all_sum+=tovar_price;
	});

	nalog=all_sum*nalog_percent/100;

	$("#cart .h2 .right").text('RUB '+number_format(nalog));
	$("#cart .h3 .right").text('RUB '+number_format(all_sum));
}

function animate_images() {
	if (sound_on) sound_go.play();
	$( ".items_tovars .item" ).removeClass('active');
	var cart  = $('#cart').offset();

	tovar_id=$(selected_item).attr('data-id');
	tovar_img=$(selected_item).find('img');
	tovar_name=$(selected_item).find('.name').text();
	tovar_price_text=$(selected_item).find('.price').text();
	tovar_price=+tovar_price_text.replace(dec_point,".").replace(thousands_sep,"");

	$('#cart').before('<img src="' + $(tovar_img).attr('src') + '" id="temp' + tovar_id + '" style="position: fixed; top: ' + tovar_img.offset().top + 'px; left: ' + tovar_img.offset().left + 'px;" />');
	params = {
		top : cart.top + 'px',
		left : cart.left + 'px',
		opacity : 0.0,
		width : '10px',
		height : '10px'
	};

	$('#temp' + tovar_id).animate(params, 'slow', false, function () {
		$('#temp' + tovar_id).remove();

		if ($('.items_tovars_cart #item'+tovar_id).size()) {
			count=+$('.items_tovars_cart #item'+tovar_id).find('.count').text()+1;
			tovar_price=$('.items_tovars_cart #item'+tovar_id).find('.price').attr("data-price")*count;
			$('.items_tovars_cart #item'+tovar_id).find('.count').text(count);
			//$('.items_tovars_cart #item'+tovar_id).find('.price').text(String(tovar_price.toFixed(2)).replace(".",dec_point).replace(thousands_sep,""));
			$('.items_tovars_cart #item'+tovar_id).find('.price').text(number_format(tovar_price));
		} else {
			$('.items_tovars_cart').append('<div class="item" id="item'+tovar_id+'"><div class="count">1</div><div class="name">'+tovar_name+'</div><div class="price" data-price="'+tovar_price+'">'+tovar_price_text+'</div><div class="buttons"><div class="button">-</div><div class="button">+</div></div></div>');
			$('#cart .h1').css('top','-55px');
			$('.items_tovars_cart').css('padding-bottom','30px');
			$('.items_tovars_cart #item'+tovar_id).fadeIn(700, function() {
		        $('#cart .h1').css('top','-48px');
		        $('.items_tovars_cart').css('padding-bottom',0);
			});
		}

		check_summ_in_cart();
	});
}

$( ".items_tovars .item" ).click(function() {
    $(this).addClass('active');
    selected_item = $(this);

	if (sound_on) sound_click.play();
	setTimeout(animate_images, 600);
});

$(".items_tovars_cart").on("click", ".button", function() {
	if (sound_on) sound_click.play();

	count=+$(this).parents('.item').find('.count').text();
	if ($(this).text()=='+') count++; else count--;

	if (count==0)
	$(this).parents('.item').fadeOut(500, function () {
		$(this).remove();
		check_summ_in_cart();
	}); else {
		tovar_price=$(this).parents('.item').find('.price').attr("data-price")*count;
		$(this).parents('.item').find('.count').text(count);
		$(this).parents('.item').find('.price').text(number_format(tovar_price));
		check_summ_in_cart();
	}
});

$("#submit_form_submit").click(function() {
 	$("#footer").css('z-index',98);
 	$("#cart .submit_form").hide();
 	$("#order_hidden").val($("#cart").html());
 	show_popup('popup');
});

$("#submit_form_cancel").click(function() {
 	$(".bg, #cart .submit_form").fadeOut();
});

$("#footer_button_submit").click(function() {
 	if ($(".items_tovars_cart .item").size()==0) return;
 	$("#footer").css('z-index',100);
 	show_popup('submit_form');
});

$("#footer_button_cancel").click(function() {
 	$(".items_tovars_cart").html('');
 	check_summ_in_cart();
});

$(".popup form").submit(function() {
        var elem = $(this);
        var urlTarget = $(this).attr("action");
        $.ajax({
            type : "POST",
            url : urlTarget,
            data : $(this).serialize(),
            beforeSend : function() {
                elem.find(".button").text('Отправляем...');
            },
            success : function(response) {
                elem.html(response);
                $("#footer_button_cancel").trigger('click');
            }
        });
        return false;
});

$(".adaptive_phone_menu").click(function() {
 	if ($(window).scrollTop()<350) $(".tabs_category_level1 ul").slideToggle(); else $(".tabs_category_level1 ul").slideDown();
 	$("html, body").stop().animate({ scrollTop: 0 }, 600);
});

$("#cart .h1").click(function() {
 	$("#cart .items_tovars_cart, #cart .h2").slideToggle();
});


if (save_cart && localStorage.getItem("md_cms_cart")) {
	$('.items_tovars_cart').html(localStorage.getItem("md_cms_cart"));
	$('.items_tovars_cart .item').css('opacity',1);
	check_summ_in_cart();
}



items_tovars_cart_height=$(window).height()-(60+100+30+32+48);
$('.items_tovars_cart').css('max-height',items_tovars_cart_height+'px');

$(window).load(function() {
 	$(".tabs li:first-child a").trigger('click');
	if (save_url && location.hash) {
		url='#';
		a=location.hash.replace('#','').split('_');
		for (i=0;i<a.length;i++) {
			$("a[href="+url+a[i]+"]").trigger('click');
			url=url+a[i]+"_";
		}
	}

	if ($(window).width()<=500) {
	 	animation=true;
	 	$(".tabs_category_level1 ul").slideToggle();
	}
});

