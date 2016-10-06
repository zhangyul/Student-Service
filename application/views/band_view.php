<!DOCTYPE html>
<html>
<head>
	<title>绑定..</title>
	<!-- <script type="text/javascript" src="js/openid.js"></script> -->
</head>
<body width="200px">
	<form action="http://9.phpteam2015.applinzi.com/wechat/index.php/band" method="post">
		姓名：
		<input type="text" name="u_name" placeholder="姓名"/><br/>
		学（工）号：
		<input type="text" name="u_num" placeholder="学（工）号" maxlength="18"/><br/>
		<input type="radio" name="u_id" value="teacher" />教师 
		<input type="radio" name="u_id" value="student" /> 学生<br/>
        <input type="hidden" name="wxid" value="<?php echo $openid;?>">
		<input type="submit" value="绑定"/>
		<input type="reset" value="重置">
	</form>

</body>
</html>