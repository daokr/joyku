<?php
function addslashes_deep($value) {
    $value = is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    return $value;
}
//预定义的字符转换为 HTML 实体 shtmlspecialchars('<div>ddd</div>'); output:&lt;div&gt;ddd&lt;/div&gt;
function shtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = shtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
				str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}
// 预定义字符前添加反斜杠 <div class="news"></div> :output:<div class=\"news\">charm</div>
function saddslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = saddslashes($val);
		}
	} else {
		$string = addslashes($string);
	}
	return $string;
}
//将数组加上单引号,并整理成串 simplode(array('id'=>'1','name'=>'charm')); echo  '1','charm'
function simplode($sarr, $comma=',') {
	return '\''.implode('\''.$comma.'\'', $sarr).'\'';
}
//数组转换成字串 arrayeval(array('name'=>'abc','id'=>123)); output: Array ('name' => 'abc','id' => 123)
function arrayeval($array, $level = 0) {
	$space = '';
	$evaluate = "Array $space(";
	$comma = $space;
	foreach($array as $key => $val) {
		$key = is_string($key) ? '\''.addcslashes($key, '\'\\').'\'' : $key;
		$val = !is_array($val) && (!preg_match("/^\-?\d+$/", $val) || strlen($val) > 12) ? '\''.addcslashes($val, '\'\\').'\'' : $val;
		if(is_array($val)) {
			$evaluate .= "$comma$key => ".arrayeval($val, $level + 1);
		} else {
			$evaluate .= "$comma$key => $val";
		}
		$comma = ",$space";
	}
	$evaluate .= "$space)";
	return $evaluate;
}
function stripslashes_deep($value) {
    if (is_array($value)) {
        $value = array_map('stripslashes_deep', $value);
    } elseif (is_object($value)) {
        $vars = get_object_vars($value);
        foreach ($vars as $key => $data) {
            $value->{$key} = stripslashes_deep($data);
        }
    } else {
        $value = stripslashes($value);
    }

    return $value;
}

function todaytime() {
    return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
}
//替换字符串中的特殊字符
//去掉指定字符串中\\或\'前的\
function sstripslashes($string) {

	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = sstripslashes($val);
		}
	} else {
		$string = stripslashes($string);
	}
	return $string;
}
//br 替换
function striptbr($text) {
	$text = preg_replace("/(\r\n|\r|\n)/s", '*', $text);
	$text = str_replace('**', '*', $text);
	return $text;
}
//去除空格
function strim($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = strim($val);
		}
	} else {
		$string = trim($string);
	}
	return $string;
}
//按规则替换
function stringreplace($replace, $replaceto, $message) {
	if(is_array($replace)) {
		foreach($replace as $key => $val) {
			$message = stringreplace($val, $replaceto[$key], $message);
		}
	} else {
		if(!empty($replace)) {
			$rule = convertrule($replace);
			if(strpos($replaceto, '[string]') === false) {
				$replacestr = $replaceto;
			} else {
				$replacestr = str_replace('[string]', "\${1}", $replaceto);
			}
			$message = preg_replace("/($rule)/s", $replacestr, $message);
		}
	}
	return $message;
}
/**
 * 友好时间
 */
function fdate($time) {
    if (!$time)
        return false;
    $fdate = '';
    $d = time() - intval($time);
    $ld = $time - mktime(0, 0, 0, 0, 0, date('Y')); //年
    $md = $time - mktime(0, 0, 0, date('m'), 0, date('Y')); //月
    $byd = $time - mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')); //前天
    $yd = $time - mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')); //昨天
    $dd = $time - mktime(0, 0, 0, date('m'), date('d'), date('Y')); //今天
    $td = $time - mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')); //明天
    $atd = $time - mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')); //后天
    if ($d == 0) {
        $fdate = '刚刚';
    } else {
        switch ($d) {
            case $d < $atd:
                $fdate = date('Y年m月d日', $time);
                break;
            case $d < $td:
                $fdate = '后天' . date('H:i', $time);
                break;
            case $d < 0:
                $fdate = '明天' . date('H:i', $time);
                break;
            case $d < 60:
                $fdate = $d . '秒前';
                break;
            case $d < 3600:
                $fdate = floor($d / 60) . '分钟前';
                break;
            case $d < $dd:
                $fdate = floor($d / 3600) . '小时前';
                break;
            case $d < $yd:
                $fdate = '昨天' . date('H:i', $time);
                break;
            case $d < $byd:
                $fdate = '前天' . date('H:i', $time);
                break;
            case $d < $md:
                $fdate = date('m月d H:i', $time);
                break;
            case $d < $ld:
                $fdate = date('m月d', $time);
                break;
            default:
                $fdate = date('Y年m月d日', $time);
                break;
        }
    }
    return $fdate;
}
//处理时间的函数
function getTime($btime, $etime) {

	if ($btime < $etime) {
		$stime = $btime;
		$endtime = $etime;
	} else {
		$stime = $etime;
		$endtime = $btime;
	}
	$timec = $endtime - $stime;
	$days = intval ( $timec / 86400 );
	$rtime = $timec % 86400;
	$hours = intval ( $rtime / 3600 );
	$rtime = $rtime % 3600;
	$mins = intval ( $rtime / 60 );
	$secs = $rtime % 60;
	if ($days >= 1) {
		return $days . ' 天前';
	}
	if ($hours >= 1) {
		return $hours . ' 小时前';
	}

	if ($mins >= 1) {
		return $mins . ' 分钟前';
	}
	if ($secs >= 1) {
		return $secs . ' 秒前';
	}

}
/**
 * 获取用户头像
 */
function avatar($uid, $size) {
    $avatar_size = explode(',', C('ik_avatar_size'));
    $size = in_array($size, $avatar_size) ? $size : '100';
    $avatar_dir = avatar_dir($uid);
    $avatar_file = $avatar_dir . md5($uid) . "_{$size}_{$size}.jpg";
    if (!is_file(C('ik_attach_path') . 'face/' . $avatar_file)) {
        $avatar_file = "user_{$size}.jpg";
    }
    return __ROOT__ . '/' . C('ik_attach_path') . 'face/' . $avatar_file.'?v='.time();
}

