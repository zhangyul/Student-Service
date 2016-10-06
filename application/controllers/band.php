<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Band  extends CI_Controller {
           function aa(){echo "111";}
		
		function callback(){
			define("TOKEN","callback");
			$APPID='wxce887052e666aae6';
			$REDIRECT_URI='http://10.formtest1.sinaapp.com/Student-Service/index.php/band/out';
			//$scope='snsapi_base';
			$scope='snsapi_userinfo';//需要授权
			$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$APPID.'&redirect_uri='.urlencode($REDIRECT_URI).'&response_type=code&scope='.$scope.'&state=123#wechat_redirect';
			header("Location:".$url);
		}
		
		public function  out(){
			         
			//获取用户openid
			$appid = "wxce887052e666aae6";
			$secret = "e66c39554b05607f307345f593118e03";
			$code = $_GET["code"];
			
			$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$get_token_url);
			curl_setopt($ch,CURLOPT_HEADER,0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			$res = curl_exec($ch);
			curl_close($ch);
			$json_obj = json_decode($res,true);
			$openid = $json_obj['openid'];	//用户微信openid
            
			//加载绑定页面
			$this->load->view('band_view', $json_obj);
		}
		function index(){
			//接受from表单传来的数据
			$u_name = $this->input->get_post('u_name'); //用户名
			$u_num  = $this->input->get_post('u_num');	//学号或工号
			$u_id   = $this->input->get_post('u_id');	//身份(教师或学生)
            $openid = $this->input->get_post('wxid');	//微信openid
            
            //加载model类
			$this->load->model("S_usermodel");
			$this->load->model("T_usermodel");
			$this->load->database();
			//根据u_id判断用户身份
 			/* 学生 */
			if($u_id=='student'){
				
				$result = $this->S_usermodel->queryuser($u_name,$u_num,$u_id);
				
				//判断用户是否存在
	            if($result){
	            	$add = $this->S_usermodel->adduser($u_num,$openid);
	            	if($add)
	            		echo "绑定成功";   //弹出弹框
	            	else 
	            		echo "绑定失败，请重新绑定";//弹出弹框，后跳转到绑定页面
	            }
	            else{
	            	/**echo "输入用户不存在请检查后重新输入";
	            	 * 5秒后跳转 
	            	 *  $this->load->view('band_view', $json_obj);
	            	**/
	            }
			}
			
			/* 老师 */
			else if($u_id=='teacher'){
							
				$result = $this->T_usermodel->queryuser($u_name,$u_num,$u_id);
				
				//判断用户是否存在
	            if($result){
	            	$add = $this->T_usermodel->adduser($u_num,$openid);
	            	if($add)
	            		echo "绑定成功";   //弹出弹框
	            	else 
	            		echo "绑定失败，请重新绑定";//弹出弹框，后跳转到绑定页面
	            }
	            else{
	            	/**echo "输入用户不存在请检查后重新输入";
	            	 * 5秒后跳转 
	            	 *  $this->load->view('band_view', $json_obj);
	            	**/
	            }
			}
        }
	}