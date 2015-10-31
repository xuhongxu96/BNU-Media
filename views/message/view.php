<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = $model->name;
if (Yii::$app->user->isGuest) {
	$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['site/message']];
} else {
	$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

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
		'url:url:查看文章',
		'thumbnail:image',
		'categories',
	],
]) ?>

</div>
