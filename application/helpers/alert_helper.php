<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//메세지 출력 후 이동
function alert($msg='', $url='') 
{
	if(!@$url)
	{
		$url = "/";
	}
	echo "
		<script type='text/javascript'>
			alert('".$msg."');
			window.location.replace('".$url."');
		</script>
	";
	exit;
}
//	$('#alert-message').html('".$msg."');
//	$('#alert_modal').modal('".$url."');

// 창닫기
function alert_close($msg) 
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); window.close(); </script>";
	exit;
}

// 경고창 만
function alert_only($msg, $exit=TRUE) 
{
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'> alert('".$msg."'); </script>";
	if ($exit) exit;
}

function replace($url='/') {
	echo "<script type='text/javascript'>";
    if ($url)
        echo "window.location.replace('".$url."');";
	echo "</script>";
	exit;
}
function history_back($msg){
	echo "<script type='text/javascript'>";
	echo "alert('".$msg."');";
    echo "history.back(-1)";
	echo "</script>";
	exit;
}

/* End of file */