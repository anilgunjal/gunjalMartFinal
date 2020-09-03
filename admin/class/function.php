<?php
function multiple_file_upload($folder,$data,$filesize,$allowed_file_type,$unique)
{
	//echo $folder;
	if(!is_dir($folder))
	{
		mkdir($folder,0777);
	}
	
	//pre($data);
	
	//echo $filesize;
	
	$upload_size = array_sum($data['size']);
	
	//echo $upload_size;
	
	if($upload_size>$filesize)
	{
		return "file size large";
	}
	
	//pre($allowed_file_type);
	
	foreach($data['type'] as $type)
	{
		//echo $type;
		$ans = in_array($type,$allowed_file_type);
		//echo $ans;
		
		if($ans!=1)
		{
			return "invalid image";
		}
	}
	
	$cnt=0;
	foreach($data['name'] as $fname)
	{
		$unique_path =  $folder.$unique.$fname;
		//echo $unique_path;
		
		$mainfile[] = $unique_path;
		
		$buff_path = $data['tmp_name'][$cnt];
		//echo $buff_path;
		
		$ans = move_uploaded_file($buff_path,$unique_path);
		
		//echo $ans;
		
		$cnt++;
	}		
	//pre($mainfile);
	return $mainfile;
}

function pre($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}
function renameimage($filename)
{
	$extn = pathinfo($filename, PATHINFO_EXTENSION);
	$img =  basename($filename,".".$extn);
	$uni = mt_rand(10,1000);
	$imgname1 = $img.$uni;
	$ans =  $imgname1.".".$extn;
	return $ans;
}
function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe src=\"//www.youtube.com/embed/$2\" width=\"250\" height=\"150\" allowfullscreen></iframe>",
        $string
    );
}
function videoThumb($link) {
	preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $link, $matches);	
	$last_word = $matches[1];
	return $last_word;
}
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date         = strtotime($date);
    
    // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}

function agingtime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date         = strtotime($date);
    
    // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}

function aging($sdate, $edate)
{
	$date1=new DateTime($sdate);
	$date2=new DateTime($edate);
	$interval = $date1->diff($date2);
	
	return $interval->d.' Days';
}

?>