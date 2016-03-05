<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Interview */

$this->title = '申请新闻采访';
$this->params['breadcrumbs'][] = ['label' => '新闻采访', 'url' => [Yii::$app->user->isGuest ? '/site/interview' : '/interview/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
