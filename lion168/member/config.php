<?php
require_once(dirname(__FILE__).'/../include/common.php');
require_once(EK_INC.'/front.func.php');
require_once(EK_INC.'/filter.inc.php');
require_once(EK_INC.'/check.member.php');
//获得当前脚本名称，如果你的系统被禁用了$_SERVER变量，请自行更改这个选项
$ekvodNowurl = $s_scriptName = '';
$ekvodNowurl = GetCurUrl();
$ekvodNowurls = explode('?', $ekvodNowurl);
$s_scriptName = $ekvodNowurls[0];

$isMemberOrProxy="member";//判断是代理还是用户

// 启动 Session 
session_start(); 
// 声明一个名为 admin 的变量，并赋空值。
$_SESSION["isMemberOrProxy"] = "member"; 
$_SESSION["isnametext"] = "会员"; 


//检查是否开放会员功能
if($cfg_consumermb_open=='0')
{
	ShowMsg("系统关闭了会员功能，因此你无法访问此页面！","javascript:;");
	exit();
}
$keeptime = isset($keeptime) && is_numeric($keeptime) ? $keeptime : -1;
$cfg_cl = new MemberLogin($keeptime);

//判断用户是否登录
$myurl = '';
if($cfg_cl->IsLogin())
{
	/*
	//查看用户投注的金额在哪个用户组
	$alltouzhumoney=$cfg_cl->fields['alltouzhumoney'];
	if($alltouzhumoney>$groupdb['creditslower']){
		$rowp = $dsql->GetOne("select groupid from ek_member_group where creditshigher<'$alltouzhumoney' order by groupid desc");
		if(is_array($rowp)){
			$dsql->ExecuteNoneQuery("update ek_member set `groupid`='$rowp[groupid]' where uid='$cfg_cl->M_ID'");
		}
	}*/
	
	$myurl = "/member/index.php?uid=".urlencode($cfg_cl->M_LoginID);
	if(!ereg('^http:',$myurl))
	{
		$myurl = $cfg_basehost.$myurl;
	}
//用户VIP升级判断
	if(is_numeric($cfg_cl->M_Groupid) && $cfg_cl->M_Groupid>0){
		$groupcachefile = EK_ROOT.'/data/cache/cache_group_'.$cfg_cl->M_Groupid.'.php';
		if(!file_exists($groupcachefile)){
			@write_group_cache();
		}
		@require_once($groupcachefile);
	}
		$date2 = strtotime("last Sunday+1days");
		$rowd = $dsql->GetOne("select sum(LiveGameExcludeEvenandTieAmount) as dd from `ek_live_game_bet` where uid='$cfg_cl->M_ID' and addtime>'$date2'");
		$rowt = $dsql->GetOne("select todayLiveGameExcludeEvenandTieAmount as dd from `ek_now_live_game_bet` where uid='$cfg_cl->M_ID'");
		$weeklivetouzhumoney=$rowd[dd]+$rowt[dd];
	if($groupdb['nextgroupid']>0){
		if($weeklivetouzhumoney>=$groupdb['nextcreditshigher']){
			if($dsql->ExecuteNoneQuery("update ek_member set `groupid`='$groupdb[nextgroupid]' where uid='$cfg_cl->M_ID'")){
				$groupcachefile = EK_ROOT.'/data/cache/cache_group_'.$groupdb['nextgroupid'].'.php';
				if(!file_exists($groupcachefile)){
					@write_group_cache();
				}
				@require_once($groupcachefile);
			}
		}
	}

 
}

	// $rowg = $dsql->GetOne("select lastfanshuitime as lastfanshuitime from `ek_member` where uid='".$cfg_cl->fields['uid']."'");
	// if(date('YW',$rowg['lastfanshuitime'])!=date('YW',time()-3600*3)){
		// $date1 = strtotime("last Sunday");
		// $date2 = strtotime("last Sunday-7days");
		// $rowd = $dsql->GetOne("select sum(LiveGameExcludeEvenandTieAmount) as dd from `ek_live_game_bet` where uid='".$cfg_cl->fields['uid']."' and addtime<'$date1' and addtime>'$date2'");
		// if(is_array($rowd)){
			// $TotalResult = $rowd['dd'];
		// }else{
			// $TotalResult = 0;
		// }
		// $fanshuicash=$TotalResult*$groupdb['fanshui'];
		// $fanshuicash=number_format($fanshuicash,2);
		// if($fanshuicash>$groupdb['maxfanshui']) $fanshuicash=$groupdb['maxfanshui'];
		// $dsql->ExecuteNoneQuery("update ek_member set money=money+$fanshuicash,lastfanshuitime='".time()."' where uid='".$cfg_cl->fields['uid']."'");
		// if($fanshuicash>0){
			// $orderid=date('ymdHis').rand(1000,9999);
			// $dsql->ExecuteNoneQuery("INSERT INTO `ek_member_cash_log` (orderid,uid,type,cash,addtime) VALUES ('$orderid','".$cfg_cl->fields['uid']."','11','$fanshuicash','".time()."')");//资金记录
			// $dsql->ExecuteNoneQuery("INSERT INTO `ek_member_incash` (orderid,bankid,uid,`type`,bank,hongli,`check`,operation,state,addtime) VALUES ('$orderid','0','".$cfg_cl->fields['uid']."','11','用户钱包','$fanshuicash','2','2','2','".time()."')");//资金记录
