<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;

$this->title = '主页';
$this->params['no_container'] = true;
echo Carousel::widget([
	'items' => $slider,
	'options' => [
		'class' => 'slide',
		],
]);
?>
<div class="site-index container">
    <div class="body-content">

        <div class="text-center row">
            <div class="col-lg-7">
                <h2>北京师范大学 官方微博</h2>
				<iframe width="100%" height="768" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=768&fansRow=1&ptype=1&speed=0&skin=4&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=1875088617&verifier=7ef13898&dpc=1"></iframe>
				<h3>其它组织机构微博</h3>
				<ul class="weibo clearfix">
					<li><a href="http://weibo.com/bnuedu" target="_blank">
					<img class="weibo-logo" src="images/0.jpeg">
					北京师范大学招生办微博
					</a></li>
					<li><a href="http://weibo.com/BNUAA" target="_blank">
					<img class="weibo-logo" src="images/1.jpeg">
					北京师范大学校友会微博
					</a></li>
					<li><a href="http://weibo.com/bnucist" target="_blank">
					<img class="weibo-logo" src="images/2.jpeg">
					信息科学与技术学院微博
					</a></li>
				</ul>
            </div>
            <div class="col-lg-5">
				<h2>北京师范大学 官方微信</h2>
				<div class="text-left" id="wxbox" style="display:none;">
				</div>

				<div style="text-align: center;"><a class="btn btn-primary btn-sm" href="http://weixin.sogou.com/gzh?openid=oIWsFtwcqc8F1tKXjaSc5lyW4rVo&ext=alQlAlGoElnfLL-JJdRRpN1bNucYWidYTMRw6PU4FdVK37MUf80VBaKybhGbyIJK" target="_blank"><span>查看更多</span></a></div>
				<div class="p-more hidden" style="display:none;text-align: center;" id="wxmore"><a class="btn btn-primary btn-sm" href="#" onclick="return false;"><span>查看更多</span></a></div>
            </div>
        </div>

    </div>
</div>
