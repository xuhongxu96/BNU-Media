<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->name;
if (Yii::$app->user->isGuest) {
	$this->params['breadcrumbs'][] = ['label' => '视频', 'url' => ['site/video']];
} else {
	$this->params['breadcrumbs'][] = ['label' => '视频', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

	<h1><?= Html::encode($this->title) ?></h1>

<?php if (!Yii::$app->user->isGuest) : ?>
	<p>
		<?= Html::a('修改', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
<?= Html::a('删除', ['delete', 'id' => $model->ID], [
	'class' => 'btn btn-danger',
	'data' => [
		'confirm' => '确定删除吗？',
		'method' => 'post',
	],
]) ?>
	</p>
<?php endif;?>

<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'name',
		'desp',
		'url:url:查看视频',
		'thumbnail:image',
		['attribute' => 'author.name', 'label' => '作者'],
		'date',
		'categories',
	],
]) ?>

</div>