// echo "<script>alert('恭喜！您的周返水奖励【{$fanshuicash} 元】 已经到账！');window.location='index.php';</script>";
	// }
	// }
// }

//现金码洗码
	// $rowg = $dsql->GetOne("select lastfanshuitime as lastfanshuitime from `ek_member` where uid='".$cfg_cl->fields['uid']."'");
	// if(date('YW',$rowg['lastfanshuitime'])!=date('YW',time()-3600*3)){
		// $rowd = $dsql->GetOne("select sum(WeeklyRegularChips) as dd from `regularchips_weekly` where uid='".$cfg_cl->fields['uid']."'");
		// if(is_array($rowd)){
			// $TotalResult = $rowd['dd'];
		// }else{
			// $TotalResult = 0;
		// }
		// $RegularChips=$TotalResult*$groupdb['fanshui'];
		// $RegularChips=round($RegularChips,2);
		// if($RegularChips>$groupdb['maxfanshui']) $RegularChips=$groupdb['maxfanshui'];
		// $dsql->ExecuteNoneQuery("update ek_member set money=money+$RegularChips,lastfanshuitime='".time()."' where uid='".$cfg_cl->fields['uid']."'");
		// if($RegularChips>0){
			// $orderid=date('ymdHis').rand(1000,9999);
			// $dsql->ExecuteNoneQuery("INSERT INTO `ek_member_cash_log` (orderid,uid,type,cash,addtime) VALUES ('$orderid','".$cfg_cl->fields['uid']."','11','$RegularChips','".time()."')");//资金记录
			// $dsql->ExecuteNoneQuery("INSERT INTO `ek_member_incash` (orderid,bankid,uid,`type`,bank,hongli,`check`,operation,state,addtime) VALUES ('$orderid','0','".$cfg_cl->fields['uid']."','11','用户钱包','$RegularChips','2','2','2','".time()."')");//资金记录
// echo "<script>alert('恭喜！您的周返水奖励【{$RegularChips} 元】 已经到账！');window.location='index.php';</script>";
	// }
	// }
 // }

//检查用户是否有权限进行某个操作
function CheckRank($rank=0, $money=0,$gourl='')
{
	global $dsql,$cfg_cl,$cfg_memberurl;
	if(!$cfg_cl->IsLogin())
	{
		if(!$gourl) $gourl=urlencode(GetCurUrl());
		header("Location:/login.php?gourl=".$gourl);
		exit();
	}else{
		if($cfg_cl->M_Groupid < $rank){
			ShowMsg("对不起，您的级别不够访问本页面","-1",0,5000);
			exit();
		}
	}
}

