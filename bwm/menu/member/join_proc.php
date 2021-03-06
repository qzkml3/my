<?php require_once $_SERVER['DOCUMENT_ROOT'] . Setting::WEB_ROOT . "/inc/comm-program.php" ?>
<?php// header("Content-Type: text/javascript;charset=UTF-8");?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . Setting::WEB_ROOT . "/class/service/MemberService.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . Setting::WEB_ROOT . "/class/dao/MemberDao.php"; ?>
<?php
	$req_params = Request::getParameters();
	
	//validate
	Field::isEmpty("닉네임", "f", "nick_name", $req_params);
	Field::isEmpty("이메일", "f", "email", $req_params);
	Field::isEmpty("비밀번호", "f", "password", $req_params);
	Field::isEmpty("비밀번호 확인", "f", "password_confirm", $req_params);
	Field::isNotSame("비밀번호", "f", "password", "password_confirm", $req_params);
	
	//work_flag
	if ($req_params["work_flag"] == "") {
		Js::alertBack(Text::getText("WORK_FLAG_IS_EMPTY"));
	//join
	} else if ($req_params["work_flag"] == "join") {
		$result = MemberService::joinMember($req_params);
		
		if ($result) {
			Js::alert(Text::getText("JOIN_OK"));
			Js::locationReplace("<?=Setting::WEB_ROOT_ADMIN?>?" . Request::getQueryString());
		} else {
			Js::alertBack(Text::getText("JOIN_NO"));
		}
	} else {
		Js::alertBack(Text::getText("INVALID_WORK_FLAG"));
	}
?>