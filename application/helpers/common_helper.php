<?php
// function generateRandomString($length)
// {
//     $base = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//     $max = strlen($base)-1;
//     $randomString = '';
//     mt_srand((double)microtime()*1000000);
//     while (strlen($randomString)< $length+1)
//         $randomString = $randomString.$base{mt_rand(0, $max)};

//     return $randomString;
// }
// function time_now()
// {
//     $timestampInSeconds = now();

//     $timezone = 'UP45';
//     $daylight_saving = TRUE;

//     $timestampInSeconds= gmt_to_local($timestampInSeconds, $timezone, $daylight_saving);
//     $dateTimeNow= gmdate("Y-m-d H:i:s", $timestampInSeconds);

//     return $dateTimeNow;
// }

// function indent($json) {

//     $tab = "    ";
//     $new_json = "";
//     $indent_level = 0;
//     $in_string = false;

//     $json_obj = json_decode($json);

//     if($json_obj === false)
//         return false;

//     $json = json_encode($json_obj);
//     $len = strlen($json);

//     for($c = 0; $c < $len; $c++)
//     {
//         $char = $json[$c];
//         switch($char)
//         {
//             case '{':
//             case '[':
//                 if(!$in_string)
//                 {
//                     $new_json .= $char . "\n" . str_repeat($tab, $indent_level+1);
//                     $indent_level++;
//                 }
//                 else
//                 {
//                     $new_json .= $char;
//                 }
//                 break;
//             case '}':
//             case ']':
//                 if(!$in_string)
//                 {
//                     $indent_level--;
//                     $new_json .= "\n" . str_repeat($tab, $indent_level) . $char;
//                 }
//                 else
//                 {
//                     $new_json .= $char;
//                 }
//                 break;
//             case ',':
//                 if(!$in_string)
//                 {
//                     $new_json .= ",\n" . str_repeat($tab, $indent_level);
//                 }
//                 else
//                 {
//                     $new_json .= $char;
//                 }
//                 break;
//             case ':':
//                 if(!$in_string)
//                 {
//                     $new_json .= ": ";
//                 }
//                 else
//                 {
//                     $new_json .= $char;
//                 }
//                 break;
//             case '"':
//                 if($c > 0 && $json[$c-1] != '\\')
//                 {
//                     $in_string = !$in_string;
//                 }
//             default:
//                 $new_json .= $char;
//                 break;
//         }
//     }

//     return $new_json;
// }

// function timeDif($from_time,$to_time)
// {

//     $timeDiff=round(abs($to_time - $from_time) / 60,0);
//     $differenceTxt=" min. ago";

//     if($timeDiff>=60)
//     {
//         $timeDiff=round(abs($timeDiff) /60,0);
//         $differenceTxt=" hours ago";
//         if($timeDiff>=24)
//         {
//             $timeDiff=round(abs($timeDiff)/24,0);
//             $differenceTxt=" days ago";
//             if($timeDiff>=7)
//             {
//                 $timeDiff=round(abs($timeDiff)/7,0);
//                 $differenceTxt=" weeks ago";
//                 if($timeDiff>4)
//                 {
//                     $timeDiff=round(abs($timeDiff)/4,0);
//                     $differenceTxt=" months ago";
//                     if($timeDiff>=12)
//                     {
//                         $timeDiff=round(abs($timeDiff)/12,0);
//                         $differenceTxt=" years ago";
//                     }
//                 }
//             }
//         }
//     }

//     return $timeDiff.$differenceTxt;



// }
// /*
// * Sorts json object by the specified index
// */
// function sortArray($objectJson, $index)
// {
//     $object=json_decode($objectJson);
//     $sorted=array();
//     foreach($object as $obj)
//     {
//         $sorted[$obj->$index]=$obj;
//     }
//     ksort($sorted);
//     return json_encode($sorted);
// }

// /*
// * Sorts json object by the specified index in reverse order
// */
// function sortArrayRev($objectJson, $index)
// {
//     $object=json_decode($objectJson);
//     $sorted=array();
//     uksort($object,"localCompare");
//     foreach($object as $obj)
//     {
//         $sorted[$obj->$index]=$obj;
//     }
//     krsort($sorted);
//     $retData=array();
//     foreach($sorted as $item)
//     {
//         $retData[]=$item;
//     }
//     return json_encode($retData);
// }