function avatar_dir($uid) {
    $uid = abs(intval($uid));
    $suid = sprintf("%09d", $uid);
    $dir1 = substr($suid, 0, 3);
    $dir2 = substr($suid, 3, 2);
    $dir3 = substr($suid, 5, 2);
    return $dir1 . '/' . $dir2 . '/' . $dir3 . '/';
}

function attach($attach) {
    if (false === strpos($attach, 'http://')) {
        //本地附件
        return __ROOT__ . '/' . C('ik_attach_path') . $attach.'?v='.time();
        //远程附件
        //todo...
    } else {
        //URL链接
        return $attach;
    }
}

/*
 * 获取缩略图
 */

function get_thumb($img, $suffix = '_thumb') {
    if (false === strpos($img, 'http://')) {
        $ext = array_pop(explode('.', $img));
        $thumb = str_replace('.' . $ext, $suffix . '.' . $ext, $img);
    } else {
        if (false !== strpos($img, 'taobaocdn.com') || false !== strpos($img, 'taobao.com')) {
            //淘宝图片 _s _m _b
            switch ($suffix) {
                case '_s':
                    $thumb = $img . '_100x100.jpg';
                    break;
                case '_m':
                    $thumb = $img . '_210x1000.jpg';
                    break;
                case '_b':
                    $thumb = $img . '_480x480.jpg';
                    break;
            }
        }
    }
    return $thumb;
}

/**
 * 对象转换成数组
 */
function object_to_array($obj) {
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val) {
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}
//过滤脚本代码
function cleanJs($text) {
	$text = trim ( $text );
	$text = stripslashes ( $text );
	//完全过滤注释
	$text = preg_replace ( '/<!--?.*-->/', '', $text );
	//完全过滤动态代码


	$text = preg_replace ( '/<\?|\?>/', '', $text );

	//完全过滤js
	$text = preg_replace ( '/<script?.*\/script>/', '', $text );
	//过滤多余html
	$text = preg_replace ( '/<\/?(html|head|meta|link|base|body|title|style|script|form|iframe|frame|frameset)[^><]*>/i', '', $text );
	//过滤on事件lang js
	while ( preg_match ( '/(<[^><]+)(lang|onfinish|onmouse|onexit|onerror|onclick|onkey|onload|onchange|onfocus|onblur)[^><]+/i', $text, $mat ) ) {
		$text = str_replace ( $mat [0], $mat [1], $text );
	}
	while ( preg_match ( '/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i', $text, $mat ) ) {
		$text = str_replace ( $mat [0], $mat [1] . $mat [3], $text );
	}
	return $text;
}
//纯文本输入
function t($text) {
	$text = cleanJs ( $text );
	//彻底过滤空格BY xiomai
	$text = preg_replace ( '/\s(?=\s)/', '', $text );
	$text = preg_replace ( '/[\n\r\t]/', ' ', $text );
	$text = str_replace ( '  ', ' ', $text );
	$text = str_replace ( ' ', '', $text );
	$text = str_replace ( '&nbsp;', '', $text );
	$text = str_replace ( '&', '', $text );
	$text = str_replace ( '=', '', $text );
	$text = str_replace ( '-', '', $text );
	$text = str_replace ( '#', '', $text );
	$text = str_replace ( '%', '', $text );
	$text = str_replace ( '!', '', $text );
	$text = str_replace ( '@', '', $text );
	$text = str_replace ( '^', '', $text );
	$text = str_replace ( '*', '', $text );
	$text = str_replace ( 'amp;', '', $text );

	$text = strip_tags ( $text );
	$text = htmlspecialchars ( $text );
	$text = str_replace ( "'", "", $text );
	return $text;
}
//主要针对输出的内容，对动态脚本，静态html，动态语言全部通吃
function hview($text) {
	$text = stripslashes ( $text ); //删除反斜杠
	$text = nl2br ( $text );
	return $text;
}
//utf-8截取
function getsubstrutf8($string, $start = 0, $sublen, $append = true) {
	$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
	preg_match_all ( $pa, $string, $t_string );
	if (count ( $t_string [0] ) - $start > $sublen && $append == true) {
		return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) . "...";
	} else {
		return join ( '', array_slice ( $t_string [0], $start, $sublen ) );
	}
}
/**
 * 转换为安全的html文本
 */
