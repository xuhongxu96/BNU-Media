<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title>北师大·融媒体 - <?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>

<!-- 开发者 -->

<!-- 北京师范大学 -->
<!-- 信息科学与技术学院 -->
<!-- 计算机科学与技术专业 -->
<!-- 2014级 -->
<!-- 许宏旭 -->
<!-- 个人主页：http://xuhongxu.cn -->

<?php $this->beginBody() ?>
	<div class="wrap">
<?php
NavBar::begin([
	'brandLabel' => '北师大 · 融媒体',
	'brandUrl' => Yii::$app->homeUrl,
	'options' => [
		'class' => 'navbar-inverse navbar-fixed-top',
	],
]);
echo Nav::widget([
	'options' => ['class' => 'navbar-nav navbar-right'],
	'items' => [
		['label' => '主页', 'url' => ['/site/index']],
		['label' => '图库', 'url' => [Yii::$app->user->isGuest ? '/site/album' : '/album/index']],  
		['label' => '视频', 'url' => [Yii::$app->user->isGuest ? '/site/video' : '/video/index']],  
		['label' => '管理', 'items' => [
			['label' => '分类', 'url' => ['/category/index'], 'visible' => !Yii::$app->user->isGuest],
			['label' => '用户', 'url' => ['/user/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->auth == 1],
		], 'visible' => !Yii::$app->user->isGuest],
		['label' => '新媒体', 'items' => [
			['label' => '手机报', 'url' => 'http://news.bnu.edu.cn/sjb/71882.htm', 'linkOptions' => ['target' => '_blank']],
			['label' => '京师学人', 'url' => 'http://read.douban.com/people/49884010/', 'linkOptions' => ['target' => '_blank']]
		]],
		['label' => '关于我们', 'url' => ['/site/about']],
		Yii::$app->user->isGuest ?
		['label' => '登录后台', 'url' => ['/site/login']] :
		[
			'label' => '欢迎 ' . Yii::$app->user->identity->name,
			'items' => [
				[
					'label' => '修改个人信息',
					'url' => ['/user/update', 'id' => Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->ID], 'visible' => !Yii::$app->user->isGuest
				],
				[
					'label' => '登出',
					'url' => ['/site/logout'],
					'linkOptions' => ['data-method' => 'post']
				],
			]
		]
	],
]);
NavBar::end();
?>

<?php if (!(isset($this->params['no_container']) && $this->params['no_container'])): ?>
		<div class="container">
<?php endif; ?>
<?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
			<?= $content ?>
<?php if (!(isset($this->params['no_container']) && $this->params['no_container'])): ?>
		</div>
<?php endif; ?>
	</div>

	<footer class="footer">
		<div class="container">
			<div class="show pull-left">
				<img class="center-block img-responsive" width="64" src="images/bnu.png">
				<h4>北京师范大学官方微信<br><small>公众号：bnuweixin</small></h4>
			</div>
			<div class="show pull-left">
				<img class="center-block img-responsive" width="64" src="images/weibo.png">
				<h4>北京师范大学官方微博</h4>
			</div>
			<p class="pull-right">
内容维护：北京师范大学新闻中心 融媒体中心
<br>
<br>
<strong>联系方式</strong>
<br>
邮箱：<a href="mailto:bnuweixin@126.com">bnuweixin@126.com</a>
<br>
电话：010-58807925
</p>
			</div>
		</div>
	</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