// function popularityCompare($a,$b){
//     log_message('info',indent(json_encode($a)));
//     log_message('info',indent(json_encode($b)));
//     return ($a->popularityCount > $b->popularityCount) ? -1 : (($a->popularityCount == $b->popularityCount) ? 0 : 1);
// }
// /*
//  * FORMATS date
//  */

// function formatDate($unixTimestamp)
// {
//     return date("d M y",$unixTimestamp);
// }

// /*
//  * Formats time
//  */
// function formatTime($unixTimestamp)
// {
//     return date('g:i A',$unixTimestamp);
// }

// function round_half($input)
// {
//     $output = round(($input*2), 0)/2;
//     return $output;
// }

// function objectify($array)
// {
//     return json_decode(json_encode($array));
// }

// /**
//  * Ajax utilities
//  */

// /**
//  * @param $array array of post data to check
//  * @return bool
//  */
// function checkPost($array)
// {
//     $status=true;
//     foreach($array as $postItem)
//     {
//         if(!(isset($_POST[$postItem])))
//         {
//             $status=false;
//             break;
//         }

//     }
//     return $status;
// }

// /**
//  *
//  * Will add the calling function and file with line number
//  *
//  * @param $level Codeigniter debug level
//  * @param $msg String message
//  */
// function debugPrint($level,$msg){
//     $chunks = explode('/', debug_backtrace()[0]['file']);
//     $header = $chunks[count($chunks)-1]."(".debug_backtrace()[0]['line'].") : ".debug_backtrace()[1]['function']."() - ";
//     $msg = $header.$msg;
//     log_message($level,$msg);
// }

// function setTimeZone($timeZone){
//     if($timeZone!='')
//     {
//         $sign=substr($timeZone,0,1);
//         $difference=$timeZone;
//         if(in_array($sign, array('+', '-')))
//             $difference=substr($timeZone,1);
//         else{
//             $sign='+';
//         }

//         $arr=explode(":", $difference);

//         $timeZone=$sign.$arr[0].":".$arr[1].":00";

//         $seconds=intval(timeToSeconds($timeZone));
//         $timezone=timezone_name_from_abbr("", $seconds, 0);

//         $timezone=tz_offset_to_name($sign,$arr[0],$arr[1]);

//         date_default_timezone_set($timezone);
//     }
// }

// function timeToSeconds($time)
// {
//     $time=explode(":",$time);
//     return $time[0]*3600+$time[1]*60+$time[2];
// }

// function tz_offset_to_name($sign, $hour, $minute)
// {
//     $offset = $sign.(intval($hour)*3600 + intval($minute)*60); // convert hour offset to seconds
//     $abbrarray = timezone_abbreviations_list();
//     foreach ($abbrarray as $abbr)
//     {
//         foreach ($abbr as $city)
//         {
//             if ($city['offset'] == $offset)
//             {
//                 return $city['timezone_id'];
//             }
//         }
//     }

//     return FALSE;
// }

function send_email($to, $subject, $msg){
    
    $config = Array(
    'protocol' => 'mail',
	'smtp_host' => 'ssdrs2.layerip.com',
	'smtp_port' => 587,
    'smtp_user' => 'info@dashboard.tapouts.online', 
	'smtp_pass' => 'FD3EM@wF={~c', 
	'mailtype' => 'html',
	'charset' => 'iso-8859-1',
	'wordwrap' => TRUE
    );
    
   

    $CI = get_instance();
    $CI->email->initialize($config);
    $CI->load->library('email', $config);

    $from = 'info@dashboard.tapouts.online';
    $CI->email->set_newline("\r\n");
    $CI->email->from($from, "Tapouts Dashboard"); // Email
    $CI->email->to($to);// Password
    $CI->email->subject($subject);
    $CI->email->message($msg);

    if($CI->email->send()){
        return true;
    } else {
       show_error($CI->email->print_debugger());
        return false;
    }

}

// function send_email_attachment($to, $subject, $msg, $attachment){

