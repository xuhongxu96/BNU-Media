<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Album */

$this->title = $model->name;
if (Yii::$app->user->isGuest) {
	$this->params['breadcrumbs'][] = ['label' => '图库', 'url' => ['site/album']];
} else {
	$this->params['breadcrumbs'][] = ['label' => '图库', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

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
<?php endif; ?>

<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'name',
		'desp',
		'url:image',
		'thumbnail:image',
		['attribute' => 'author', 'label' => '作者'],
		'date',
		'categories',
	],
]) ?>

</div>
