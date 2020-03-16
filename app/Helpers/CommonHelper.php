<?php

namespace Helper\Common;
use finfo;
use Illuminate\Support\Collection;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Exception\ImageException;

if (!function_exists('show404')) {
    function show404()
    {
        return view('errors/404');
    }
}

if (!function_exists('upload')) {
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param bool $thum
     * @param bool $resize
     * @param int $width
     * @param int $height
     * @return array
     */
    function upload($file, $thum = true, $resize = false, $width = 400, $height = 400)
    {

        $destinationUrl = "uploads";
        $imgThumPath = "";

        $path = $file->store($destinationUrl, "public");
        $imgPath = getDestinationUrl($path);

        //create Thumbile
        if ($thum) {
            $imgThumPath = createThum($file, $width, $height);
        }

        //
        if ($resize) {
            resizeImage($file, $path, $width, $height);
        }

        return [
            "img" => $imgPath,
            "thum" => $imgThumPath,
        ];


    }
}

if (!function_exists('createThum')) {
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param integer $width
     * @param integer $height
     * @return string
     */
    function createThum($file, $width, $height)
    {
        $destinationThumUrl = "uploadsThum";
        $pathThum = $file->store($destinationThumUrl, "public");
        $img = Image::make($file->getRealPath());

        $img->resize($width, $height);
        Storage::disk('public')->put($pathThum, (string)$img->encode());
        $imgThumPath = getDestinationUrl($pathThum);
        return $imgThumPath;
    }
}

if (!function_exists('resizeImage')) {
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param integer $width
     * @param integer $height
     */
    function resizeImage($file, $path, $width, $height)
    {
        /** @var \Intervention\Image\Image $img */
        $img = Image::make($file->getRealPath());
        $img->resize($width, $height);
        Storage::disk('public')->put($path, (string)$img->encode());
    }
}

if (!function_exists('base64ToImage')) {
    /**
     * @param $string
     * @return string
     */
    function base64ToImage($string)
    {
        $directory = "uploads/";
        $base = "/public/uploads/no_avatar.jpg";
        try{
            //decode base64
            $image = base64_decode($string);
            //
            /* get extiontion of file   */
            /* get extiontion of file   */
            $ext = getExt($image);
            /* get extiontion of file   */
            /* get extiontion of file   */


            /* check extiontion */
            if ($ext == "png" OR $ext == "jpg" OR $ext == "jpeg" OR $ext == "gif" OR $ext == "PNG" OR $ext == "JPG" OR $ext == "JPEG" OR $ext == "GIF") {
                $fileName = generateFileName($ext);
                Storage::disk('public')->put("$directory/" . $fileName,  $image);
                return getDestinationUrl($directory . $fileName);
            } else {
                return $base;
            }
            /*  */
        }catch (Exception $e){
            return $base;
        }

    }
}

if (!function_exists('generateFileName')) {


    function generateFileName($extension)
    {

        $random = rand(1000000,9999999);
        //create file name
        $file_name = "";
        $file_nameDate = date("Y-m-d-H-i-s");
        $file_nameDate .= "-" . $random;
        $file_name .= $file_nameDate;
        $file_name .= "-" . hash("md5",$file_nameDate);
        $file_name .= "." . $extension;

        return $file_name;

    }
}


if (!function_exists('getDestinationUrl')) {
    /**
     * @param $imgPath
     * @return string
     */
    function getDestinationUrl($imgPath)
    {
        if(env("USE_STORAGE_AS_LINK"))
            return $imgPath;
        else
            return Storage::url("app/public/").$imgPath;
    }
}

if (!function_exists('imageUrl')) {
    /**
     * @param $image
     * @return string
     */
    function imageUrl($image)
    {
        if(Str::contains($image,"storage"))
            $url = url("");
        else
            $url = url("public/storage/");

        if($image != null){
            if($url == url(""))
                return $url . $image;
            else
                return $url ."/". $image;
        }
        else
            return "";
    }
}


if (!function_exists('titleSlug')) {

    /**
     * @param $item
     * @param string $title
     * @return string
     */
    function titleSlug($item,$title = "title")
    {
        $lang = app()->getLocale();
        $slug = $title."_".$lang;
        return  $item->$slug;
    }
}



