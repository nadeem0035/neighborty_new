<?php

//Dynamically add Javascript files to header page
if (!function_exists('add_js')) {

    function add_js($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('essential_js');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $header_js[] = $item;
            }
            $ci->config->set_item('essential_js', $header_js);
        } else {
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('essential_js', $header_js);
        }
    }

}

if (!function_exists('remove_js')) {

    function remove_js($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('essential_js');
        $remove_js = array();

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $remove_js[] = $item;
            }

        } else {
            $remove_js[] = $file;
        }
        $ci->config->set_item('essential_js', array_diff($header_js,$remove_js));
    }

}

//Dynamically add CSS files to header page
if (!function_exists('add_css')) {

    function add_css($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('essential_css');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $header_css[] = $item;
            }
            $ci->config->set_item('essential_css', $header_css);
        } else {
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('essential_css', $header_css);
        }
    }

}

if (!function_exists('remove_css')) {

    function remove_css($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('essential_css');
        $remove_css = array();

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $remove_css[] = $item;
            }

        } else {
            $remove_css[] = $file;
        }
        $ci->config->set_item('essential_css', array_diff($header_css,$remove_css));
    }

}

if (!function_exists('put_css_headers')) {

    function put_css_headers() {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('essential_css');


        foreach ($header_css AS $item) {
            $str .= '<link rel="stylesheet" href="' . base_url() . 'assets/css/' . $item . '" type="text/css" />' . "\n";
        }

        echo $str;
    }

}


if (!function_exists('put_js_footer')) {

    function put_js_footer() {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('essential_js');

        foreach ($footer_js AS $item) {
            $str .= '<script type="text/javascript" src="' . base_url() . 'assets/js/' . $item . '"></script>' . "\n";
        }

        echo $str;
    }

}


//Dynamically add extra js
if( !function_exists('set_extra_js') )
{

    function set_extra_js($str = '')
    {
        $ci = &get_instance();
        $extra_js = $ci->config->item('extra_js');
        if (empty($str))
        {
            return;
        }
        $final_extra_js = $extra_js . " " . $str;
        $ci->config->set_item('extra_js', $final_extra_js);
    }
}

if (!function_exists('put_extra_js')) {

    function put_extra_js() {
        $str = '';
        $ci = &get_instance();
        $extra_js = $ci->config->item('extra_js');
        $str = $extra_js;
        echo $str;
    }

}






if (!function_exists('put_js_in_dashboard_footer')) {

    function put_js_in_dashboard_footer() {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('dashboard_js');

        foreach ($footer_js AS $item) {
            $str .= '<script type="text/javascript" src="' . base_url() . 'assets/js/' . $item . '"></script>' . "\n";
        }

        echo $str;
    }

}


if (!function_exists('add_property_js')) {

    function add_property_js() {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('property_js');

        foreach ($footer_js AS $item) {
            $str .= '<script type="text/javascript" src="' . base_url() . 'assets/js/' . $item . '"></script>' . "\n";
        }

        echo $str;
    }

}


if (!function_exists('add_appointments_js')) {

    function add_appointments_js() {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('appointments_js');

        foreach ($footer_js AS $item) {
            $str .= '<script type="text/javascript" src="' . base_url() . 'assets/js/' . $item . '"></script>' . "\n";
        }

        echo $str;
    }

}
