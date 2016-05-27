<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <link rel="icon" href="../../favicon.ico">
    <title>重置密码</title>
    <!--cs-->
    <link type="text/css" rel="stylesheet" href="<?php echo R;?>t3/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="<?php echo R;?>css/login_style.css">
    <link href="<?php echo R;?>css/validform.css" rel="stylesheet">
    <!--js-->
    <script type="text/javascript" src="<?php echo R;?>member/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo R;?>member/js/bootstrap.js"></script>
    <script src="<?php echo R;?>js/validform.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.wuzhicms.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="<?php echo R;?>js/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background: #ffffff">


<div class="header-mobile" >
    <a href="javascript:history.back();">
        <span></span>
    </a>
    <h2>重置密码</h2>
</div>

<div class="container login">
    <div class="verticalcenter"  style="padding-left: 16px; padding-right: 16px;">
        <div class="row">
            <form action="" method="post" id="form-register" name="form-register" class="form-horizontal">
                <input type="hidden" name="modelid" id="setmodelid" value="10">
                <div class="form-group">
                    <!--<label class="control-label col-xs-3">手机号码</label>-->
                    <div class="col-xs-12 ">
                        <input   type="text" id="mobile" name="mobile" class="form-control" placeholder="请输入手机号码" datatype="m" errormsg="请输入正确的手机号码" sucmsg="OK" ajaxurl="index.php?m=member&f=index&v=public_check_mobile">
                        <span class="Validform_checktip"><!--请输入手机号码--></span>
                    </div>
                </div>
                <div class="form-group">
                    <!--<label class="control-label col-xs-3">图片验证码</label>-->
                    <div class="col-xs-12 ">
                        <input   type="text" name="checkcode" class="form-control" id="Verificationcode" placeholder="请输入验证码" datatype="*4-4"	errormsg="请输入验证码" sucmsg="输入正确" onfocus="if($('#code_img').attr('src') == '<?php echo R;?>images/logincode.gif')$('#code_img').attr('src', '<?php echo WEBURL;?>api/identifying_code.php?w=112&h=40&rd='+Math.random());" ajaxurl="api/identifying_code_check.php"/>
                        <img  style=" margin-top:2px; position: absolute; top: 0;right: 10px; max-height: 35px;"  src="<?php echo R;?>images/logincode.gif" id="code_img" alt="点击刷新"	onclick="$(this).attr('src', '<?php echo WEBURL;?>api/identifying_code.php?w=112&h=40&rd='+Math.random());">
                        <span class="Validform_checktip"><!--请输入验证码--></span>
                    </div>
                </div>

                <div class="form-group">
                    <!--<label class="control-label col-xs-3">短信验证码</label>-->
                    <div class="col-xs-12 ">
                        <input   type="text" class="form-control" id="smscode" placeholder="请输入手机收到的短信验证码" name="smscode" datatype="*4-4" errormsg="请输入短信验证码" sucmsg="输入正确" ajaxurl="api/sms_check.php">
                        <button style=" margin-top:2px; position: absolute; top: 0;right: 10px; max-height: 35px; border: none; border-left:1px solid #EEEEEE;  background: #F5F5F5; border-radius: 0;"  type="button" name="getsms" class="btn btn-default" onclick="send_sms();">免费获取验证码</button>
                        <span class="Validform_checktip"><!--请输入短信验证码--></span>
                    </div>
                </div>
                <div class="form-group">
                    <!--<label class="control-label col-xs-3"> </label>-->
                    <div class=" col-xs-12">
                        <input  type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value=" 确认提交 " />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="login--bottom">
    <div class="container">
        <div class="col-xs-12" style="text-align: center">版权所有 @ wuzhicms
		</div>
    </div>
</div>

<script type="text/javascript">
function send_sms() {
	if($("#mobile").val()=='') {
		var d = dialog({
			content: '手机号不能为空！'
		});
		d.show();
		setTimeout(function () {
			d.close().remove();
			$("#mobile").focus();
		}, 2000);
		return false;
	}
	if($("#Verificationcode").val()=='') {
		var d = dialog({
			content: '验证码不能为空！'
		});
		d.show();
		setTimeout(function () {
			d.close().remove();
			$("#Verificationcode").focus();
		}, 2000);
		return false;
	}
	var mobile = $("#mobile").val();
	var checkcode = $("#Verificationcode").val();
	$.get("index.php?m=sms&f=sms&v=sendsms", { mobile: mobile,checkcode:checkcode, time: Math.random()},
			function(data){
				if(data==201) {
					alert('手机号错误');
				} else if(data==202) {
					alert('验证码错误');
				} else if(data==0) {
					var d = dialog({
						content: '短信发送成功，请将收到的短信验证码填写到“短信验证码”'
					});
					d.show();
					setTimeout(function () {
						d.close().remove();
					}, 5000);
				} else {
					alert('短信发送失败，请重试，或者联系客服！');
				}
			});

}
	function check_form() {
		var smscode = $("#smscode").val();
		if(smscode=='') {
			var d = dialog({
				content: '请输入收到的手机短信验证码'
			});
			d.show();
			setTimeout(function () {
				d.close().remove();
			}, 5000);
			$("#smscode").focus();
			return false;
		}
	}
</script>
</body>
</html>