if (!function_exists('__distanceColumn')) {
    /**
     * @param string $tableName
     * @param string $lat
     * @param string $lng
     * @return string
     */
    function __distanceColumn($tableName, $lat, $lng)
    {
        $diffLocations = "SQRT(POW(69.1 * ($tableName.lat - {$lat}), 2) + POW(69.1 * ({$lng} - $tableName.lng) * COS($tableName.lat / 57.3), 2)) as distance";
        return $diffLocations;
    }
}

if (!function_exists('__lang')) {
    /**
     * @param string $key
     * @param string $symbol
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    function __lang($key, $symbol = "_")
    {
        $defaultFileLang = config("app.langFile");
        $key = $defaultFileLang . "." . $key;
        $word = trans($key);
        if ($word == $key) {
            if ($symbol) {
                $word = str_replace($defaultFileLang . '.', '', $word);
                $word = str_replace($symbol, ' ', ucwords($word));

            } else {

                $word = $word ? $word : $word;
            }
        }

        return $word;
    }
}

if (!function_exists('getYoutubeEmbedUrl')) {
    /**
     * @param string $url
     * @return string
     */
    function getYoutubeEmbedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        $youtube_id = '';
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }
}

if (!function_exists('ArabicDate')) {
    /**
     * @param string $date
     * @return mixed
     */
    function ArabicDate($date)
    {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        $your_date = $date; // The Current Date
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }

        $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
        $replace = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D', strtotime($your_date)); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $current_date = $ar_day . ' ' . date('d') . ' / ' . $ar_month . ' / ' . date('Y');
        $arabic_date = str_replace($standard, $eastern_arabic_symbols, $current_date);

        return $arabic_date;
    }
}


if (!function_exists('__address')) {
    /**
     * @param integer $lat
     * @param integer $lng
     * @param string $lang
     * @return string
     */
    function __address($lat, $lng, $lang = "AR")
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&language=' . $lang ."&key=".env("GOOGLE_KEY") ;
        $data = json_decode(curlRequest($url));
        //$data = json_decode(curlRequest($url));
        //print_r($data->results[0]->formatted_address);die;
        isset($data->status) ? $status = $data->status : $status = "FAIL";

        // print_r($data);die;
        //echo $data->results[0]->formatted_address;die;
        if ($status == "OK") {
            return $data->results[0]->formatted_address;
        } else {
            return "";
        }
    }
}

if (!function_exists('distanceBetweenLocations')) {
    /**
     * @param double $lat1
     * @param double $lon1
     * @param double $lat2
     * @param double $lon2
     * @param string $unit
     * @return float|int
     */
    function distanceBetweenLocations($lat1, $lon1, $lat2, $lon2, $unit = "K")
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

if (!function_exists('getExt')) {
    /**
     * @param string $imgData
     * @return mixed
     */
    function getExt($imgData)
    {
        $finfo = new finfo(FILEINFO_MIME);
        $types = $finfo->buffer($imgData) . "\n";
        $ini = substr($types, 6);
        $ini = explode(';', $ini);
        $ext = $ini[0];

        return $ext;
    }
}

if (!function_exists('base64ToFile')) {
    /**
     * @param string $base64_string
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function base64ToFile($base64_string)
    {
        //$url = url("/");
        //decode base64
        $imgdata = base64_decode($base64_string);
        //
        /* get extiontion of file   */
        /* get extiontion of file   */
        $ext = getExt($imgdata);
        /* get extiontion of file   */
        /* get extiontion of file   */

        /* check extiontion */
        if ($ext == "png" OR $ext == "jpg" OR $ext == "jpeg" OR $ext == "gif" OR $ext == "PNG" OR $ext == "JPG" OR $ext == "JPEG" OR $ext == "GIF") {
            $random = rand(10000, 99999);
            //create file name
            $file_name = "/storage/app/public/uploads/";
            $file_name .= date("Y-m-d-H-i-s");
            $file_name .= "-" . $random;
            $file_name .= "." . $ext;
            //print_R($file_name);die;
            // open the output file for writing
            $ifp = fopen($file_name, 'wb');

            // we could add validation here with ensuring count( $data ) > 1
            fwrite($ifp, $imgdata);

            // clean up the file resource
            fclose($ifp);

            //create url to store it

            $url = $file_name;
        } else {
            $url = "/public/uploads/no_avatar.jpg";
        }


        /*  */


        return $url;

    }
}

