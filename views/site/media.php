<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$titles = array('图库','视频','手机报');
$this->title = $titles[$typeid];
$this->params['breadcrumbs'][] = $this->title;

?>
	<div class="site-media site-<?php echo $type;?>">

<form class="form-inline search clear" action="<?=Url::to(['site/' . $type])?>">
	<input type="hidden" name="r" value="site/<?=$type?>">
	<input type="hidden" name="order" value="<?=$order?>">
	<input type="hidden" name="cat" value="<?=$catUrl?>">
	<input type="hidden" name="asc" value="<?=$asc?>">
	<div class="form-group">
		<label for="fname">名称：</label>
		<input id="fname" name="name" type="text" value="<?=$name?>" class="form-control input-sm">
	</div>
	<div class="form-group">
		<label for="fdesp">描述：</label>
		<input id="fdesp" name="desp" type="text" value="<?=$desp?>" class="form-control input-sm">
	</div>
	<div class="form-group">
		<label for="fauthor">作者：</label>
		<input id="fauthor" name="author" type="text" value="<?=$author?>" class="form-control input-sm">
	</div>
	<div class="form-group">
		<input type="submit" value="搜索" class="btn btn-primary">
	</div>
	<div class="form-group">
		<?= Html::a("重置", Url::to(array_merge($oldCat, $oldOrder, ['site/' . $type])), ['class' => 'btn btn-danger'])?>
	</div>
</form>
<div class="clear filter nav-category categories">
<span style="float:left;">分类筛选：</span>
<?php 

foreach ($categories as $cat) {
	if (in_array($cat->ID, $catArr)) {
		echo Html::a(
			$cat->name,
			Url::to(array_merge($oldOrder, $oldSearch, ['site/' . $type, 'cat' => implode(',', array_diff($catArr, [$cat->ID]))])),
		   	['class' => 'active']);
	} else {
		echo Html::a(
			$cat->name,
			Url::to(array_merge($oldOrder, $oldSearch, ['site/' . $type, 'cat' => implode(',', array_merge($catArr, [$cat->ID]))])));
	}
}
if (count($catArr))
	echo Html::a("×", Url::to(array_merge($oldOrder, $oldSearch, ['site/' . $type])), ['class' => 'del']);
?>
</div>
<div class="clear filter nav-sort <?php echo $asc; ?>">
<span style="float: left;">排序依据：</span>
<?php
$tasc = $asc == 'asc' ? 'desc' : 'asc';
echo Html::a("名称", Url::to(array_merge($oldCat, $oldSearch, ['site/' . $type, 'order' => 'name', 'asc' => $tasc])), ['class' => $order == 'name' ? 'active' : '']);
echo Html::a("作者", Url::to(array_merge($oldCat, $oldSearch, ['site/' . $type, 'order' => 'bnm_users.name', 'asc' => $tasc])), ['class' => $order == 'bnm_users.name' ? 'active' : '']);
echo Html::a("日期", Url::to(array_merge($oldCat, $oldSearch, ['site/' . $type, 'order' => 'date', 'asc' => $tasc])), ['class' => $order == 'date' ? 'active' : '']);
?>
</div>
<ul class="clear media-list">
<?php foreach ($media as $item): ?>
	<li>
<?php if ($type == 'message') : ?>
		<a href="<?= Url::to($item->url)?>">
<?php else : ?>
		<a href="<?= Url::toRoute([$type . '/view', 'id' => $item->ID])?>">
<?php endif; ?>
			<div class="media-content">
				<?=Html::img($item->thumbnail, ['alt' => 'pic']) ?>
				<div class="media-header"><?= Html::encode("{$item->name}") ?></div>
				<p><?= Html::encode(StringHelper::truncate("{$item->desp}", 35, '...')) ?></p>
			</div>
			<div class="media-meta">
				作者：<?= Html::encode("{$item->author->name}") ?> 
				<time><?= Html::encode("{$item->date}") ?></time>
			</div>
		</a>
		<div class="categories">
		<?php 
			foreach ($item->categoryArray as $cat) {
				echo Html::a($cat->categoryItem->name, Url::to(['site/' . $type, 'cat' => $cat->category]), in_array($cat->category, $catArr) ? ['class' => 'active'] : []);
			}
		?>
		</div>
	</li>
	<?php endforeach; ?>
</ul>

	<?= LinkPager::widget(['pagination' => $pagination]) ?>
	</div>