//     $config = Array(
//         'protocol' => 'smtp',
//         'smtp_host' => 'ssl://email-smtp.us-west-2.amazonaws.com',
//         'smtp_port' => 465,
//         'smtp_user' => 'AKIAI4QGE32FKKABFLIQ', // Your email
//         'smtp_pass' => 'Ar2QXin5WOwCUn1UdELpbRKAjwEPtu29kbSAdXb5Mb0Q', // Passowrd
//         'mailtype' => 'html',
//         'charset' => 'utf-8',
//         'wordwrap' => TRUE
//     );

//     $CI = get_instance();
//     $CI->email->initialize($config);
//     $CI->load->library('email', $config);

//     $from = 'enquiries@smartrepair.io';
//     $CI->email->set_newline("\r\n");
//     $CI->email->from($from, "Smart Repair"); // Email
//     $CI->email->to($to);// Password
//     $CI->email->subject($subject);
//     $CI->email->message($msg);
//     $CI->email->attach($attachment);
//     if($CI->email->send()){
//         return true;
//     } else {
//         show_error($CI->email->print_debugger());
//         return false;
//     }

// }

// function send_sms($to,$message){

// //    *Send SMS using PHP*/

//     //Your authentication key
//     $authKey = "147711AsbTNJez0MR58e499c5";

//     //Multiple mobiles numbers separated by comma
//     $mobileNumber = $to;

//     //Sender ID,While using route4 sender id should be 6 characters long.
//     $senderId = "102234";

//     //Your message to send, Add URL encoding here.
//     $message = urlencode($message);

//     //Define route
//     $route = "default";
//     //Prepare you post parameters
//     $postData = array(
//         'authkey' => $authKey,
//         'mobiles' => $mobileNumber,
//         'message' => $message,
//         'sender' => $senderId,
//         'route' => $route
//     );

//     //API URL
//     $url="https://control.msg91.com/api/sendhttp.php";

//     // init the resource
//     $ch = curl_init();
//     curl_setopt_array($ch, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_POST => true,
//         CURLOPT_POSTFIELDS => $postData
//         //,CURLOPT_FOLLOWLOCATION => true
//     ));


//     //Ignore SSL certificate verification
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// //echo $url;
//     //get response
//     $output = curl_exec($ch);

//     //Print error if any
//     if(curl_errno($ch))
//     {

//         return false;
//     }

//     curl_close($ch);

//     return true;

// //    echo $output;

//     // sms for receiver with data of donor
// //    $url = 'http://103.16.101.52:8080/sendsms/bulksms?' . http_build_query([
// //            'username' => 'kap2-kapprouser',
// //            'password' => 'kapres',
// //            'type' => '0',
// //            'destination' => $to,
// //            'dlr' => '1',
// //            'source' => 'DCA',
// //
// //            'message' => $message,
// //            'mtype' => 'UNI',
// //            'response' => 'Y'
// //        ]);
// //    $ch = curl_init($url);
// //    curl_setopt($ch, CURLOPT_HEADER, 0);
// //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// //    $result = curl_exec($ch);
// //    curl_close($ch);
// //    //echo $url;
// //
// //    //check if error occurred
// //    if($result == FALSE)
// //    {
// //        return false;
// //    }else{
// //        return true;
// //    }
// }

// function sendDataToS3($fileData){
//     $CI =& get_instance();
//     $CI->load->library('S3');
//     //Since we've decided to optimize the uploads, do all the things that codeigniter's default upload library did including from checking allowed file types to allowed max file size to generating a random string and appending it so that multiple same file upload wont overwrite the existing file.

//     if (isset($fileData["name"]))
//         $target_file = basename($fileData["name"]);
//     else
//         $target_file = date('dmyhis');
//     $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//     $imageFileType = strtolower($imageFileType);
//     $rawFileName = basename($target_file, "." . $imageFileType);

//     $validFileType = explode('|', $CI->config->item('document_allowed_file_types'));

//     $modRawName = $rawFileName . "_" . generateRandomString(10); // Removed salt as its being handled from mobile side

//     //converting Bytes to KB, for some reason it says 1 MB if we specify 10 MB
//     $validSize = $CI->config->item('upload_max_file_size') * 1000;