if (!function_exists('rules')) {
    /**
     * @param array $fields
     * @param string $rule
     * @return array
     */
    function rules($fields, $rule = "required")
    {
        $rules = array();
        foreach ($fields as $field) {
            $rules[$field] = $rule;
        }

        return $rules;

    }
}

if (!function_exists('sendMail')) {

    /**
     * @param $view
     * @param null $partialBlade
     * @param $object
     * @param string $subject
     * @param null $to
     * @param null $appName
     */
    function sendMail($view , $partialBlade = null, $object, $subject = "Reset Password", $to = null, $appName = null)
    {
        if ($appName != null || !empty($appName)) {
            $mailName = $appName;
            $object->appName = $appName;
        } else {
            $mailName = config("app.name");
            $object->appName = $mailName;
        }

        $mailFrom = $mailName . "@email.com";

        Mail::send($view, ['object' => $object , "blade"=>$partialBlade], function ($m) use ($object, $subject, $mailFrom, $mailName, $to) {
            $m->from($mailFrom, $mailName);
            $m->subject($subject);
            if ($to != null) {
                $m->to($to);
            } else {
                $m->to($object->email);
            }

        });
    }
}


if (!function_exists('sendNoti')) {
    /**
     * @param mixed $tokens
     * @param string $message
     * @param string $title
     * @param integer $deviceType
     * @param array $extras
     */
    function sendNoti($tokens, $message,$title = null,$deviceType = 1 , $extras = null)
    {
        $fields = fcmFields($tokens, $message,$title,$deviceType,$extras);
        fcmCurl($fields);
    }
}

if (!function_exists('fcmFields')) {

    /**
     * @param string $tokens
     * @param string $message
     * @param string $title
     * @param integer $deviceType
     * @param array $extras
     * @return string
     */
    function fcmFields($tokens, $message, $title = null , $deviceType , $extras)
    {
        if ($title == null)
            $title = config("app.name");

        $tokens = checkTokenArray($tokens);
//        unset($tokens);
//        $tokens = array();
//        $tokens[0] = "fvIm_TQnV_U:APA91bGNJdQQDJpApZ06IwTKo_MaELq1z0_mzEEdiJIXWTRFCn_T7s-bM6N5JRDZ8TeZdksIpgpd0XRAv6_YhwYOE6xpuWKs31JvF6OF_UFkwr_HniGZbhldlJ5otalAZ_9XH4sMQ1n-";
        if($deviceType == 1)
        {
            $fields = array
            (
                'registration_ids' => $tokens,
                'data' => array(
                    'title' => $title,
                    'body' => $message,
                    'extras' =>$extras,
                )
            );
        }
        else
        {
            $fields = array
            (
                'registration_ids' => $tokens,
                'notification' => array(
                    'title' => $title,
                    'body' => $message,
                    'extras' =>$extras,
                    'sound' => 1,
                    'priority' => "high",
                    'vibrate' => 1
                )
            );
        }

        return json_encode($fields);
    }
}

if (!function_exists('checkTokenArray')) {
    /**
     * @param array|string $tokens
     * @return array
     */
    function checkTokenArray($tokens)
    {
        $returned = array();

        if($tokens instanceof Collection && isset($tokens[0]))
            return $tokens->toArray();
        elseif (isset($tokens[0]) && is_array($tokens))
            return $tokens;
        else
            return  $returned[0] = $tokens;

    }
}


if (!function_exists('fcmHeaders')) {
    /**
     * @return array
     */
    function fcmHeaders()
    {
        $key = config("app.firebase");
        $headers = array
        (
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        );
        return $headers;
    }
}

if (!function_exists('fcmCurl')) {
    /**
     * @param string $fields
     * @return bool
     */
    function fcmCurl($fields)
    {
        $returned = true;

        $url = 'https://fcm.googleapis.com/fcm/send';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, fcmHeaders());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        //dd($result);
        if ($result === False) {
            $returned = false;
            die('Curl Filed ' . curl_errno($ch));
        }
        curl_close($ch);
        return $returned;
    }
}



if (!function_exists('curlRequest')) {

    /**
     * @param $url
     * @return bool
     */
    function curlRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }
}