function h($text){

	$text = htmlspecialchars($text, ENT_NOQUOTES, 'UTF-8');
	$text = nl2br ( $text );
	return $text;
}
// ik专用解析输出第一张图片
function ikhtml_img($type,$typeid,$content){
	//图片
	$arr_photo = array();
	//匹配本地图片
	$strcontent = $content;
	preg_match_all ( '/\[(图片)(\d+)\]/is', $strcontent, $photos );
	if(!empty($photos [2])){
		$strPhoto = D('images')->getImageByseqid($type,$typeid,$photos [2][0]);
		return $strPhoto;
	}else{
		return;
	}	
}
function ikhtml_text($type,$typeid,$content){
	//图片
	$arr_photo = array();
	//匹配本地图片
	$strcontent = $content;	
	preg_match_all ( '/\[(图片)(\d+)\]/is', $strcontent, $photos );		
	foreach ($photos [2] as $key=>$item) {
		$strPhoto = D('images')->getImageByseqid($type,$typeid,$item);
		$arr_photo[$key] = $strPhoto['mimg'];
		
		$htmlTpl = '';

		$strcontent = str_replace ( '[图片'.$item.']', $htmlTpl, $strcontent );
	}
	//匹配链接
	preg_match_all ( '/\[(url)=([http|https|ftp]+:\/\/[a-zA-Z0-9\.\-\?\=\_\&amp;\/\'\`\%\:\@\^\+\,\.]+)\]([^\[]+)(\[\/url\])/is',
	$strcontent, $contenturl);
	foreach($contenturl[2] as $c1)
	{
		$strcontent = str_replace ( "[url={$c1}]", '', $strcontent);
		$strcontent = str_replace ( "[/url]", '', $strcontent);
	}
	//匹配视频
	preg_match_all ( '/\[(视频)(\d+)\]/is', $strcontent, $videos );
	foreach ($videos[2] as $vitem)
	{
		$htmlTpl = '';
		$strcontent = str_replace ( '[视频'.$vitem.']', $htmlTpl, $strcontent );
	}
	return $strcontent;	
}
// ik专用解析输出内容
function ikhtml($type,$typeid,$content,$isformat = '0'){
	//图片
	$arr_photo = array();
	//匹配本地图片
	$strcontent = $content;	
	//是否开启格式化内容
	if($isformat =='1'){
		$strcontent = str_replace(' ', '&nbsp;', $strcontent);
	}
	preg_match_all ( '/\[(图片)(\d+)\]/is', $strcontent, $photos );		
	foreach ($photos [2] as $key=>$item) {
		$strPhoto = D('images')->getImageByseqid($type,$typeid,$item);
		$arr_photo[$key] = $strPhoto['mimg'];
		
		$htmlTpl = '<div class="img_'.$strPhoto['align'].'">
						<a href="'.$strPhoto['bimg'].'" target="_blank" title="点击查看原图"><img alt="'.$strPhoto['title'].'" src="'.$strPhoto['mimg'].'"  title="点击查看原图"/></a>
						<span class="img_title" >'.$strPhoto['title'].'</span>
					</div><div class="clear"></div>';

		$strcontent = str_replace ( '[图片'.$item.']', $htmlTpl, $strcontent );
	}
	//匹配链接
	preg_match_all ( '/\[(url)=([http|https|ftp]+:\/\/[a-zA-Z0-9\.\-\?\=\_\&amp;\/\'\`\%\:\@\^\+\,\.]+)\]([^\[]+)(\[\/url\])/is',
	$strcontent, $contenturl);
	foreach($contenturl[2] as $c1)
	{
		$strcontent = str_replace ( "[url={$c1}]", '<a href="'.$c1.'" target="_blank">', $strcontent);
		$strcontent = str_replace ( "[/url]", '</a>', $strcontent);
	}
	//匹配视频
	preg_match_all ( '/\[(视频)(\d+)\]/is', $strcontent, $videos );
	foreach ($videos[2] as $vitem)
	{
		$strVideo =  D('videos')->getVideoByseqid($type,$typeid,$vitem);;
		$videohtml = ikVideo($strVideo['videourl'],$strVideo['title']);
		$strcontent = str_replace ( '[视频'.$vitem.']', $videohtml, $strcontent );
	}

	return $strcontent;
}
//生成随机数(1数字,0字母数字组合)
function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' ? mt_srand ( ( double ) microtime () * 1000000 ) : mt_srand ();
	$seed = base_convert ( md5 ( print_r ( $_SERVER, 1 ) . microtime () ), 16, $numeric ? 10 : 35 );
	$seed = $numeric ? (str_replace ( '0', '', $seed ) . '012340567890') : ($seed . 'zZ' . strtoupper ( $seed ));
	$hash = '';
	$max = strlen ( $seed ) - 1;
	for($i = 0; $i < $length; $i ++) {
		$hash .= $seed [mt_rand ( 0, $max )];
	}
	return $hash;
}

//格式化时间
function sgmdate($timestamp, $dateformat='', $format=0) {
	if(empty($dateformat)) {
		$dateformat = 'Y-m-d H:i:s';
	}
	if(empty($timestamp)) {
		$timestamp = time();
	}
	$result = '';
	if($format) {
		$time = time() - $timestamp;
		if($time > 24*3600) {
			$result = gmdate($dateformat, $timestamp + C('ik_timezone') * 3600);
		} elseif ($time > 3600) {
			$result = intval($time/3600).'小时前';
		} elseif ($time > 60) {
			$result = intval($time/60).'分钟前';
		} elseif ($time > 0) {
			$result = $time.'秒前';
		} else {
			$result = '现在';
		}
	} else {
		$result = gmdate($dateformat, $timestamp + C('ik_timezone') * 3600);
	}
	return $result;
}
//IKPHP 小麦专用格式化星期几 
function getWeekName($data,$format = '星期')
{
	$week   =  date( "D ",$data); 
	switch($week) 
	{ 
		case "Mon ": 
			$current   =   $format."一"; 
			break; 
		case "Tue ": 
			$current   =   $format."二"; 
			break; 
		case "Wed ": 
			$current   =   $format."三"; 
			break; 
		case "Thu ": 
			$current   =   $format."四"; 
			break; 
		case "Fri ": 
			$current   =   $format."五"; 
			break; 
		case "Sat ": 
			$current   =   $format."六"; 
			break; 
		case "Sun ": 
			$current   =   $format."日"; 
			break; 
	} 
	return $current;
}
//获取文件名后缀
function fileext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1)));
}
/**
 * IKPHP专用上传 上传本地文件
 * @author 小麦
 * @access public
 * @param string $filearr 文件
 * @param string $savepath 存放图片的目录
 * @param string $thumb 缩略图可以是数组或者字符串逗号分隔
 * @param string $objfile 对象文件名
 * @param string $havethumb 是否生成缩略图 默认生成 1
 * @return void
 */