function member($username)
{
    global $db;
    $sql = "SELECT uid,email,username,secques FROM ek_member WHERE username = '$username'";
    $row = $db->GetOne($sql);
    if(!is_array($row)) return ShowMsg("对不起，用户名输入错误！","-1");
    else return $row;
}

//发送邮件；type为INSERT新建验证码，UPDATE修改验证码；
function newmail($mid,$userid,$mailto,$type,$send)
{
	global $dsql,$cfg_adminemail,$cfg_webname,$cfg_basehost,$cfg_basehost;
	$mailtime = time();
	$randval = random(8);
	$mailtitle = $cfg_webname.":密码修改";
	$mailto = $mailto;
	$headers = "From: ".$cfg_adminemail."\r\nReply-To: $cfg_adminemail";
	$mailbody = "亲爱的".$userid."：\r\n您好！感谢您使用".$cfg_webname."网。\r\n".$cfg_webname."应您的要求，重新设置密码：（注：如果您没有提出申请，请检查您的信息是否泄漏。）\r\n本次临时登陆密码为：".$randval." 请于三天内登陆下面网址确认修改。\r\n".$cfg_basehost."/password_find.php?action=getpasswd&id=".$mid;
	if($type == 'INSERT')
	{
		$key = md5($randval);
		$sql = "INSERT INTO `ek_pwd_tmp` (`mid` ,`membername` ,`pwd` ,`mailtime`)VALUES ('$mid', '$userid',  '$key', '$mailtime');";
		if($dsql->ExecuteNoneQuery($sql))
		{
			if($send == 'Y')
			{
				sendmail($mailto,$mailtitle,$mailbody,$headers);
				showmsg('EMAIL修改验证码已经发送到原来的邮箱请查收', 'login.html','','5000');
				exit;
			}
			elseif($send == 'N')
			{
				showmsg('稍后跳转到修改页', $cfg_basehost."/password_find.php?action=getpasswd&amp;id=".$mid."&amp;key=".$randval);
				exit;
			}
		}
		else
		{
			showmsg('对不起修改失败，请联系管理员', 'login.html');
			exit;
		}
	}
	elseif($type == 'UPDATE')
	{
		$key = md5($randval);
		$sql = "UPDATE `ek_pwd_tmp` SET `pwd` = '$key',mailtime = '$mailtime'  WHERE `mid` ='$mid';";
		if($dsql->ExecuteNoneQuery($sql))
		{
			if($send == 'Y')
			{
				sendmail($mailto,$mailtitle,$mailbody,$headers);
				showmsg('EMAIL修改验证码已经发送到原来的邮箱请查收', 'login.php');
				exit;
			}
			elseif($send == 'N')
			{
				showmsg('稍后跳转到修改页', $cfg_basehost."/password_find.php?action=getpasswd&amp;id=".$mid."&amp;key=".$randval);
				exit;
			}
		}
		else
		{
			showmsg('对不起修改失败，请与管理员联系', 'login.html');
			exit;
		}
	}
}

//查询是否发送过验证码,mid为会员ID；userid为会员名称；mailto发送邮件地址；send为Y发送邮件，为N不发送邮件默认为Y
function sn($mid,$userid,$mailto, $send = 'Y')
{
	global $dsql;
	$tptim= (60*10);
	$dtime = time();
	$sql = "Select * From ek_pwd_tmp where mid = '$mid'";
	$row = $dsql->GetOne($sql);
	if(!is_array($row))
	{
		//发送新邮件；
		newmail($mid,$userid,$mailto,'INSERT',$send);
	}

	//10分钟后可以再次发送新验证码；
	elseif($dtime - $tptim > $row['mailtime'])
	{
		newmail($mid,$userid,$mailto,'UPDATE',$send);
	}

	//重新发送新的验证码确认邮件；
	else
	{
		showmsg('对不起，请10分钟后再重新申请', 'login.html');
		exit;
	}
}