if (!function_exists('createArrayTimes')) {


    /**
     * @param string $date
     * @param int $hours
     * @param string $timeFrom
     * @param string $timeTo
     * @return array
     */
    function createArrayTimes( $timeFrom = "", $timeTo = "" , $date = "", $hours = 0)
    {

        $diffHour = setDiffHours($timeFrom , $timeTo , $hours );


        $timesAvailable = [];
        $timesAvailableTrue = [];
        for ($i = 0, $j = 0; $i <= $diffHour; $i++) {
            //increase 30 minute after 1 itreation
            if ($i > 0) {
                $timeFrom = strtotime("+30 minute", strtotime($timeFrom));
                $timeFrom = date("H:i:s", $timeFrom);
                //$playFrom++;
            }

            $timesAvailable[$i] = $timeFrom;


            if (strtotime($date) == strtotime(date("Y-m-d"))) {
                if (strtotime($timesAvailable[$i]) > strtotime(date("H:i:s"))) {
                    $timesAvailableTrue[$j] = date("h:i A", strtotime($timesAvailable[$i]));
                    $j++;
                } else {
                    unset($timesAvailable[$i]);
                }
            } else {
                $timesAvailableTrue[$j] = date("h:i A", strtotime($timesAvailable[$i]));
                $j++;
            }

        }
        return $timesAvailableTrue;
    }

}


if (!function_exists('setDiffHours')) {


    /**
     * @param string $timeFrom
     * @param string $timeTo
     * @param int $hours
     * @return float|int
     */
    function setDiffHours( $timeFrom = "", $timeTo = "" , $hours = 0)
    {
        if($hours > 24)
        {
            //convert to hours
            $hours = $hours / 60;
        }
        // get diff hours from play to - play from
        $diff = strtotime($timeTo) - strtotime($timeFrom);
        $diffHour = $diff / 60 /60;
        if($diffHour > 23)
        {
            $diffHour = 24;
        }
        else
        {
            $diffHour = (int)$diffHour;
        }
        $diffHour -= $hours;
        // get halfs
        $diffHour *= 2;

        $diffHour = (int) $diffHour;
        return $diffHour;
    }


}

if (!function_exists('timeStampEditor')) {


    /**
     * @param int $number
     * @param string $type
     * @param string $operation
     * @return float|int
     */
    function timeStampEditor($number = 0, $type = "DAY", $operation = "MULTIPLY")
    {
        if ($operation == "MULTIPLY") {
            $timeStamp = 0;
            $const = ["HOUR", 'DAY', "MONTH", "YEAR"];
            if (in_array($type, $const)) {
                if ($type == "HOUR") {
                    $timeStamp = $number * 60 * 60;
                } elseif ($type == "DAY") {
                    $timeStamp = $number * 60 * 60 * 24;
                } elseif ($type == "MONTH") {
                    $timeStamp = $number * 60 * 60 * 24 * 30;
                } elseif ($type == "YEAR") {
                    $timeStamp = $number * 60 * 60 * 24 * 30 * 12;
                }
            }
        } else {
            $timeStamp = 0;
            $const = ["HOUR", 'DAY', "MONTH", "YEAR"];
            if (in_array($type, $const)) {
                if ($type == "HOUR") {
                    $timeStamp = $number / 60 / 60;
                } elseif ($type == "DAY") {
                    $timeStamp = $number / 60 / 60 / 24;
                } elseif ($type == "MONTH") {
                    $timeStamp = $number / 60 / 60 / 24 / 30;
                } elseif ($type == "YEAR") {
                    $timeStamp = $number / 60 / 60 / 24 / 30 / 12;
                }
            }
        }

        return $timeStamp;
    }
}


if (!function_exists('constantSlugs')) {

    /**
     * @return array
     */
    function constantSlugs()
    {
        $const = ["false","title","name","description","body","content","about_us","rules","location"];
        return $const;
    }
}
if (!function_exists('constantSlugs')) {


    /**
     * @param null $name
     * @return false|int|string
     */
    function getKeyOfSlug($name = null)
    {
        $name = str_replace("_ar","",$name);
        $name = str_replace("_en","",$name);
        return array_search($name , constantSlugs());
    }
}
if (!function_exists('d')) {


    /**
     * @param array ...$args
     */
    function d(...$args)
    {
        foreach ($args as $x) {
            (new Dumper)->dump($x);
        }

        die(1);
    }
}