<?php defined('IN_WZ') or exit('No direct script access allowed'); ?><?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","head",TPLID); ?>


<div class="video-content-top">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <h3 class="margin_bottom6  margin_top10"><?php echo $title;?></h3>
                <div class="text-center">
                    <iframe height=580 width=100% src="http://player.youku.com/embed/<?php echo $play_code;?>&from=wuzhicms" frameborder=0 allowtransparency="true" allowfullscreen="true" allowfullscreenInteractive="true"></iframe>
                </div>
            </div>

        </div>
    </div>
</div>

<?php if(!isset($siteconfigs)) $siteconfigs=get_cache('siteconfigs'); include T("content","foot",TPLID); ?>