//验证码生成函数
function random($length, $numeric = 0)
{
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric)
	{
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	}
	else
	{
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++)
		{
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

//邮件发送函数
function sendmail($email, $mailtitle, $mailbody, $headers)
{
	global $cfg_sendmail_bysmtp, $cfg_smtp_server, $cfg_smtp_username, $cfg_smtp_usermail, $cfg_smtp_password;
	if($cfg_sendmail_bysmtp == '1')
	{
		require_once(EK_INC."/libs/phpmailer/class.phpmailer.php");
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = $cfg_smtp_server;  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $cfg_smtp_username;  // SMTP username
		$mail->Password = $cfg_smtp_password; // SMTP password
		$mail->From = $cfg_smtp_usermail;
		$mail->FromName = $cfg_smtp_username;
		$mail->AddAddress($email);
		$mail->IsHTML(false);
		$mail->CharSet="utf-8";
		$mail->Subject = $mailtitle;
		$mail->Body    = $mailbody;
		if(!$mail->Send())
		{
		   return false;
		}
		return true;
	}
	else
	{
		@mail($email, $mailtitle, $mailbody, $headers);
	}
}

$thisweek_start = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))); 
		$thisweek_start = strtotime($thisweek_start);

$rowo = $dsql->GetOne("select sum(LiveGameExcludeEvenandTieAmount) as lgeet from ek_live_game_bet where uid='".$cfg_cl->fields['uid']."' and addtime > $thisweek_start ");
$rowg = $dsql->GetOne("select todayLiveGameExcludeEvenandTieAmount as tlgeet,todayStakeAmount as tsa from ek_now_live_game_bet where uid='".$cfg_cl->fields['uid']."'");
$rows = $dsql->GetOne("select sum(StakedAmount) as sa,sum(LiveGameExcludeEvenandTieAmount) as lgeet from ek_live_game_bet where uid='".$cfg_cl->fields['uid']."'");
$allweeklivetouzhumoney=$rowo['lgeet']+$rowg['tlgeet'];
$allStakedAmount=$rows['sa']+$rowg['tsa'];
$allLiveGameExcludeEvenandTieAmount=$rows['lgeet']+$rowg['tlgeet'];
$rowq = $dsql->GetOne("SELECT active FROM ek_active where id='1'");
$activenum=$rowq['active'];
$active=$cfg_cl->fields['active'];
if($active>=$activenum){$activenm="<a title='活跃用户-活跃指数$active'><img src='images\/active.gif' width='16' height='16'></a>";}else{$activenm="<a title='非活跃用户-活跃指数$active'><img src='images\/active2.gif' width='16' height='16'></a>";}
$t->assign('username',$cfg_cl->fields['username']);
$t->assign('truename',$cfg_cl->fields['truename']);
$t->assign('activenm',$activenm);
$t->assign('money',$cfg_cl->fields['money']);
$t->assign('scores',$cfg_cl->fields['scores']);
$t->assign('allStakedAmount',$allStakedAmount);
$t->assign('credits',round($allStakedAmount/100));
$t->assign('allweeklivetouzhumoney',$allweeklivetouzhumoney);
$t->assign('todayLiveGameExcludeEvenandTieAmount',$rowg['tlgeet']);
$t->assign('allLiveGameExcludeEvenandTieAmount',$allLiveGameExcludeEvenandTieAmount);
$t->assign('toplogintime',MyDate('H:i',$cfg_cl->fields['logintime']));
$t->assign('toploginip',$cfg_cl->fields['loginip']);
$t->assign('groupname',$groupdb['grouptitle']);
$t->assign('noticear',get_notice_list('1'));
$t->assign('newsar',get_news_list('1'));
$t->assign('nowtime',MyDate('H:i',time()));
$t->assign('mdnowtime',MyDate('H:i',time(),'+8'));
$tmount=getHGmoney($_SESSION['userInfo']['username'],$_SESSION['userInfo']['truename']);
$tmount = number_format($tmount,2); 
$t->assign('tmount',$tmount);
$t->assign("balance",number_format($tmount+$_SESSION['userInfo']['money'],2));