//     if (in_array($imageFileType, $validFileType)) {
//         //valid file type
//         if (isset($fileData['tmp_name']) && $fileData['tmp_name']!="")
//             $file = $fileData['tmp_name'];

//         $bucket = S3BUCKETNAME;
//         if (isset($fileData['size']) && $fileData['size']!= 0 && $fileData['size'] <= $validSize){

// //            $relPath = "logos/" . $modRawName.".".$imageFileType;
//             $relPath = "logos/" . $modRawName.".".$imageFileType;
// //            log_message('dev',"<<ATTACHED FILE>>".$relPath);

//             if (S3::putObject(S3::inputFile($file), $bucket, $relPath, S3::ACL_PUBLIC_READ)) {
// //                log_message("dev","file link - ".S3BUCKETURL.$relPath);
//                 return S3BUCKETURL.$relPath;
//             } else {
// //                log_message("dev","failed to upload file to S3");
//                 return FALSE;
//             }
//         } else {
// //            log_message('dev', 'File size > max upload file size');
//             return FALSE;
//         }
//     } else {
//         //invalid file type
//         return FALSE;
//     }
// }

// /**
//  * @param $timestamp    : Unix timestamp in the given timezone
//  * @param $timezone     : timezone (+/-hh:mm) e.g. +05:30
//  * @return int          :  unix timestamp in GMT
//  */
// function convertUnixToGMT($timestamp, $timezone){

//     $sign = substr($timezone,0,1);
//     $time = substr($timezone,1,strlen($timezone));
//     $time = explode(":",$time);
//     $utcTime = $time[0]*3600+$time[1]*60+$time[2];
//     if($sign == "+"){
//         $endTime = $timestamp - $utcTime ;
//     }else{
//         $endTime = $timestamp + $utcTime;
//     }
//     return $endTime;
// }

// /**
//  * @param $dt           : date string in given timezone in format Y-m-d (e.g. 2016-07-13)
//  * @param $time         : time staring in give timezone in format H:i:s (e.g. 17:31:00)
//  * @param $timezone     : timezone (+/-hh:mm) e.g. +05:30
//  * @return int|mixed    :  unix timestamp in GMT
//  */
// function convertToGMT($dt ,$time,$timezone){
//     $timestamp = strtotime("$dt $time");
//     // echo $timestamp;
//     return convertUnixToGMT($timestamp, $timezone);
// }


// /**
//  * @param $timestamp    : Unix timestamp in the given timezone
//  * @param $timezone     : timezone (+/-hh:mm) e.g. +05:30
//  * @return int          :  unix timestamp in GMT
//  */

// function convertUnixToLocal($timestamp, $timezone){
//     //echo $timestamp;
//     $sign = substr($timezone,0,1);
//     //echo '    '.$sign;
//     $time = substr($timezone,1,strlen($timezone));
//     //echo '    '.$time;
//     $time = explode(":",$time);
//     // print_r($time);
//     $utcTime = $time[0]*3600+$time[1]*60+$time[2];
//     // print_r($utcTime);

//     if($sign == "+"){
//         $endTime = $timestamp + $utcTime ;
//     }else{
//         $endTime = $timestamp -$utcTime;
//     }

//     return $endTime;
// }

// /**
//  * @param $dt           : date string in given timezone in format Y-m-d (e.g. 2016-07-13)
//  * @param $time         : time staring in give timezone in format H:i:s (e.g. 17:31:00)
//  * @param $timezone     : timezone (+/-hh:mm) e.g. +05:30
//  * @return int|mixed    :  unix timestamp in GMT
//  */

// function convertToLocal($dt,$time,$timezone){
//     $timestamp = strtotime("$dt $time");
//     return convertUnixToLocal($timestamp,$timezone);
// }

// function currency($from, $to, $amount)
// {
//     $content = file_get_contents('https://www.google.com/finance/converter?a='.$amount.'&from='.$from.'&to='.$to);

//     $doc = new DOMDocument;
//     @$doc->loadHTML($content);
//     $xpath = new DOMXpath($doc);

//     $result = $xpath->query('//*[@id="currency_converter_result"]/span')->item(0)->nodeValue;

