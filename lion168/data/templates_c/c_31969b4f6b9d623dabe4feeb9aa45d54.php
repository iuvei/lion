<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
    <title>找回密码 - 金狮娱乐</title>
    <meta name="keywords" content="keyword ..." />
    <meta name="Description" content="description ..." />
    <!--<link href="favicon.ico" rel="shortcut icon" />-->
    <link href="../css/index/global.css" rel="stylesheet" type="text/css" />
    <style>
	   .yellow { color:#F3C32C; }
	</style>
    <script language="javascript" src="js/qq.js"></script>
<script language="javascript" src="js/date.js"></script>

</head>
<body >
 <?php echo $this->_fetch_compile("index/top.html"); ?>  
 
<div id="maincontent">
 <div id="informscroll">
  <div id="informcontent">
    <?php echo $this->_fetch_compile("index/inc_notice.html"); ?>
    <div class="tel"></div>
    </div>
 </div>
 <div id="listcontent">
   <div class="inners">
    <?php echo $this->_fetch_compile("index/left_menu.html"); ?> 
   <div id="rightcontent">
     <div class="site"><a href="password_find.html">找回密码</a></div>
<div style=" width:100%; height:50px; text-align:left; line-height:50px;">&nbsp;<span class="yellow">提示</span>：*&nbsp;信息必须填写完整</div>
<form id="form1" name="form1" method="post" action="">   
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td align="left" valign="middle" width="100" height="40"><span class="yellow">*</span>&nbsp;用 户 名：</td>
    <td><input name="username" type="text" class="text"  id="username"/></td>
    <td>&nbsp;</td>
  </tr>
    
  
    <tr>
    <td align="left" valign="middle" width="100" height="40"><span class="yellow">*</span>&nbsp;安 全 问 题：</td>
    <td>
     <select name="safequestion" id="safequestion"  style="width:160px;" size="1">
     <option value="">----- 选择一项 -----</option>
	<option value="1">母亲的名字？</option>
	<option value="2">喜爱的书名？</option>
	<option value="3">最喜欢的宠物的名字？</option>
	<option value="4">最喜欢的电影？</option>
	<option value="5">最喜欢做的事？</option>
	<option value="6">最喜欢的运动队名？</option>
	<option value="7">我的儿时英雄？</option>
	<option value="8">我的秘密代码？</option>
	<option value="9">我最喜欢的明星？</option>
	<option value="10">我的梦想？</option>
     </select>
    </td>
    <td>&nbsp;</td>
  </tr>
  
  
    <tr>
    <td align="left" valign="middle" width="100" height="40"><span class="yellow">*</span>&nbsp;答 案：</td>
    <td><input name="safeanswer" id="safeanswer" type="text" class="text"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td align="left" valign="middle" width="100" height="40"><span class="yellow">*</span>&nbsp;新 密 码：</td>
    <td><input name="ps"  id="ps" type="password" class="text" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle" width="100" height="40"><span class="yellow">*</span>&nbsp;密 码 确 认：</td>
    <td><input name="ps1"  id="ps1"  type="password" class="text" /></td>
    <td>&nbsp;</td>
  </tr>

 
      <tr>
      <td height="60" colspan="4" align="center" valign="middle">
      <input type="hidden" value="find" name="action"> 
      <input name="提交" type="image" src="images/index/submit.jpg" />
 <input type="image" src="images/index/r.jpg"  onclick="reset();return false;" />
 
      </td>
      </tr>       
</table>

          
  
</form>
   </div>
   <div class="clear"></div>
   </div>
 </div>
</div>
<?php echo $this->_fetch_compile("index/footer.html"); ?> 
 <script type="text/javascript">				
 $(function(){
   //$(".leftcontent dl dd").hide();
   $(".leftcontent dl dt").click(function(){
   $(".leftcontent dl dd").not($(this).next()).hide();
   $(this).next().slideToggle(500); 
    });
 });
 </script>  
</body>
</html>
