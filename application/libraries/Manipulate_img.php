<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manipulate_img
{

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('image_lib');
    }

    public function resize($pic_path,$two,$width,$height)
    {
        $config['source_image'] = $pic_path;
        $config['new_image'] = $two;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
       // $config['height'] = $height;
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->resize();
        $this->CI->image_lib->clear();
        return true;
    }

    public function watermark($pic_path)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $pic_path;
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = 'assets/img/watermark.png';
        $config['wm_opacity'] = 50;
        $config['width'] = '330';
        $config['height'] = '100';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $this->CI->image_lib->initialize($config);
        $this->CI->image_lib->watermark();
        $this->CI->image_lib->clear();
        return true;
    }
}


?>