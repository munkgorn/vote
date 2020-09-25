<?php 
	class AjaxController extends Controller {
	    public function register($data=array()) {
	    	$data = array();
	    	if(method_post()){
	    		$this->json($_POST);
	    	}
	    }
	    public function getGirlDetail(){
	    	$result = array();
	    	if(method_get()){
	    		if(!empty(get('no_girl'))){
	    			$no_girl = (int)get('no_girl');
	    			$girl = $this->model('girl');
	    			$result = $girl->getGirlById($no_girl);
	    			if(!empty($result)){
	    				$result['girls_pic'] = (!empty($result['girls_pic'])?IMAGE_PHOTO.$result['girls_pic']:NO_PHOTO);
	    			}
	    		}else if(!empty(get('phone'))){
	    			$girls_phone = get('phone');
	    			$girl = $this->model('girl');
	    			$result = $girl->getGirlByPhone($girls_phone);
	    			if(!empty($result)){
	    				$result['girls_pic'] = (!empty($result['girls_pic'])?IMAGE_PHOTO.$result['girls_pic']:NO_PHOTO);
	    			}
	    		}
	    	}
	    	$this->json($result);
	    }
	    public function insertWorkTime(){
	    	$result = array();
	    	if(method_post()){
	    		$data = $_POST;
	    		$work = $this->model('work');
	    		$result = $work->insertWorkTime($data);
	    		$this->json($result);
	    	}
	    }
	    public function getGirlByShop(){
	    	$result = array();
	    	if(method_get()){
	    		if(get('shop_id')){
	    			$shop_id = (int)get('shop_id');
	    			$girl = $this->model('girl');
	    			$result = $girl->getGirlWoringByshop($shop_id);
	    		}
	    	}
	    	$this->json($result);
	    }
	}
?>