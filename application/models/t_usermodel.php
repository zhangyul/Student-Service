<?php

	//对学生数据库的操作
	class T_usermodel extends CI_Model{
	
		//用户绑定（写入用户微信openid到数据库）
		function adduser($u_num,$openid){
			//UPDATE 表名称 SET 列名称 = 新值 WHERE 列名称 = 某值
			$sql = "UPDATE s_teacher SET t_wxid = '".$openid."' WHERE t_id = '".$u_num."'";
			$this->db->query($sql);
            return $this->db->affected_rows();
		}
	
		//查询用户信息，确定用户输入的学号和姓名在数据库中
		public function queryuser($u_name,$u_num,$u_id){
				
			$sql = "SELECT * FROM s_teacher WHERE t_name = '".$u_name."' AND t_id =' ".$u_num."'";
			$query = $this->db->query($sql);
			if($query->result())
				return true;
			else
				return false;
		}
	
		//查询用户openid是否绑定
		function queryopenid(){
				
			$sql = "SELECT * FROM s_teacher WHERE t_wxid = '".$openid."'";
			$query = $this->db->query($sql);
			if($query->result())
				return true;
			else
				return false;
		}
	
		function deluser(){
			//用户解绑（从数据库中删除用户openid）
			$sql = "DELEATE * FROM s_teacher WHERE t_wxid = '".$openid."'";
			$query = $this->db->query($sql);
			if($query->result())
				return true;
			else
				return false;
						
		}
	}