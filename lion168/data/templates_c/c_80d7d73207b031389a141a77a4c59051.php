<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_vars['webname']; ?>
</title>
<meta name="keywords" content="<?php echo $this->_vars['cfg_keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_vars['cfg_description']; ?>
" />
<link type="text/css" href="css/style.css" rel="stylesheet">
<script language="javascript" src="js/qq.js"></script>
<script language="javascript" src="js/date.js"></script>
</head>

<body>
 <div class="box">
   <div class="top">
     <div class="top-2"></div>
   
   </div>
   <div class="banner-2" style="height:450px;">
   <div style="background-image:url(images/Password_findv02_07.gif); height:47px; width:786px; margin:0 auto;"></div>
   <div style=" width:786px; margin:0 auto;height: auto; color:#FC0">
   <table width="786" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6"><img src="images/Password_find_05.gif" width="6" height="256" /></td>
    <td width="240" align="center" valign="middle"><a href="index.html"><img src="images/Password_find_12.gif" width="118" height="164" longdesc="index.html" style="border:0""/></a></td>
    <td width="1" align="center" valign="middle"><img src="images/Password_find_09.gif" width="1" height="245" /></td>
    <td width="366" colspan="2" align="center">
      <form id="form1" name="form1" method="post" action=""><table width="300" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="75" align="right">用户名：</td>
        <td colspan="2" align="left">
          <label for="textfield2"></label>
          <input name="username" type="text" id="username" size="23" />
          </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">安全问题：</td>
        <td colspan="2" align="left"><select name="safequestion" style="width:148px;">
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
        </select></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">请输入答案：</td>
        <td colspan="2" align="left"><input name="safeanswer" type="text" id="safeanswer" size="23" /></td>
      </tr>
      <tr>
        <td colspan="3" align="left" style="color:#F00;">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">输入新密码：</td>
        <td colspan="2" align="left"><input name="ps" type="password" id="ps" size="24" /></td>
      </tr>
      <tr>
        <td colspan="3" align="left" style="color:#F00;">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">确认密码：</td>
        <td colspan="2" align="left"><input name="ps1" type="password" id="ps1" size="24" /></td>
      </tr>
      <tr>
        <td colspan="3" align="left" style="color:#F00;">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td width="137"><input type="hidden" value="find" name="action"><input type="submit" name="button" id="button" value="提交"  style="height:25px; width:40px;"/>
          <input type="reset" name="button2" id="button2" value="重置" style="height:25px; width:40px;"/></td>
        <td width="88">&nbsp;</td>
      </tr>
      </table>
      </form>
      </td>
    <td width="6"><img src="images/Password_find_07.gif" width="6" height="256" /></td>
  </tr>
  </table>

   </div>
   <div style="background-image:url(images/Password_find_16.gif); height:47px; width:786px; margin:0 auto;"></div>
   </div>
   <div class="neirong"></div>
<?php echo $this->_fetch_compile("foot.html"); ?>
 </div>
</body>

</html>
