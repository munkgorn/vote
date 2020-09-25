<?php
class Controller{
    public function view($path='',$data=array()){
        $absolute_path = '';
        if(!check_admin_path()){
            $absolute_path = BASE_CATALOG.'view/'.THEME.'/'.$path.'.php';
        }else{
            $absolute_path = BASE_CATALOG_ADMIN.'view/'.THEME.'/'.$path.'.php';
        }
        if(file_exists($absolute_path)){
            extract($data);
            // if($path!="common/header" or $path!="common/footer"){
           
                if(!check_admin_path()){
                    $common_path = BASE_CATALOG.'controller/common.php';
                }else{
                    $common_path = BASE_CATALOG_ADMIN.'controller/common.php';
                }
                require_once($common_path);
             $arr_bypass = array('common/header','common/footer');
            if(!in_array($path,$arr_bypass)){
                $common = new CommonController();
                $data_header = array(
                    'title' => (isset($title)?$title:WEB_NAME)
                );
                $common->header($data_header);
                require_once($absolute_path);
                $common->footer();
            }
        }else{
            echo 'File view/'.$absolute_path.' Not found!';
            exit();
        }
    }
    public function render($path='',$data=array()){
        // $absolute_path = '';
        // if(!check_admin_path()){
        //     $absolute_path = BASE_CATALOG.'view/'.THEME.'/'.$path.'.php';
        // }else{
        //     $absolute_path = BASE_CATALOG_ADMIN.'view/'.THEME.'/'.$path.'.php';
        // }
        // if(file_exists($absolute_path)){
            $absolute_path = '';
            if(!check_admin_path()){
                $absolute_path = BASE_CATALOG.'view/'.THEME.'/'.$path.'.php';
            }else{
                $absolute_path = BASE_CATALOG_ADMIN.'view/'.THEME.'/'.$path.'.php';
            }
            if(file_exists($absolute_path)){
                extract($data);
                require_once($absolute_path);
            }
            // if($path!="common/header" or $path!="common/footer"){
           
            //     if(!check_admin_path()){
            //         $common_path = BASE_CATALOG.'controller/common.php';
            //     }else{
            //         $common_path = BASE_CATALOG_ADMIN.'controller/common.php';
            //     }
            //     require_once($common_path);
            //  $arr_bypass = array('common/header','common/footer');
            // if(in_array($path,$arr_bypass)){
            //     $common = new CommonController();
            //     $common->header();
            //     require_once($absolute_path);
            //     $common->footer();
            // }
        // }else{
        //     echo 'File view/'.$absolute_path.' Not found!';
        //     exit();
        // }
    }
    public function model($path){
        require_once(BASE.'system/db/'.DB.".php");
        if(!check_admin_path()){
            $absolute_path = BASE_CATALOG.'model/'.$path.'.php';
        }else{
            $absolute_path = BASE_CATALOG_ADMIN.'model/'.$path.'.php';
        }
        require_once($absolute_path);
        $string_model = ucfirst(strtolower($path))."Model";
        $model = new $string_model();
        return $model;
    }
    public function json($data){
        header("Content-type:application/json");
        echo json_encode($data);
    }
    public function redirect($route){
        header('location: index.php?route='.$route);
    }
    public function setTitle(){
        
    }
}