//     return str_replace(' '.$to, '', $result);
// }

// /**
//  * Author: CodexWorld
//  * Author URI: http://www.codexworld.com
//  * Function Name: getAddress()
//  * $latitude => Latitude.
//  * $longitude => Longitude.
//  * Return =>  Address of the given Latitude and longitude.
//  **/
// function getAddress($latitude,$longitude){
//     if(!empty($latitude) && !empty($longitude)){
//         //Send request and receive json data by address
//         $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false');
//         $output = json_decode($geocodeFromLatLong);
//         $status = $output->status;
//         //Get address from json data
//         $address = ($status=="OK")?$output->results[1]->formatted_address:'';
//         //Return address of the given latitude and longitude
//         if(!empty($address)){
//             return $address;
//         }else{
//             return false;
//         }
//     }else{
//         return false;
//     }
// }

// /**
//  * Author: CodexWorld
//  * Author URI: http://www.codexworld.com
//  * Function Name: getLatLong()
//  * $address => Full address.
//  * Return => Latitude and longitude of the given address.
//  **/
// function getLatLong($address){
//     if(!empty($address)){
//         //Formatted address
//         $formattedAddr = str_replace(' ','+',$address);
//         //Send request and receive json data by address
//         $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&key=AIzaSyC7eI9EU2pCpPsSKKJh9aJC3XtPBR4n7Gk');
//         $output = json_decode($geocodeFromAddr);
//         if(isset($output->results[0])){
//             //Get latitude and longitute from json data
//             $data['latitude']  = $output->results[0]->geometry->location->lat;
//             $data['longitude'] = $output->results[0]->geometry->location->lng;
//             //Return latitude and longitude of the given address
//             if(!empty($data)){
//                 return $data;
//             }else{
//                 return false;
//             }
//         }else{
//             return false;
//         }

//     }else{
//         return false;
//     }
// }

// /**
//  * Author: CodexWorld
//  * Author URI: http://www.codexworld.com
//  * Function Name: getLatLong()
//  * $address => Full address.
//  * Return => Latitude and longitude of the given address.
//  **/
// function getLatLong_with_post_code($address){
//     if(!empty($address)){
//         //Formatted address
//         $formattedAddr = str_replace(' ','+',$address);
//         //Send request and receive json data by address
//         $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&key=AIzaSyC7eI9EU2pCpPsSKKJh9aJC3XtPBR4n7Gk');
//         $output = json_decode($geocodeFromAddr);


//         if(isset($output->results[0])){

//             $post_code_index =  count($output->results[0]->address_components);
//             $post_code_index =  $post_code_index - 1;

//             //Get latitude and longitute from json data
//             $data['latitude']  = $output->results[0]->geometry->location->lat;
//             $data['longitude'] = $output->results[0]->geometry->location->lng;
//             if(isset($output->results[0]->address_components[$post_code_index]->long_name)){
//                 $data['post_code'] = $output->results[0]->address_components[$post_code_index]->long_name;
//             }else{
//                 $data['post_code'] = '';
//             }

//             //Return latitude and longitude of the given address
//             if(!empty($data)){
//                 return $data;
//             }else{
//                 return false;
//             }
//         }else{
//             return false;
//         }

//     }else{
//         return false;
//     }
// }

// function search($times,$hour,$minute){
//     // Loop Throught Times
//     foreach($times as $time){
//         $min = (int)date("i",strtotime($time));		//Get Minutes
//         $hou = (int)date("H",strtotime($time)); 	//Get Hours, Note:(int) will remove leading Zero i.e 08=8

//         // now we Check if passed hours and minutes will match with the hours and minutes of selected date Appointments
//         if($hou==$hour && $min==$minute){
//             //if matched then return Minute
//             // echo $min;
//             return true;
//         }

//     }

//     return false;
// }

// function distance($lat1, $lon1, $lat2, $lon2, $unit) {

//     $theta = $lon1 - $lon2;
//     $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
//     $dist = acos($dist);
//     $dist = rad2deg($dist);
//     $miles = $dist * 60 * 1.1515;
//     $unit = strtoupper($unit);

