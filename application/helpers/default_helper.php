<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('displayDate')) {

    function displayDate($var = '')
    {
        if ($var != '') {
            $tmp = explode(' ', $var);
            $tmp_date = $tmp[0];

            $sp_date = explode('-', $tmp_date);
            $var = $sp_date[2] . '/' . $sp_date[1] . '/' . $sp_date[0];
        }
        return $var;
    }

}

if (!function_exists('_print_r')) {

    function _print_r($var = false)
    {
        if ($var != false) {
            echo '<meta charset="UTF-8">';
            echo '<pre>';
            print_r($var);
            die();
        }
        return $var;
    }

}

if (!function_exists('antiHack')) {

    function antiHack($txt = false)
    {
        $txt = stripslashes($txt);
        $txt = $string = strip_tags($txt);
        return preg_replace("/<script|'<?'/", "", $txt);
    }

}

if (!function_exists('antiHackTag')) {

    function antiHackTag($txt = false)
    {
        $txt = stripslashes($txt);
        return preg_replace("/<script|'<?'/", "", $txt);
    }

}


if (!function_exists('getCurrDT')) {
    function getCurrDT($time = false)
    {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Bangkok'));
        if($time == true)
            $curr_date = $date->format('Y-m-d H:i:s');
        else
            $curr_date = $date->format('Y-m-d');
        return $curr_date;
    }
}

if (!function_exists('encodeFolder')) {
    function encodeFolder($id)
    {
        $encode = 'BatangasStateUniversity::'. $id;
        return base64_encode($encode);
    }
}

if ( ! function_exists('load_css'))
{
    
    function load_css($current_page)
    {
        switch ($current_page) {
            case 'members':
                echo '<link rel="stylesheet" rel="preload" crossorigin="anonymous" href="./assets/css/cms/cms_members.css" as="style" onload="this.rel = \'stylesheet\'">';
                break;
            
            default:
                echo '';
                break; 
        }
    }
}

if ( ! function_exists('load_script'))
{
    
    function load_script($current_page)
    {
        switch ($current_page) {
            case 'members':
                echo '<script async defer src="./assets/js/member.js?v='.rand().'"></script>';
                break;
            
            default:
                echo '';
                break;
        }
    }
}

if ( ! function_exists('maybe_serialize'))
{
    function maybe_serialize($obj = array()){
        $json = json_encode($obj);
        $serialize = serialize($json);
        return $serialize;
    }
}

if ( ! function_exists('maybe_unserialize'))
{
    function maybe_unserialize($json = null){
        $unserialize = unserialize($json);
        $obj = json_decode($unserialize,true);  
        return $obj; 
    }
}

if ( ! function_exists('allow_hours'))
{
    function allow_hour(){
        return [
                '7:00 am - 8:00 am', 
                '8:00 am - 9:00 am', 
                '9:00 am - 10:00 am',
                '10:00 am - 11:00 am',
                '11:00 am - 12:00 pm',
                '1:00 pm - 2:00 pm',
                '2:00 pm - 3:00 pm',
                '3:00 pm - 4:00 pm'
        ];
    }
}

if ( ! function_exists('allow_day'))
{
    function allow_day(){
        $arr = [];
        for($i=1;$i<=31;$i++){
            $arr[] = $i;
        }
        return $arr;
    }
}

if ( ! function_exists('allow_days_of_week'))
{
    function allow_days_of_week(){
        return [
            'Monday', 
            'Tuesday', 
            'Wednesday',
            'Thursday',
            'Friday'
        ];
    }
}

if ( ! function_exists('allow_month'))
{
    function allow_month(){
        return [
            'January', 
            'February', 
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
    }
}

if ( ! function_exists('get_date_of_month'))
{
    function get_date_of_month($year, $month, $day)
    {
        $start_date = $year.'-'.$month.'-01';
        $end_date = date("Y-m-t", strtotime($start_date));
        $arr = [];
        while(strtotime($start_date) <= strtotime($end_date)){
            $date = date('l', strtotime($start_date));
            if($date == $day){
                $arr[] = date('Y-m-d', strtotime($start_date));
            }
            $start_date = date('Y-m-d', strtotime('+1 day', strtotime($start_date)));
        }
        return $arr;
    }
}

if ( ! function_exists('max_slots'))
{
    function max_slots(){
        return 10;
    }
}

if ( ! function_exists('department'))
{
    function department(){

        $department = array(
            1 => array(
                'department' => 'College Of Informatics and Computing Sciences',
                'courses' => array(
                    'Bachelor of Science in Computer Science',
                    'Bachelor of Science in Information Technology'
                )
            ),
            2 => array(
                'department' => 'College of Industrial Technology',
                'courses' => array(
                    'Bachelor of Industrial Technology - Automotive Technology',
                    'Bachelor of Industrial Technology - Computer Technology',
                    'Bachelor of Industrial Technology - Civil Technology',
                    'Bachelor of Industrial Technology - Drafting Technology',
                    'Bachelor of Industrial Technology - Electrical Technology',
                    'Bachelor of Industrial Technology - Electronics Technology',
                    'Bachelor of Industrial Technology - Food Technology',
                    'Bachelor of Industrial Technology - Instrumentation and Control Technology',
                    'Bachelor of Industrial Technology - Mechanical Technology',
                    'Bachelor of Industrial Technology - Mechatronics Technology',
                    'Bachelor of Industrial Technology - Welding and Fabrication Technology'
                )
            ),
            3 => array(
                'department' => 'College of Engineering Architecture and Fine Arts',
                'courses' => array(
                    'Bachelor of Fine Arts and Design major in Visual Communication',
                    'Bachelor of Science in Aerospace Engineering',
                    'Bachelor of Science in Architecture',
                    'Bachelor of Science in Automotive Engineering',
                    'Bachelor of Science in Biomedical Engineering',
                    'Bachelor of Science in Ceramics Engineering',
                    'Bachelor of Science in Chemical Engineering',
                    'Bachelor of Science in Civil Engineering',
                    'Bachelor of Science in Computer Engineering',
                    'Bachelor of Science in Electrical Engineering',
                    'Bachelor of Science in Electronics Engineering',
                    'Bachelor of Science in Food Engineering',
                    'Bachelor of Science in Geodetic Engineering',
                    'Bachelor of Science in Geological Engineering',
                    'Bachelor of Science in Industrial Engineering',
                    'Bachelor of Science in Instrumentation & Control Engineering',
                    'Bachelor of Science in Interior Design',
                    'Bachelor of Science in Mechanical Engineering',
                    'Bachelor of Science in Mechatronics Engineering',
                    'Bachelor of Science in Naval Architecture and Marine Engineering',
                    'Bachelor of Science in Petroleum Engineering',
                    'Bachelor of Science in Sanitary Engineering',
                    'Bachelor of Science in Transportation Engineering',
                    'Bachelor of Science in Metallurgical Engineering'
                )
            ),
        );
        return $department;
    }
}

if ( ! function_exists('get_gravatar')) {
    function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
    
}
