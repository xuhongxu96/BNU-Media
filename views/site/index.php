<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;

$this->title = '主页';
?>
<div class="site-index">

<?php 
echo Carousel::widget([
	'items' => $slider,
	'options' => [
		'class' => 'slide',
		],
]);
?>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-5">
				<h2>最新微信推文</h2>
				<div id="wxbox" style="display:none;">
				</div>

				<div class="p-more" style="display:none;" id="wxmore"><a href="#" onclick="return false;"><span>查看更多</span></a></div>
            </div>
            <div class="col-lg-7">
                <h2>最新博文展示</h2>
					<iframe width="100%" height="550" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=2&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=5554618491&verifier=42e76b64&dpc=1"></iframe>
            </div>
        </div>

    </div>
</div>
