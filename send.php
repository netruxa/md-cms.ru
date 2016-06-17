<?
include 'config.php';



function pismo($to, $subject, $message)
{
	$un        = strtoupper(uniqid(time()));
	$head      = "From: ".MAIL_FROM."\n";
	$head     .= "X-Mailer: PHPMail Tool\n";
	$head     .= "Mime-Version: 1.0\n";
	$head     .= "Content-Type: text/html; charset=utf-8;";
	$head     .= "boundary=\"----------".$un."\"\n\n";

	return mail($to, $subject, $message, $head);
}

if (isset($_POST['order'])) {
	$message='Дата и время: '.date("d.m.Y H:i:s").'<br />';
	if ($_POST['form_name'])
	$message.='Имя: '.$_POST['form_name'].'<br />';
	$message.='Телефон: '.$_POST['form_phone'].'<br />';
	if ($_POST['form_email'])
	$message.='E-mail: '.$_POST['form_email'].'<br />';

	preg_match_all("/class=\"item\".*?count\">(.*?)<.*?name\">(.*?)<.*?price=\"(.*?)\">(.*?)</",$_POST['order'],$a);
	$order='<table><tr><td>Кол-во</td><td>Товар</td><td>Цена</td><td>Стоимость</td></tr>';
	for ($i=0;$i<count($a[0]);$i++)
	$order.='<tr><td>'.$a[1][$i].'</td><td>'.$a[2][$i].'</td><td>'.$a[3][$i].'</td><td>'.$a[4][$i].'</td></tr>';

	if (preg_match("/<div class=\"h2\">.*?class=\"right\">(.*?)</s",$_POST['order'],$a))
	$order.='<tr><td colspan="3">Налог</td><td>'.$a[1].'</td></tr>';

	if (preg_match("/<div class=\"h3\">.*?class=\"right\">(.*?)</s",$_POST['order'],$a))
	$order.='<tr><td colspan="3">Итого</td><td>'.$a[1].'</td></tr>';

	$order.='</table>';

	$message.='<br />Заказ: <br />'.$order;

	$file_order = date("YmdHis").'.order';
	$handle = fopen($path_orders.$file_order, 'w');
	fwrite($handle, $message);
	fclose($handle);

	if (pismo(MAIL_TO, MAIL_SUBJECT, $message))
	echo 'Спасибо! Ваше сообщение отправлено!';
	else
	echo 'Ошибка! Ваше заказ не отправлен!';
}

?>