function savelocalfile($filearr, $savepath='', $thumb='', $arrext='',  $save_rule='', $objfile='', $havethumb=1) {

	if(empty($filearr) || empty($savepath)){
		return array('error'=>'请选择要上传的文件！');
	}
	$patharr = $deault = array();
	//debug 传入参数
	$filename = strip_tags($filearr['name']);
	$tmpname = str_replace('\\', '\\\\', $filearr['tmp_name']);

	//debug 文件后缀
	$ext = fileext($filename) == 'gif' ? 'jpg': fileext($filename);
	$patharr['name'] = addslashes($filename);
	$patharr['type'] = $ext;
	$patharr['size'] = $filearr['size'];
	if($patharr['size']/1024 > C('ik_attr_allow_size')){
		return array('error'=>'您上传的图片大小是：'.round($patharr['size']/1024).'文件不超过'.C('ik_attr_allow_size').'KB');
	}
	//debug 文件名
	if($objfile) {
		$newfilename = $objfile;
		$isimage = 0;
		$patharr['file'] = $patharr['thumb'] = $objfile;
	} else {
		if(empty($arrext)) $arrext = array('jpg', 'jpeg', 'gif', 'png');
		if(in_array($ext, $arrext)) {
			$imageinfo = @getimagesize($tmpname);
			list($width, $height, $type) = !empty($imageinfo) ? $imageinfo : array('', '', '');
			if(!in_array($type, array(1,2,3,6,13))) {
				return $deault;
			}
			$isimage = 1;
		} else {
			//$isimage = 0;
			//$ext = 'attach';
			return array('error'=>'您上传的图片类型不对！');
		}
		//文件名称
		if(empty($save_rule)){
			$filemain = sgmdate(time(), 'YmdHis').random(4);
		}else{
			$filemain = $save_rule;
		}
		
		//得到存储目录
		$dirpath = getattachdir($savepath);
		$patharr['filename'] = $filemain.'.'.$ext;
		$patharr['file'] = $dirpath.'/'.$filemain.'.'.$ext;
		$patharr['path'] = $dirpath.'/';
		//上传
		$newfilename = C('ik_attach_path').$patharr['file'];
	}
	if(@copy($tmpname, $newfilename)) {
	} elseif((function_exists('move_uploaded_file') && @move_uploaded_file($tmpname, $newfilename))) {
	} elseif(@rename($tmpname, $newfilename)) {
	} else {
		return $deault;
	}
	@unlink($tmpname);
	
	//debug 缩略图水印
	if($isimage && empty($objfile)) {
		//缩略图
		if($havethumb == 1) {
			// 如果$thumb是字符串			
			if(is_array($thumb)){
				$arrThumbWidth = explode(',',$thumb['width']);
				$arrThumbHeight = explode(',',$thumb['height']);
				foreach($arrThumbWidth as $key => $item){
					$patharr['img_'.$item.'_'.$arrThumbHeight[$key]] = makethumb($patharr['file'],array($item,$arrThumbHeight[$key]));
				}
			}
		}
	}
	return $patharr;
}
// 保存远程图片到本地
function saveremotefile($url, $savepath, $thumbarr=array(100, 100), $mkthumb=1, $maxsize=0) {
	
	$patharr = $blank = array('file'=>'', 'thumb'=>'', 'name'=>'', 'type'=>'', 'size'=>0);

	$ext = fileext($url);
	if($ext=='gif'){
		$ext ='jpg';
	}
	if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png'))) {
		$isimage = 1;
	} else {
		$isimage = 1;
		$ext = 'jpg';
		//return false;
	}
	$patharr['type'] = $ext;
	
	//debug 文件名
	$filemain = sgmdate(time(), 'YmdHis').random(4);
	$patharr['filename'] = $filemain.'.'.$ext;

	//debug 得到存储目录
	$dirpath = getattachdir($savepath); //只对文章模型使用
	$patharr['file'] = $dirpath.'/'.$filemain.'.'.$ext;
	$patharr['path'] = $dirpath.'/';
	
	//debug 上传
	$content = sreadfile($url, 'rb', 1, $maxsize);
	if(empty($content)) return $blank;

	
	writefile(C('ik_attach_path').$patharr['file'], $content, 'text', 'wb', 0);
	if(!file_exists(C('ik_attach_path').$patharr['file'])) return $blank;

	$imageinfo = @getimagesize(C('ik_attach_path').$patharr['file']);
	list($width, $height, $type) = !empty($imageinfo) ? $imageinfo : array('', '', '');
	if(!in_array($type, array(1,2,3,6,13))) {
		@unlink(C('ik_attach_path').$patharr['file']);
		return $blank;
	}

	$patharr['size'] = filesize(C('ik_attach_path').$patharr['file']);

	//debug 缩略图水印
	if($isimage) {
		if($mkthumb) {
			//debug 缩略图
			if(is_array($thumbarr)){
				$arrThumbWidth = explode(',',$thumbarr['width']);
				$arrThumbHeight = explode(',',$thumbarr['height']);
				foreach($arrThumbWidth as $key => $item){
					$patharr['img_'.$item.'_'.$arrThumbHeight[$key]] = makethumb($patharr['file'],array($item,$arrThumbHeight[$key]));
				}
			}
			//debug 加水印
			//if(!empty($patharr['thumb'])) makewatermark($patharr['file']);
		}
		
	}

	return $patharr;
}
function filemain($filename) {
	return trim(substr($filename, 0, strrpos($filename, '.')));
}
//生成缩略图
//$cummode 裁剪模式 array；
function makethumb($srcfile, $thumbsizearr = array(100, 100), $dstfile='', $arrcummode='') {
	if(empty($dstfile)) {
		$dstfile = filemain($srcfile).'_'.$thumbsizearr[0].'_'.$thumbsizearr[1].'.jpg';//自建立缩略图
		$srcfile_file = C('ik_attach_path').$srcfile;
		$dstfile_file = C('ik_attach_path').$dstfile;
	} else {
		$srcfile_file = C('ik_attach_path').$srcfile;
		$dstfile_file = C('ik_attach_path').$dstfile;
	}
	if (!file_exists($srcfile_file)) {
		return '';
	}

	$opnotkeepscale = 4;
	$opbestresizew = 8;
	$opbestresizeh = 16;
	//默认系统模式
	if(empty($arrcummode)){
		$_IKIMAGECONFIG = array(
				'thumbcutmode' => 2, // 裁剪模式  0是默认模式     1左或上剪切模式    2中间剪切模式    3右或下剪切模式
				'thumbcutstartx' => 0, //x 坐标
				'thumbcutstarty' => 0, //y 坐标
				'thumboption' => 8, //8 宽度最佳缩放  4 综合最佳缩放 16 高度最佳缩放
		);
		
	}else{
		
		$_IKIMAGECONFIG = $arrcummode;
	}

	$option = $_IKIMAGECONFIG['thumboption'];
	$cutmode = $_IKIMAGECONFIG['thumbcutmode'];
	$startx = $_IKIMAGECONFIG['thumbcutstartx']; 
	$starty = $_IKIMAGECONFIG['thumbcutstarty'];
	$dstW = intval($thumbsizearr[0]);
	$dstH = intval($thumbsizearr[1]);
	if($dstW<20) $dstW = 100;
	if($dstH<20) $dstH = 100;

	$imgtype = array(1=>'gif', 2=>'jpeg', 3=>'png');

	$func_output = 'ImageJpeg';
	if (!function_exists ($func_output)) {
		return '';
	}

	$data = @getimagesize($srcfile_file);
	//是否切割gif 默认允许
/* 	if(!empty($data) && is_array($data) && $data[2] != 1 && $data['mime'] != 'image/gif') {
	} else {
		return '';
	} */

	$func_create = "imagecreatefrom".$imgtype[$data[2]];
	if (!function_exists ($func_create)) {
		return '';
	}

	$im = @$func_create($srcfile_file);
	$srcW = @imagesx($im);
	$srcH = @imagesy($im);
	$srcX = 0;
	$srcY = 0;
	$dstX = 0;
	$dstY = 0;

	//SIZE
	if($srcW < $dstW) $dstW = $srcW;
	if($srcH < $dstH) $dstH = $srcH;

	if ($option & $opbestresizew) {
		$dstH = round($dstW * $srcH / $srcW);
	}
	if ($option & $opbestresizeh) {
		$dstW = round($dstH * $srcW / $srcH);
	}

	$fdstW = $dstW;
	$fdstH = $dstH;

	//CUT
	if ($cutmode != 0) {
		$srcW -= $startx;
		$srcH -= $starty;
		if ($srcW*$dstH > $srcH*$dstW) {
			$testW = round($dstW * $srcH / $dstH);
			$testH = $srcH;
		} else {
			$testH = round($dstH * $srcW / $dstW);
			$testW = $srcW;
		}
		switch ($cutmode) {
			case 1: $srcX = 0; $srcY = 0;
			break;
			case 2: $srcX = round(($srcW - $testW) / 2);
			$srcY = round(($srcH - $testH) / 2);
			break;
			case 3: $srcX = $srcW - $testW;
			$srcY = $srcH - $testH;
			break;
		}
		$srcW = $testW;
		$srcH = $testH;
		$srcX += $startx;
		$srcY += $starty;
		//小麦修改 截图
		if($cutmode==4){
			$srcX = $startx;
			$srcY = $starty;
			$fdstW = $dstW;
			$fdstH = $dstH;
			$srcW = $_IKIMAGECONFIG['thumbcutW'];
			$srcH = $_IKIMAGECONFIG['thumbcutH'];
		}
	} else {
		if (!($option & $opnotkeepscale)) {
			if ($srcW*$dstH > $srcH*$dstW) {
				$fdstH = round($srcH*$dstW/$srcW);
				$dstY = floor(($dstH-$fdstH)/2);
				$fdstW = $dstW;
			} else {
				$fdstW = round($srcW*$dstH/$srcH);
				$dstX = floor(($dstW-$fdstW)/2);
				$fdstH = $dstH;
			}
			$dstX=($dstX<0)?0:$dstX;
			$dstY=($dstX<0)?0:$dstY;
			$dstX=($dstX>($dstW/2))?floor($dstW/2):$dstX;
			$dstY=($dstY>($dstH/2))?floor($dstH/s):$dstY;
		}
	}

	if(function_exists("imagecopyresampled") and function_exists("imagecreatetruecolor")) {
		$func_create = "imagecreatetruecolor";
		$func_resize = "imagecopyresampled";
	} elseif (function_exists("imagecreate") and function_exists("imagecopyresized")) {
		$func_create = "imagecreate";
		$func_resize = "imagecopyresized";
	} else {
		return '';
	}

	$newim = @$func_create($dstW,$dstH);
	$black = @imagecolorallocate($newim, 0,0,0);
	$back = @imagecolortransparent($newim, $black);
	@imagefilledrectangle($newim,0,0,$dstW,$dstH,$black);
	@$func_resize($newim,$im,$dstX,$dstY,$srcX,$srcY,$fdstW,$fdstH,$srcW,$srcH);
	@$func_output($newim, $dstfile_file);
	@imagedestroy($im);
	@imagedestroy($newim);

	if(!file_exists($dstfile_file)) {
		return '';
	}

	return $dstfile;
}
// 获取目录
function getattachdir($dirpatharr) {
	$dirs = C('ik_attach_path');
	$subarr = array();
	$dirarr = explode('/', $dirpatharr);
	foreach ($dirarr as $value) {
		$dirs .= '/'.$value;
		if(smkdir($dirs)) {
			$subarr[] = $value;
		} else {
			break;
		}
	}
	return implode('/', $subarr);
}
// 生成目录
function smkdir($dirname, $ismkindex=1) {
	$mkdir = false;
	if(!is_dir($dirname)) {
		if(@mkdir($dirname, 0777)) {
			if($ismkindex) {
				@fclose(@fopen($dirname.'/index.htm', 'w'));
			}
			$mkdir = true;
		}
	} else {
		$mkdir = true;
	}
	return $mkdir;
}
//初始化 url
function initurl($url) {

	$newurl = '';
	$blanks = array('url'=>'');
	$urls = $blanks;

	if(strlen($url)<10) return $blanks;
	$urls = @parse_url($url);
	if(empty($urls) || !is_array($urls)) return $blanks;
	if(empty($urls['scheme'])) return $blanks;
	if($urls['scheme'] == 'file') return $blanks;

	if(empty($urls['path'])) $urls['path'] = '/';
	$newurl .= $urls['scheme'].'://';
	$newurl .= empty($urls['user'])?'':$urls['user'];
	$newurl .= empty($urls['pass'])?'':':'.$urls['pass'];
	$newurl .= empty($urls['host'])?'':((!empty($urls['user']) || !empty($urls['pass']))?'@':'').$urls['host'];
	$newurl .= empty($urls['port'])?'':':'.$urls['port'];
	$newurl .= empty($urls['path'])?'':$urls['path'];
	$newurl .= empty($urls['query'])?'':'?'.$urls['query'];
	$newurl .= empty($urls['fragment'])?'':'#'.$urls['fragment'];

	$urls['port'] = empty($urls['port'])?'80':$urls['port'];
	$urls['url'] = $newurl;

	return $urls;
}
function strexists($haystack, $needle) {
	return !(strpos($haystack, $needle) === FALSE);
}
//读文件 借用 super site 的方法
function sreadfile($filename, $mode='r', $remote=0, $maxsize=0, $jumpnum=0) {
	if($jumpnum > 5) return '';
	$contents = '';

	if($remote) {
		$httpstas = '';
		$urls = initurl($filename);
		if(empty($urls['url'])) return '';

		$fp = @fsockopen($urls['host'], $urls['port'], $errno, $errstr, 20);
		if($fp) {
			if(!empty($urls['query'])) {
				fputs($fp, "GET $urls[path]?$urls[query] HTTP/1.1\r\n");
			} else {
				fputs($fp, "GET $urls[path] HTTP/1.1\r\n");
			}
			fputs($fp, "Host: $urls[host]\r\n");
			fputs($fp, "Accept: */*\r\n");
			fputs($fp, "Referer: $urls[url]\r\n");
			fputs($fp, "User-Agent: Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)\r\n");
			fputs($fp, "Pragma: no-cache\r\n");
			fputs($fp, "Cache-Control: no-cache\r\n");
			fputs($fp, "Connection: Close\r\n\r\n");

			$httpstas = explode(" ", fgets($fp, 128));
			if($httpstas[1] == 302 || $httpstas[1] == 302) {
				$jumpurl = explode(" ", fgets($fp, 128));
				return sreadfile(trim($jumpurl[1]), 'r', 1, 0, ++$jumpnum);
			} elseif($httpstas[1] != 200) {
				fclose($fp);
				return '';
			}

			$length = 0;
			$size = 1024;
			while (!feof($fp)) {
				$line = trim(fgets($fp, 128));
				$size = $size + 128;
				if(empty($line)) break;
				if(strexists($line, 'Content-Length')) {
					$length = intval(trim(str_replace('Content-Length:', '', $line)));
					if(!empty($maxsize) && $length > $maxsize) {
						fclose($fp);
						return '';
					}
				}
				if(!empty($maxsize) && $size > $maxsize) {
					fclose($fp);
					return '';
				}
			}
			fclose($fp);

			if(@$handle = fopen($urls['url'], $mode)) {
				if(function_exists('stream_get_contents')) {
					$contents = stream_get_contents($handle);
				} else {
					$contents = '';
					while (!feof($handle)) {
						$contents .= fread($handle, 8192);
					}
				}
				fclose($handle);
			} elseif(@$ch = curl_init()) {
				curl_setopt($ch, CURLOPT_URL, $urls['url']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);//timeout
				$contents = curl_exec($ch);
				curl_close($ch);
			} else {
				//无法远程上传
			}
		}
	} else {
		if(@$handle = fopen($filename, $mode)) {
			$contents = fread($handle, filesize($filename));
			fclose($handle);
		}
	}

	return $contents;
}
//格式化路径
function srealpath($path) {
	$path = str_replace('./', '', $path);
	if(DIRECTORY_SEPARATOR == '\\') {
		$path = str_replace('/', '\\', $path);
	} elseif(DIRECTORY_SEPARATOR == '/') {
		$path = str_replace('\\', '/', $path);
	}
	return $path;
}
//写文件 借用 super site 的方法
function writefile($filename, $writetext, $filemod='text', $openmod='w', $eixt=1) {
	if(!@$fp = fopen($filename, $openmod)) {
		if($eixt) {
			exit('File :<br>'.srealpath($filename).'<br>Have no access to write!');
		} else {
			return false;
		}
	} else {
		$text = '';
		if($filemod == 'php') {
			$text = "<?php\r\n\r\nif(!defined('IN_IK')) exit('Access Denied');\r\n\r\n";
		}
		$text .= $writetext;
		if($filemod == 'php') {
			$text .= "\r\n\r\n?>";
		}
		flock($fp, 2);
		fwrite($fp, $text);
		fclose($fp);
		return true;
	}
}
//小麦 格式化时间 修改时间 2013年 3月27日 用法如下：
//echo sstrtotime('2013-03-21 00:36:56'); //输出：1363797416
//echo date('Y-m-d H:m:s','1363797416');//输出：2013-03-21 00:36:56
function sstrtotime($timestamp) {
	global $_SCONFIG;

	$timestamp = trim($timestamp);
	if(empty($timestamp)) return 0;
	$hour = $minute = $second = $month = $day = $year = 0;
	$exparr = $timearr = array();
	if(strpos($timestamp, ' ') !== false && strpos($timestamp, '-') !== false) {
		$timearr = explode(' ', $timestamp);
		$exparr = explode('-', $timearr[0]);
		$year = empty($exparr[0])?0:intval($exparr[0]);
		$month = empty($exparr[1])?0:intval($exparr[1]);
		$day = empty($exparr[2])?0:intval($exparr[2]);
		$exparr = explode(':', $timearr[1]);
		$hour = empty($exparr[0])?0:intval($exparr[0]);
		$minute = empty($exparr[1])?0:intval($exparr[1]);
		$second = empty($exparr[2])?0:intval($exparr[2]);
	} elseif(strpos($timestamp, '-') !== false && strpos($timestamp, ' ') === false) {
		$exparr = explode('-', $timestamp);
		$year = empty($exparr[0])?0:intval($exparr[0]);
		$month = empty($exparr[1])?0:intval($exparr[1]);
		$day = empty($exparr[2])?0:intval($exparr[2]);
	} elseif(!strpos($timestamp, '-') === false && strpos($timestamp, ' ') !== false) {
		$exparr = explode(':', $timestamp);
		$hour = empty($exparr[0])?0:intval($exparr[0]);
		$minute = empty($exparr[1])?0:intval($exparr[1]);
		$second = empty($exparr[2])?0:intval($exparr[2]);
	} else {
		return 0;
	}
	return gmmktime($hour, $minute, $second, $month, $day, $year) - C('ik_timezone') * 3600;
}
//去掉数组中重复值
function sarray_unique($array) {
	$newarray = array();
	if(!empty($array) && is_array($array)) {
		$array = array_unique($array);
		foreach ($array as $value) {
			$newarray[] = $value;
		}
	}
	return $newarray;
}
//IKPHP专用过滤违禁词语
function ikwords($content){
	$badwords = F('badwords');
	if(!empty($badwords) && is_array($badwords)) {
		$content = @preg_replace($badwords['find'], $badwords['replace'], $content);
	}
	return $content;
}
//中文转拼音
function Pinyin($_String, $_Code='UTF8'){ //GBK页面可改为gb2312，其他随意填写为UTF8
	$_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".
			"|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".
			"cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".
			"|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".
			"|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".
			"|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".
			"|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".
			"|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".
			"|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".
			"|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".
			"|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".
			"she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".
			"tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".
			"|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".
			"|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".
			"zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
	$_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".
			"|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".
			"|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".
			"|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".
			"|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".
			"|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".
			"|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".
			"|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".
			"|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".
			"|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".
			"|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".
			"|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".
			"|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".
			"|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".
			"|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".
			"|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".
			"|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".
			"|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".
			"|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".
			"|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".
			"|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".
			"|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".
			"|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".
			"|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".
			"|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".
			"|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".
			"|-10270|-10262|-10260|-10256|-10254";
	$_TDataKey   = explode('|', $_DataKey);
	$_TDataValue = explode('|', $_DataValue);
	$_Data = array_combine($_TDataKey, $_TDataValue);
	arsort($_Data);
	reset($_Data);
	if($_Code!= 'gb2312') $_String = _U2_Utf8_Gb($_String);
	$_Res = '';
	for($i=0; $i<strlen($_String); $i++) {
		$_P = ord(substr($_String, $i, 1));
		if($_P>160) {
			$_Q = ord(substr($_String, ++$i, 1)); $_P = $_P*256 + $_Q - 65536;
		}
		$_Res .= _Pinyin($_P, $_Data);
	}
	return preg_replace("/[^a-z0-9]*/", '', $_Res);
}
function _Pinyin($_Num, $_Data){
	if($_Num>0 && $_Num<160 ){
		return chr($_Num);
	}elseif($_Num<-20319 || $_Num>-10247){
		return '';
	}else{
		foreach($_Data as $k=>$v){
			if($v<=$_Num) break;
		}
		return $k;
	}
}
function _U2_Utf8_Gb($_C){
	$_String = '';
	if($_C < 0x80){
		$_String .= $_C;
	}elseif($_C < 0x800) {
		$_String .= chr(0xC0 | $_C>>6);
		$_String .= chr(0x80 | $_C & 0x3F);
	}elseif($_C < 0x10000){
		$_String .= chr(0xE0 | $_C>>12);
		$_String .= chr(0x80 | $_C>>6 & 0x3F);
		$_String .= chr(0x80 | $_C & 0x3F);
	}elseif($_C < 0x200000) {
		$_String .= chr(0xF0 | $_C>>18);
		$_String .= chr(0x80 | $_C>>12 & 0x3F);
		$_String .= chr(0x80 | $_C>>6 & 0x3F);
		$_String .= chr(0x80 | $_C & 0x3F);
	}
	return iconv('UTF-8', 'GB2312', $_String);
}
//修改人 小麦 QQ:160780470
/*
 *  视频采集
*  //$link = 'http://www.56.com/u64/v_NzQ3MjI3MDE.html';
//$host = '56.com';
//$link = 'http://v.ku6.com/show/whfdQ21lW4Td-MZR4XYCxQ...html';
//$host = 'ku6.com';
//$link = 'http://www.tudou.com/programs/view/Tq-tNnWtI4M/?fr=rec2';//http://www.tudou.com/programs/view/_ke1lzCnBYw/
//$host = 'tudou.com';
//$host = 'youku.com';
//$link = 'http://v.youku.com/v_show/id_XMzIxODkzMTIw.html';
* */
function getVideoInfo($link) {
	$host = '';
	preg_match_all ( "/(\w+)\.com/", $link, $host);
	$host = $host[1][0].'.com';

	$return = array ();
	if ('youku.com' == $host) {
		//分析视频网址，获取视频编码号
		preg_match_all ( "/id\_(\w+)[\=|.html]/", $link, $matches );
		if (! empty ( $matches [1] [0] )) {
			$return ['flashvar'] = $matches [1] [0];
		}
		//获取视频页面内容，存与$text中
		$text = file_get_contents ( $link );

		//获取视频标题
		preg_match ( "/<title>(.*?)—(.*)<\/title>/", $text, $title );
		if (! empty ( $title )) {
				
			$return ['title'] = $title [1];
		}

		//视频截图
		preg_match_all ( "/pic=(.*)\" target=\"_blank\"\>/", $text, $imgurl);
		if(!empty($imgurl[1][0]))
		{
			$return['imgurl'] = $imgurl[1][0];
		}

		//视频swf地址 value="http://player.youku.com/player.php/sid/XMzIxODkzMTIw/v.swf"
		preg_match_all ("/value=\"http:\/\/player.youku.com\/player.php\/(.*)\"/", $text, $videourl);
		if(!empty($videourl[1][0]))
		{
			$return['videourl'] = 'http://player.youku.com/player.php/'.$videourl[1][0];
		}


	} elseif ('ku6.com' == $host) {
		// http://v.ku6.com/show/Cev33WkRFavAJwI3nVfU7g...html?nv=1&st=1_8_3

		$text = file_get_contents ( $link );
		//编号
		preg_match_all ( "/show\/(.*)\.html/", $link, $matches );

		if(!empty($matches [1] [0]))
		{
			$return ['flashvar'] = $matches [1] [0];
		}

		preg_match ( "/<title>(.*?) (.*)<\/title>/", $text, $title );
		//视频截图
		preg_match_all ("/cover: \"http:\/\/(.*)\.jpg\"/", $text, $imgurl );

		if (! empty ( $imgurl [1] [0] )) {
			$return ['imgurl'] = 'http://'.$imgurl [1] [0].'.jpg';
		}
		if (! empty ( $title )) {
			$return ['title'] =   mb_convert_encoding( $title [1] , 'UTF-8', 'GBK');
		}
		//视频地址 http://player.ku6.com/refer/Cev33WkRFavAJwI3nVfU7g../v.swf
		preg_match_all ("/value=\"http:\/\/player.youku.com\/player.php\/(.*)\"/", $text, $videourl);
		$return['videourl'] = ' http://player.ku6.com/refer/'.$return ['flashvar'].'/v.swf';
			

	} elseif ('tudou.com' == $host) {

		//http://www.tudou.com/listplay/UHx2FIoEnMA.html 形式1 http://www.tudou.com/l/UHx2FIoEnMA/v.swf
		//http://www.tudou.com/programs/view/_ke1lzCnBYw/ 形式2 http://www.tudou.com/v/Wwa3w2wp4iA/v.swf
		$tudou = file_get_contents ( $link );
		$type = '';

		//视频编号
		preg_match_all ( "/view\/([\w\-]+)\//", $link, $matches );
		if(!empty ( $matches [1] [0] )){
			$type = 2;
			$return ['flashvar'] = $matches [1] [0];
		}else{
			preg_match_all ( "/listplay\/(.*)\.html/", $link, $matches );
			$type = 1 ;
			$return ['flashvar'] = $matches [1] [0];
		}


		//视频标题
		preg_match ( "/<title>(.*?)_(.*)<\/title>/", $tudou, $title );

		//截图 pic:"http://i1.tdimg.com/104/431/668/p.jpg" 二次匹配
		preg_match_all ( "/pic: '(.*)'/", $tudou, $imgurl );
		if(empty($imgurl[1][0]))
		{
			preg_match_all ( "/pic:\"(.*)\"/", $tudou, $imgurl );
		}
		if (! empty ( $imgurl [1] [0] )) {
			$return ['imgurl'] = $imgurl [1] [0];
		}
		if (! empty ( $title )) {
			$return ['title'] = mb_convert_encoding( $title [1] , 'UTF-8', 'GBK');
		}
		//视频swf
		if($type==1)
		{
			$return['videourl'] = 'http://www.tudou.com/l/'.$return ['flashvar'] .'/v.swf';
		}else if($type==2)
		{
			$return['videourl'] = ' http://www.tudou.com/v/'.$return ['flashvar'] .'/v.swf';
		}

	}elseif ('56.com' == $host) {
		$text = file_get_contents ( $link );
		//视频编号http://www.56.com/u64/v_NzQ3MjI3MDE.html
		preg_match_all ( "/\/v\_(.*)\.html/", $link, $matches );

		if(!empty ( $matches [1] [0] )){
			$return ['flashvar'] = $matches [1] [0];
		}

		//视频标题
		preg_match ( "/<title>(.*?)_(.*)<\/title>/", $text, $title );
		if (! empty ( $title )) {
			$return ['title'] = $title [1];
		}
		//视频截图 "img":"http:\/\/img.v41.56.com\/images\/27\/4\/jou1022i56olo56i56.com_sc_135589736151hd.jpg "
		$text = str_replace('\\','',$text);
		preg_match_all ("/\"img\":\"http:\/\/(.*)\.jpg \"/", $text, $imgurl );
		if (! empty ( $imgurl [1] [0] )) {
			$return ['imgurl'] = 'http://'.$imgurl [1] [0].'.jpg';
		}
		//视频地址 http://player.56.com/v_NzQ3MjI3MDE.swf
		$return['videourl'] = ' http://player.56.com/v_'.$return ['flashvar'].'.swf';

	}
	return $return;
}
//显示视频
function ikVideo($videourl,$title='',$w = 500, $h = 400)
{
	$html = '<div align="center"><object width="'.$w.'" height="'.$h.'" data="'.$videourl.'" type="application/x-shockwave-flash"><param name="movie" value="'.$videourl.'"><param value="transparent" name="wmode"><param value="true" name="allowFullScreen"><param value="always" name="allowScriptAccess"><param value="autoplay=1" name="flashvars"></object><p>'.$title.'</p></div>';
	return $html;
}
// ik专用解析输出第一个视频
function ikhtml_video($type,$typeid,$content){
	//匹配
	$strcontent = $content;
	preg_match_all ( '/\[(视频)(\d+)\]/is', $strcontent, $videos );
	if(!empty($videos [2])){
		$str = D('videos')->getVideoByseqid($type,$typeid,$videos [2][0]);
		return $str;
	}else{
		return;
	}
}