//     if ($unit == "K") {
//         return ($miles * 1.609344);
//     } else if ($unit == "N") {
//         return ($miles * 0.8684);
//     } else {
//         return $miles;
//     }
// }

// //get all basic detail of company to use everywhere
// //this function is accessing by hooks
// function company_detail(){

//     //get configurations detail from database
//     $CI =& get_instance();
//     $configurations = $CI->Generic_model->getGenericData('configurations');
//     $country = $CI->Generic_model->getGenericData('country');

//     $selected_country = '';
//     for($i = 0; $i <count($country); $i++){

//         if($country[$i]->id == $configurations[9]->value){

//             $selected_country = $country[$i]->short_name;
//         }
//     }

//     $comp_details = array(
//         'comp_name' => $configurations[0]->value,
//         'comp_est_date' => $configurations[1]->value,
//         'comp_email' => $configurations[2]->value,
//         'comp_contact' => $configurations[3]->value,
//         'comp_fax' => $configurations[4]->value,
//         'comp_add' => $configurations[5]->value.' '.$configurations[7]->value.' '.$configurations[8]->value.' '.$configurations[6]->value,
//         'comp_country' => $selected_country,
//         'comp_logo' => $configurations[11]->value,
//         'radius' => $configurations[10]->value,
//     );

//     //set company detail in session
//     $CI->session->set_userdata($comp_details);

//     return $comp_details;

// }

// /*upload multiple image in s3 bucket*/
// function multi_image()
// {
//     $CI =& get_instance();

// // retrieve the number of images uploaded;
//     $number_of_files = sizeof($_FILES['images']['tmp_name']);
//     // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
//     $files = $_FILES['images'];
//     $errors = array();
//     $data = '';

//     // first make sure that there is no error in uploading the files
//     for ($i = 0; $i < $number_of_files; $i++) {
//         if ($_FILES['images']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file ' . $_FILES['images']['name'][$i];
//     }
//     if (sizeof($errors) == 0) {
//         // now, taking into account that there can be more than one file, for each file we will have to do the upload
//         // we first load the upload library
//         //$CI->load->library('upload');
//         // next we pass the upload path for the images
//         //$config['upload_path'] = '../uploads/';
//         // also, we make sure we allow only certain type of images
//         //$config['allowed_types'] = 'gif|jpg|png';

//         for ($i = 0; $i < $number_of_files; $i++) {
//             $_FILES['images']['name'] = $files['name'][$i];
//             $_FILES['images']['type'] = $files['type'][$i];
//             $_FILES['images']['tmp_name'] = $files['tmp_name'][$i];
//             $_FILES['images']['error'] = $files['error'][$i];
//             $_FILES['images']['size'] = $files['size'][$i];
//             //now we initialize the upload library
//             /*$CI->upload->initialize($config);
//             $target_file = '../uploads/' . basename($_FILES["images"]["name"]);
//             if(move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
//                 echo "The file " . basename($_FILES["images"]["name"]) . " has been uploaded.";
//             }else{

//             }*/

//             // we retrieve the number of files that were uploaded
//             $data = $data . ',' . sendDataToS3($_FILES['images']);

//             if($i == 2){
//                 break;
//             }
//         }
//     }

//     return $data;
//     /* else {
//         print_r($errors);
//     }*/

// }

// /*validate unix timestamp*/
// function isValidTimeStamp($timestamp)
// {
//     return ((string) (int) $timestamp === $timestamp)
//         && ($timestamp <= PHP_INT_MAX)
//         && ($timestamp >= ~PHP_INT_MAX);
// }

// /*show last seen*/
// function get_timeago( $ptime )
// {
//     $etime = time() - $ptime;

//     if( $etime < 1 )
//     {
//         return 'less than '.$etime.' second ';
//     }

//     $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
//         30 * 24 * 60 * 60       =>  'month',
//         24 * 60 * 60            =>  'day',
//         60 * 60             =>  'hour',
//         60                  =>  'minute',
//         1                   =>  'second'
//     );

//     foreach( $a as $secs => $str )
//     {
//         $d = $etime / $secs;

//         if( $d >= 1 )
//         {
//             $r = round( $d );
//             return  $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ';
//         }
//     }
// }















