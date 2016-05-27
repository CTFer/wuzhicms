<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head lang="zh-CN">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<title>浏览图片-Powered by wuzhicms</title>
	<link type="text/css" rel="stylesheet" href="<?php echo R;?>member/css/bootstrap.css">

	<link href="<?php echo R;?>css/bootstrapreset.css" rel="stylesheet" />
	<link href="<?php echo R;?>css/pxgridsicons.min.css" rel="stylesheet" />
	<script type="text/javascript">
		var cookie_pre="<?php echo COOKIE_PRE;?>";var cookie_domain = '<?php echo COOKIE_DOMAIN;?>';var cookie_path = '<?php echo COOKIE_PATH;?>';
	</script>
	<script type="text/javascript" src="<?php echo R;?>member/js/jquery.min.js"></script>
	<script src="<?php echo R;?>js/base.js"></script>

	<![endif]-->

	<style>
		/* 图片管理样式 */
		#online {
			width: 100%;
			height: 396px;
			padding: 10px 0 0 0;
		}
		#online #imageList{
			width: 100%;
			height: 100%;
			overflow-x: hidden;
			overflow-y: auto;
			position: relative;
		}

		#online ul {
			display: block;
			list-style: none;
			margin: 0;
			padding: 0;
		}
		#online li {
			float: left;
			display: block;
			list-style: none;
			padding: 0;
			width: 152px;
			height: 183px;
			margin: 0 0 9px 9px;
			*margin: 0 0 6px 6px;
			background-color: #eee;
			overflow: hidden;
			cursor: pointer;
			position: relative;
		}
		#online li.clearFloat {
			float: none;
			clear: both;
			display: block;
			width:0;
			height:0;
			margin: 0;
			padding: 0;
		}
		#online li img {
			cursor: pointer;
		}
		#online li .icon {
			cursor: pointer;
			width: 152px;
			height: 183px;
			position: absolute;
			top: 0;
			left: 0;
			z-index: 2;
			border: 0;
			background-repeat: no-repeat;
		}
		#online li .icon:hover {
			width: 152px;
			height: 183px;
			border: 3px solid #1094fa;
		}
		#online li.selected .icon {
			background-image: url(images/success.png);
			background-image: url(images/success.gif)\9;
			background-position: 75px 75px;
		}
		#online li.selected .icon:hover {
			width: 107px;
			height: 107px;
			border: 3px solid #1094fa;
			background-position: 72px 72px;
		}
		.max_h{height: 115px;overflow: hidden;}
		.list div{font-size:12px;padding:5px 5px;overflow: hidden;}
		.title {font-weight: 600;width:140px;}
		@media screen and (max-width: 767px) {
			.form-control {
				width: 100px;
				display: inline-block;
				margin-bottom: 8px;
			}
		}
	</style>
</head>
<body>
<section class="wrapper">
	<div class="panel mr0">
		<header class="panel-heading"><a href="index.php?m=attachment&file=index&v=ckeditor&action=listimage&CKEditor=<?php echo $CKEditor;?>&CKEditorFuncNum=<?php echo $CKEditorFuncNum;?>&langCode=zh-cn" class="btn btn-info btn-sm" id="index-listing"><i class="icon-gears2 btn-icon"></i>图片列表</a> <!--<a href="" class="btn btn-default btn-sm" id="index-add"><i class="icon-plus btn-icon"></i>添加附件</a>--> </header>
		<header class="panel-heading">
			<form action="" method="get" target="_self" class="form-inline" onsubmit="return file_search();">
				<?php
		$options['0'] = '文件名';
		$options['1'] = '文件夹名称';
		echo WUZHI_form::select( $options, $keytype , 'id="keytype" class="form-control" ');?>
				<input type="text" class="filename" id="keywords" value="<?php echo $keywords;?>" placeholder="请输入关键字">
				上传时间<?php echo WUZHI_form::calendar('start',$GLOBALS['start'],1);?>- <?php echo WUZHI_form::calendar('end',$GLOBALS['end'],1);?>
				&nbsp;上传人 <input type="text" class="uploaduser" value="<?php echo $username;?>" id="username">
				&nbsp;

				<button type="submit" class="btn btn-info btn-sm">搜索</button>
			</form>
		</header>
<!-- ---------------------------------- -->
<!-- top -->
<!-- ---------------------------------- -->
</div>
</section>

<div id="online" class="panel focus">
	<div id="imageList">
		<ul class="list">
			<?php $n=1;if(is_array($result)) foreach($result AS $r) { ?><li><div class="max_h"><img width="142" src="<?php echo $r['url'];?>"></div><div class="title"><?php echo $r['title'];?></div><div><?php echo $r['mtime'];?><br><?php echo $r['filesize'];?></div><span class="icon" onclick="returnFileUrl('<?php echo $r['url'];?>');"></span> </li><?php $n++;}?>
		</ul>
	</div>
</div>
<script>
	function getUrlParam( paramName ) {
		var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
		var match = window.location.search.match( reParam );

		return ( match && match.length > 1 ) ? match[1] : null;
	}
	// Simulate user action of selecting a file to be returned to CKEditor.
	function returnFileUrl(fileUrl) {
		var funcNum = getUrlParam( 'CKEditorFuncNum' );
		window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
		window.close();
	}

	var htmls = '';
	var is_load = true;
	var keytype = 0;
	var keywords = '';
	function get_listimage(page) {
		if(is_load) {
			is_load = false;
			$.getJSON("/index.php?m=attachment&file=index&v=ckeditor&action=listimage", {returnjson:1,page: page, keytype: keytype,keywords:keywords}, 			function(json) {
				$.each(json, function( index, value ) {
					htmls += '<li><div class="max_h"><img width="142" src="'+value.url+'"></div><div class="title">'+value.title+'</div><div>'+value.mtime+'<br>'+value.filesize+'</div><span class="icon" onclick="returnFileUrl(\''+value.url+'\');"></span> </li>';
				});
				$("#imageList ul").append(htmls);
				htmls = '';
				is_load = true;
			});
		}
	}
	var page = 1;
	$(document).ready(function (){
		var nScrollHight = 0; //滚动距离总长(注意不是滚动条的长度)
		var nScrollTop = 0;   //滚动到的当前位置
		var nDivHight = $("#imageList").height();
		$("#imageList").scroll(function(){
			nScrollHight = $(this)[0].scrollHeight;
			nScrollTop = $(this)[0].scrollTop;
			if(nScrollTop + nDivHight >= nScrollHight)
				page+=1;
			get_listimage(page);
		});
	});
	function file_search() {
		keytype = $("#keytype").val();
		keywords = $("#keywords").val();
		$("#imageList ul").html('');
		get_listimage(1);
		return false;
	}


</script>