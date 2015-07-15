<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加新视频', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'thumbnail:image',
            'name',
            'desp',
            'url:url',
		['attribute' => 'author', 'label' => '作者', 'value' => 'author.name'],
			 'date',
		['attribute' => 'category', 'label' => '分类', 'value' => 'categories'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
