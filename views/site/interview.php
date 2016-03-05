<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$this->title = '新闻采访';
?>
<div class="site-interview">

<div class="row">
    <p>
        <?= Html::a('申请新闻采访', ['/interview/create'], ['class' => 'btn btn-block btn-lg btn-success']) ?>
    </p>
    <div class="text-center col-sm-6">
        <h3>已回复</h3>
        <div class="list-group">
<?php foreach ($replied_interviews as $item) :?>
            <a href="#" class="list-group-item clearfix">

                <h4 class="list-group-item-heading"><?php echo $item->name; ?> （<?php echo $item->unit;?> 主办）</h4>

                <p class="list-group-item-text text-left">

                    时间：<?php echo $item->start_time; ?> ～ <?php echo $item->stop_time;?>

                    <br>

                    地点：<?php echo $item->place; ?>
                    
                    <br>

                    活动概要：<?php echo $item->summary; ?>
                   
                    <span class="badge pull-right">提交时间：<?php echo $item->created_at; ?></span>

                </p>
                <strong>回复</strong>
                <p class="list-group-item-text text-left text-danger"><?php echo $item->reply; ?></p>
                <span class="badge pull-right">回复时间：<?php echo $item->updated_at; ?></span>

            </a>
<?php endforeach;?>
        </div>
	<?= LinkPager::widget(['pagination' => $replied_page]) ?>
    </div>
    <div class="text-center col-sm-6">
        <h3>待回复</h3>
        <div class="list-group">
<?php foreach ($noreply_interviews as $item) :?>
            <a href="#" class="list-group-item clearfix">

                <h4 class="list-group-item-heading"><?php echo $item->name; ?> （<?php echo $item->unit;?> 主办）</h4>

                <p class="list-group-item-text text-left">

                    时间：<?php echo $item->start_time; ?> ～ <?php echo $item->stop_time;?>

                    <br>

                    地点：<?php echo $item->place; ?>
                    
                    <br>

                    活动概要：<?php echo $item->summary; ?>
                    
                    <span class="badge pull-right">提交时间：<?php echo $item->created_at; ?></span>

                </p>
            </a>
<?php endforeach;?>
        </div>
        <?= LinkPager::widget(['pagination' => $noreply_page]) ?>
    </div>
</div>

</div>
