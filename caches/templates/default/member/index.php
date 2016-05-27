<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php $groups = $this->groups;?>
<?php if(!isset($memberinfo)) $memberinfo = $this->memberinfo;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>会员管理中心 - Powered by wuzhicms</title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;<?php echo R;?>member/ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico"> <link href="//cdn.wuzhicms.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo R;?>member/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo R;?>member/css/animate.css" rel="stylesheet">
    <link href="<?php echo R;?>member/css/style.css?v=4.0.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T('member','left'); ?>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2" href="#" style="font-size: 22px;padding: 0px 0px;color: #243544;font-weight: 800;">会员中心 </a><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">

                        <li class="dropdown">

                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"><img src="<?php echo avatar($this->uid, 180);?>" class="avatar">
                                <?php if($memberinfo['username']==$memberinfo['mobile']) { ?><span>您还没有名字，<br><a href="?m=member&f=index&v=set_username" style="border-bottom: 1px dotted #f0ad4e;">起一个名字吧？</a></span><?php } else { ?><i class="memberusericon"></i><span><?php echo $memberinfo['username'];?></span><?php } ?> &nbsp;<span class="caret"></span>
                            </a>
                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                <li class="J_tabShowActive"><a href="<?php echo WEBURL;?>index.php?m=member&f=index&v=profile" class="J_menuItem" onclick="hide_menu(this)">帐号设置</a>
                                </li>
                                <li class="divider"></li>
                                <li class="J_tabCloseAll"><a href="<?php echo WEBURL;?>index.php?m=member&f=index&v=account_safe" class="J_menuItem" onclick="hide_menu(this)">帐号安全</a>
                                </li>
                                <li class="J_tabCloseAll"><a href="<?php echo WEBURL;?>index.php?m=member&f=index&v=edit_password" class="J_menuItem" onclick="hide_menu(this)">修改密码</a>
                                </li>
                                <li class="J_tabCloseAll"><a href="<?php echo WEBURL;?>index.php?m=member&f=index&v=avatar" class="J_menuItem" onclick="hide_menu(this)">设置头像</a>
                                </li>
                                <li class="divider"></li>
                                <li class="J_tabCloseAll"><a href="<?php echo WEBURL;?>index.php?m=member&v=logout"><i class="fa fa fa-sign-out"></i> &nbsp;退出</a>
                                </li>
                            </ul>
                        </li>
<li class="dropdown hide" id="msg_tips">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning" id="total_tips">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li >
                                    <a href="index.php?m=message&f=message&v=sys_listing" id="sys_msg_i" class="J_menuItem">
                                        <div>
                                            <i class="fa fa-volume-up"></i> 您有 <span id="sys_msg_tips">0</span> 条系统未读消息
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="index.php?m=message&f=message&v=listing" id="my_msg_i" class="J_menuItem">
                                        <div>
                                            <i class="fa fa-envelope fa-fw" ></i> 您有 <span id="my_msg_tips">0</span> 条新回复
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="dropdown hidden-xs">

                        </li>
                    </ul>
                </nav>
            </div>
            <!--
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">刷新/关闭<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="refreshTab"><a>刷新</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="index.php?m=member&v=logout" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            -->
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="index.php?m=member&f=index&v=main&set_iframe=1" frameborder="0" data-id="index" seamless></iframe>
            </div>
            <!--<div class="footer">
                <div class="pull-right">Powered by :<a href="http://www.wuzhicms.com/" target="_blank">wuzhicms</a>
                </div>
            </div>
            -->
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>


                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--tab2-->

                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
    </div>

    <!-- 全局js -->
    <script src="<?php echo R;?>member/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo R;?>member/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="<?php echo R;?>member/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo R;?>member/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo R;?>member/js/plugins/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="<?php echo R;?>member/js/hplus.js?v=4.0.0"></script>
    <script type="text/javascript" src="<?php echo R;?>member/js/contabs.js"></script>
    <link rel="stylesheet" href="<?php echo R;?>js/dialog/ui-dialog.css" />
    <script src="<?php echo R;?>js/dialog/dialog-plus.js"></script>

<script>
    setInterval("get_newmessage()", 10000);
    function get_newmessage() {
        $.getJSON("/index.php?m=member&f=json&v=get_newmessage", { time: Math.random()}, function(json){
            if(json.total>0) {
                $("#total_tips").html(json.total);
                $("#sys_msg_tips").html(json.sys_num);
                $("#my_msg_tips").html(json.my_num);

                if(json.sys_num>0) {
                    $("#sys_msg_i").css('color','#E03928');
                } else {
                    $("#sys_msg_i").css('color','');
                }
                if(json.my_num>0) {
                    $("#my_msg_i").css('color','#E03928');
                } else {
                    $("#my_msg_i").css('color','');
                }

                $("#msg_tips").removeClass('hide');
            } else {
                $("#msg_tips").addClass('hide');
            }
        });
    }
    get_newmessage();
</script>
</body>

</html>