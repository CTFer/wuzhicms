<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <link rel="icon" href="../../favicon.ico">
    <title>注册</title>
    <!--cs-->
<link type="text/css" rel="stylesheet" href="<?php echo R;?>guandian/bootstrap.css">
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
<body>

<div class="header-mobile" >
    <a href="javascript:history.back();">
        <span></span>
    </a>
    <h2>会员注册</h2>
</div>


<div class="container login">
    <div class="verticalcenter"  style="padding-left: 16px; padding-right: 16px;">
        <div class="row">
                    <div class="col-xs-2"> </div>
                    <form action="" method="post" id="form-register" name="form-register" class="form-horizontal">

                        <input type="hidden" name="modelid" id="setmodelid" value="10">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="mobile" value="<?php echo $mobile;?>">
                        <div class="form-group">
                            <div class="col-xs-12 ">
                                <input type="text" name="username" class="form-control" placeholder="请输入用户名" datatype="/^[a-z0-9\u4E00-\u9FA5\uf900-\ufa2d\-]{2,20}$/i" errormsg="手机号、字母、汉字" sucmsg="OK" ajaxurl="index.php?m=member&f=index&v=public_check_user">
                                <span class="Validform_checktip"><!--请输入手机号码--></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 ">
                                <input type="text" id="email" name="email" class="form-control" placeholder="请输入邮箱" datatype="e" errormsg="请输入正确的邮箱" sucmsg="OK" ajaxurl="index.php?m=member&f=index&v=public_check_email">
                                <span class="Validform_checktip"><!--请输入正确的邮箱--></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <!--<label class="control-label col-xs-3"> </label>-->
                            <div class=" col-xs-12">
                                <input  type="submit" name="submit2" class="btn btn-primary btn-lg btn-block" value=" 注册 " />
                            </div>
                        </div>
                    </form>
            </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo R;?>js/dialog/ui-dialog.css" />
<div id="protocol" class="ui-popup ui-popup-modal ui-popup-show ui-popup-focus" style="position: fixed; z-index: 100; left: 10%; top: 10%;display: none;">
    <div class="ui-dialog">
        <div class="ui-dialog-header">
            <button class="ui-dialog-close" onclick="$('#protocol').hide()">×</button>
            <div class="ui-dialog-title">注册协议</div>
        </div>
        <p style="margin:20px;"><?php echo nl2br($this->setting['protocol'])?></p>
        <div class="col-xs-12 text-center" style="margin-bottom:20px;">
            <input style="width: 100px;" onclick="$('#protocol').hide()" type="submit" name="submit" class="btn btn-default btn-sm" value=" 关闭 ">
        </div>
    </div>
</div>


<div class="login--bottom">
    <div class="container">
        <div class="col-xs-12" style="text-align: center">观点 © 2010－2015 guandian.cn, All Rights Reserved</div>
    </div>
</div>

<script type="text/javascript">
    function ch_type(type,obj) {
        $('.stypeclass').removeClass('active');
        $(obj).addClass('active');

        $("#setmodelid").val(type);
        if(type==10) {
            $("#companyname").attr('type','hidden');
            $("#worktype").attr('type','hidden');
            $("#d_companyname").css('display','none');
            $("#d_worktype").css('display','none');

        } else {
            $("#companyname").attr('type','text');
            $("#worktype").attr('type','text');
            $("#d_companyname").css('display','');
            $("#d_worktype").css('display','');
            if(type==11) {
                $("#f_companyname").html('公司名称');
            }
        }
    }
    $(function(){
        <?php if($GLOBALS['modelid']) { ?>
            $("#modelid23").click();
            <?php } ?>
                $(".form-horizontal").Validform({
                    tiptype:function(msg,o,cssctl){
                        var objtip=o.obj.siblings("span");
                        cssctl(objtip,o.type);
                        objtip.text(msg);
                    },
                    ignoreHidden:true,
                    dragonfly:false,
                    tipSweep:false,
                    showAllError:false,
                    postonce:true,
                    ajaxPost:false,
                    beforeCheck:function(curform){
                        //console.log(curform);
                        //在表单提交执行验证之前执行的函数，curform参数是当前表单对象。
                        //这里明确return false的话将不会继续执行验证操作;

                    },
                    beforeSubmit:function(curform){
                        //在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
                        //这里明确return false的话表单将不会提交;

                        return true;
                    },
                    callback:function(data){

                        //返回数据data是json对象，{"info":"demo info","status":"y"}
                        //info: 输出提示信息;
                        //status: 返回提交数据的状态,是否提交成功。如可以用"y"表示提交成功，"n"表示提交失败，在ajax_post.php文件返回数据里自定字符，主要用在callback函数里根据该值执行相应的回调操作;
                        //你也可以在ajax_post.php文件返回更多信息在这里获取，进行相应操作；
                        //ajax遇到服务端错误时也会执行回调，这时的data是{ status:**, statusText:**, readyState:**, responseText:** }；

                        //这里执行回调操作;
                        //注意：如果不是ajax方式提交表单，传入callback，这时data参数是当前表单对象，回调函数会在表单验证全部通过后执行，然后判断是否提交表单，如果callback里明确return false，则表单不会提交，如果return true或没有return，则会提交表单。
                    }
                });
            });
//	注册协议 先简单alert一下 后期统一UI处理
            function showProtocol() {
                var width = $(window).width();
                var height = $(window).height();
                $('#protocol > div').css({ width:(width*0.8)+'px', height:(height*0.8)+'px', overflow:'auto' });
                $('#protocol').show();
            }
</script>


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