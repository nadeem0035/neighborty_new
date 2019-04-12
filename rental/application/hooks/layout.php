<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Layout extends CI_Hooks{
	
	function load_view() {
		
		global $OUT;
	
		$this->CI = & get_instance();
		$output   = $this->CI->output->get_output();
		
//			if(defined('DEFAULT_LAYOUT') && DEFAULT_LAYOUT == 'front_end'){
//				$default = BASEPATH .'../application/views/front_end/common/template.php';
//			} else {
//				
//				$default = BASEPATH .'../application/views/front_end/common/temp/layout.php';
//			}
		$layout = $this->CI->load->file($default, true);
		$layout = str_replace("{body}", $output, $layout);
		$title=NULL;
		if(isset($this->CI->title)){
			$title = $this->CI->title;
			$title = " | ".ucfirst($title);
		}
		$layout = str_replace("{title}", $title, $layout);
		if (isset($this->CI->layout)){
			$layout = $output;
		}
		$OUT->_display($layout);
	}
	
	
	
}  
?>