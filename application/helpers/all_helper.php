<?php if (!defined('BASEPATH')) exit(header("Location: /"));
/**
 * All Helper
 *
 * @author		rifky@flashsonic.com
 *
 * Modified 03 December 2009
 */
function warnaPar($val){
    if($val > 84){
        $color  = "green";   
    }else if($val < 65){
        $color  = "red";
    }else{
        $color  = "orangeDark";
    }
    return $color;
}
function debug($data, $with_profiler = false)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	
	$CI =& get_instance(); 
	
	if($with_profiler){
		$CI->output->enable_profiler(TRUE);
	}
}
function statusIcon($statusId){
	if($statusId == 1){		
		$status = '<i style="color:green;" class=" fa-2x fa-lg fa fa-check"></i>';
	}else{
		$status = '<i style="color:red;" class=" fa-2x fa-lg fa fa-times"></i>';
	}
	echo $status;
}
function tumb($file_locate,$alt){
	$img = '<span class="img-head" ><img src="'.base_url().'upload/'.$file_locate.'" alt="'.$alt.'" class="img" height="50px"/> </span>';
	return $img;
}
function upload($file,$path,$allow){
    $ci = &get_instance();

    if($path){
        $config['upload_path'] = $path;
    } else {
        $config['upload_path'] = './upload';
    }

    $config['remove_spaces'] = true; 
    $config['overwrite'] = false;

    if($allow){
            $config['allowed_types'] = $allow;
    } else {
            $config['allowed_types'] = 'csv|xls|xlsx|ppt|pptx|doc|docx|pdf|png|jpg|jpeg';
    }
    $ci->load->library('upload', $config);

    if (!$ci->upload->do_upload($file)) {
            $error = array('error' => $ci->upload->display_errors());
            debug($error);
    } else {
            return $ci->upload->data();
    }
}
function ajaxBtn($warna, $id, $funct, $icon)
{
	$btn = "<button type='button' id ='".$id."' onClick='".$funct."' class='btn btn-".$warna." btn-xs'>
	  <i class='fa fa-".$icon."'></i>
	</button>";
	return $btn;
}
function linkBtn($warna, $link, $word)
{
	$btn = '<a class="btn btn-'.$warna.' btn-xs" href="'.$link.'" role="button">'.$word.'</a>';
	return $btn;
}
function load_mainmenu($path_menu = ""){
	if($path_menu == "dashboard" or empty($path_menu) ){
		$menu = "dashboard";
	}else{
		$menu = explode("|", $path_menu);
	}

    $CI =& get_instance();    
    
    $CI->load->model("menu_model");
    
    $CI->load->library("authlogin");
    $sess_data 	= $CI->authlogin->check_session(); 
    $group_id = $sess_data["group_id"];
    if(empty($group_id)){
    	$group_id = 1;
    }
    $parent_menu = $CI->menu_model->load_mainmenu($group_id);
    
	$result['base_link']		= base_url().index_page();
	$result['parent_menu']      = $parent_menu;
	$result['all_session']		= $sess_data;
	$CI->load->view("menu", $result);

}

function load_submenu($parent_menu){
	$CI =& get_instance();    
    
    $CI->load->model("menu_model");
    $CI->load->library("authlogin");
    $sess_data 	= $CI->authlogin->check_session(); 
    $result = $CI->menu_model->load_submenu($parent_menu);
	return $result;
}

function load_prices($cust, $item){
	if(!empty($cust) and !empty($item)){
		$CI =& get_instance();    
    
	    $CI->load->model("admins_management", "am");
		$CI->load->model("trans_management", "tm");				
		
		$cat_result = $CI->am->load_item($item);
		if(!empty($cat_result)){
			$cat = $cat_result[0]->cat_id;
		
			# load customer price
			$price = 0;
			$price = $CI->tm->load_cust_price($cust, $cat);
			
			# load default price	
			if(empty($price) or $price == 0){
				$price = $CI->tm->load_cat_price($cat);
			}
			
			return $price;	
		}else{
			return 0;
		}
		
	}else{
		return 0;
	}	
}

function terbilang_kata($x){
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = terbilang_kata($x - 10). " belas";
    } else if ($x <100) {
        $temp = terbilang_kata($x/10)." puluh". terbilang_kata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . terbilang_kata($x - 100);
    } else if ($x <1000) {
        $temp = terbilang_kata($x/100) . " ratus" . terbilang_kata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . terbilang_kata($x - 1000);
    } else if ($x <1000000) {
        $temp = terbilang_kata($x/1000) . " ribu" . terbilang_kata($x % 1000);
    } else if ($x <1000000000) {
        $temp = terbilang_kata($x/1000000) . " juta" . terbilang_kata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = terbilang_kata($x/1000000000) . " milyar" . terbilang_kata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = terbilang_kata($x/1000000000000) . " trilyun" . terbilang_kata(fmod($x,1000000000000));
    }      
        return $temp;
}

/*
if(!empty($parent_menu)){
        $default_menu = $parent_menu[0]->menu_id;
		if($menu == "dashboard"){
			$sub_menu = $CI->menu_model->load_submenu($group_id, $parent_menu[0]->menu_id); 
			/*
			
			if(!empty($sub_menu)){
				redirect($sub_menu[0]->menu_path);	
			}else{
				redirect($parent_menu[0]->menu_path);	
			}
			#
			
			
		}else{
			/*foreach($parent_menu as $theitem){            
				if($theitem->menu_id == $menu[0]){
					$default_menu = $theitem->menu_id;
					$default_path = $theitem->menu_path;
					break;
				}
			}
			#

			$no = 0;
			foreach($parent_menu as $theitem){
				$sub_menu = $CI->menu_model->load_submenu($group_id, $theitem->menu_id); 
				if(!empty($sub_menu)){
					#$parent_menu[$no]->menu_path = $sub_menu[0]->menu_path;
				}
				
				if($theitem->menu_id == $menu[0]){
					$default_menu = $theitem->menu_id;
				}
				$no++;
			}
		}
		
        
    }
    $check_session = $CI->session->userdata("SONIC_ADMIN_USERNAME");
    if(!empty($check_session)){
	    $sub_menu = $CI->menu_model->load_submenu($group_id, $default_menu);    
	
	    if(!empty($sub_menu)){
	        $default_submenu = $sub_menu[0]->menu_id;
	        foreach($sub_menu as $theitem){	
				if($theitem->menu_id == $menu[1]){
					$default_submenu = $theitem->menu_id;
				}        
	        }
	    }
    }     
    */
