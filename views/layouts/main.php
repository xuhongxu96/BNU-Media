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
	<title>北师大·新媒体 - <?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
	<div class="wrap">
<?php
NavBar::begin([
	'brandLabel' => '北师大 · 新媒体',
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

		<div class="container">
<?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
			<?= $content ?>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; <a href="http://www.bnu.edu.cn/" target="_blank">北京师范大学</a> <?= date('Y') ?></p>
			<p class="pull-right"><?php echo "Developed by <a href='http://xuhongxu.cn' target='_blank'>xuhongxu96</a>"; ?></p>
		</div>
	</footer>

<?php $this->endBody() ?>
<script type="text/javascript">
function vrImgHandle552(that,width,height){
 	calImg();
	function calImg (){
		if (that.height==0&&!that.offsetWidth){
			setTimeout(calImg, 50);
			return;
		}
		setTimeout(function(){
			if(width != that.width){
				var pos = Math.floor((that.width - width)/2);
				that.style.marginLeft = (-pos) + "px";
			}
			if(height != that.height){
				var pos = Math.floor((that.height - height)/2);
				that.style.marginTop = (-pos) + "px";
			}
			that.style.visibility = "visible";
		},0);
	}
}
function vrTimeHandle552(time){
    if (time) {
        var date = new Date(time * 1000);
        var today = new Date();
        if (date.getFullYear() == today.getFullYear() && date.getMonth() == today.getMonth() && date.getDate() == today.getDate()) {
            return (date.getHours() < 10 ? "0":"") + date.getHours() + ":" + (date.getMinutes() < 10 ? "0":"") + date.getMinutes();
        } else {
            return (date.getMonth() < 9 ? "0":"") + (date.getMonth() + 1) + "月" + (date.getDate() < 10 ? "0":"") + date.getDate() + "日";
        }
    } else {
        return '';
    }
}
function vrTimeHandle552write(time){
	document.write(vrTimeHandle552(time))
}
function len(str){
	if(str)
		return str.replace(/<.*?>/g, "").replace(/[^\x00-\xff]/g,"rr").replace(/&nbsp;/g, " ").length;
	return 0;
}
function cutLength(str, maxLen, appended, appendLength){
	appended = appended||"...";
	appendLength = appendLength||2;
	str=str.replace(/<!.*?>/g, "");
	if (len(str) > maxLen){
		do{
			str = str.substring(0, str.length-1);
		}while(str && (len(str)+appendLength > maxLen));
		if (str.lastIndexOf("</") != str.lastIndexOf("<")){
			str = str.substring(0, str.lastIndexOf("<"))+str.substring(str.lastIndexOf(">")+1);
		}
		return str+appended;
	}
	return str;
}
function bind(ele, evt, func) {
	if (ele.addEventListener) {
		ele.addEventListener(evt, func, false)
	} else {
		if (ele.attachEvent) {
			ele.attachEvent("on" + evt, func)
		}
	}
}
(function (){
	function parseXML(data) {
		var xml;
		if (window.DOMParser) { // Standard
			tmp = new DOMParser();
			xml = tmp.parseFromString(data, "text/xml");
		} else { // IE
			xml = new ActiveXObject("Microsoft.XMLDOM");
			xml.async = "false";
			xml.loadXML(data);
		}
		return xml.documentElement;
	}
	function tagtext(obj) {
			if(!obj || obj.firstChild == null)
				return "";
			return obj.firstChild.nodeValue;
	}
	function template(obj){
		if(!obj)return '';
		var arr = [];
		arr.push('<div class="wx-rb wx-rb3"  id="sogou_vr_',obj.classid,'_box_',templatenum,'">');
		if(obj.imglink){
			arr.push('<div class="img_box2"><a target="_blank" href="',obj.url,'" id="sogou_vr_',obj.classid,'_img_',templatenum,'" style="width:80px;height:80px;overflow:hidden;display:block;border:1px solid #ebebeb;"><img style="border:none;" onload="vrImgHandle552(this,80,80)" onerror="imgErr(this.parentNode)" alt="" src="http://img01.store.sogou.com/net/a/04/link?appid=100520031&url=',obj.imglink,'"></a></div>');
		}
		arr.push('<div class="txt-box"><h4><a class="news_lst_tab" target="_blank" href="',obj.url,'" id="sogou_vr_',obj.classid,'_title_',templatenum,'">',obj.title,'</a></h4>');
		arr.push('<p>',cutLength(obj.content,240,'...',3),'</p>');
		arr.push('<p class="s-p">',vrTimeHandle552(obj.lastModified),'</p>');
		arr.push('</div></div>');
		return arr.join('');
	}
	function gt(e,n){
		var a=e.getElementsByTagName(n);
		if(a&&a.length>0){
			return a[0];
		}
		return null;
	}
	function xml2obj(xml){
		if(xml){
			var doc = parseXML(xml);
			if(doc && gt(doc,'display')){
				var obj = {};
				var tplid = gt(doc,'tplid');
				//if(tagtext(tplid)=='555'){
					var news = gt(doc,'display');
					obj.url=tagtext(gt(news,'url'));
					obj.title=tagtext(gt(news,'title'));
					obj.imglink=tagtext(gt(news,'imglink'));
					obj.lastModified=tagtext(gt(news,'lastModified'));
					obj.sourcename=tagtext(gt(news,'sourcename'));
					obj.content=tagtext(gt(news,'content168'));
					obj.isV=tagtext(gt(news,'isV'));
					obj.classid=tagtext(gt(doc,'classid'));
					return obj;
				//}
			}
		}
	}
	function g(n){return document.getElementById(n)}
	function hide(e){e.style.display="none"}
	function show(e){e.style.display=""}
	function hide1(e){e.style.visibility = "hidden"}
	function show1(e){e.style.visibility = "visible"}
	function ajaj(u) {
		u=u+"&t="+(new Date().getTime());
		var a = document.createElement("script");
		a.src = u;
		//alert(u);
		document.getElementsByTagName("head")[0].appendChild(a);
		return a;
	}
	var openid,startnum=0;
	var jmore = g("wxmore");
	var jbox = g("wxbox");
	var jlist = g("wxbox");
	var pagenum = 1;
	var url;
	
	function getUrlParams(paraname) {
		var str = location.href;
			var sValue = str.match(new RegExp("[?&]" + paraname + "=([^&]*)(&?)", "i"));
		if (sValue ? sValue[1] : sValue == null)
	    	return sValue ? sValue[1] : sValue;
	}
	function start(){
		ajaj(url+pagenum);
	}
	function init(id,enabled){
		openid = id;
		url = "http://weixin.sogou.com/gzhjs?cb=sogou.weixin.gzhcb&openid="+openid+"&eqs=WgsboB3gD5zfonozZYXTNuDhn1kdQ4RrOBFNYuJm6NY3Abi9HoOZcBbQOKMORcmfZE69v&ekv=7&page=";
		start();
		var name = document.getElementById("weixinname");
		if(name&&name.innerHTML.length>0){
			name=name.innerHTML;
			name = name.replace(/&amp;/g,'&');
			if(document.getElementById("upquery"))document.getElementById("upquery").value=name;
			if(document.getElementById("bottom_form_querytext"))document.getElementById("bottom_form_querytext").value=name;
			document.title=name+"的公众号详情页 – 搜狗微信搜索";
		}
	}
	function cb(data){
		var items = data.items,page = data.page,total = data.totalPages;
		if(items && items.length>0){
			if(pagenum==1){
				show(jbox);
			}
			if(page<total){
				show(jmore);
				show1(jmore);
			}
			var arr = [];
			for(var i=0;i<items.length;i++){
				arr.push(template(xml2obj(items[i])));
			}
			startnum = 0;
			var html = arr.join('');
			var newNode = document.createElement("div");
			newNode.innerHTML =html;
			jlist.insertBefore(newNode,null);
		}else{
			if(pagenum==1){
				var html = '<h4 class="zj-tit"><span>该公众号暂未发布文章</span></h4>';
				var newNode = document.createElement("div");
				newNode.innerHTML =html;
				jlist.insertBefore(newNode,null);
				show(jbox);
			}
		}
	}
	function more(){
		hide1(jmore);
		pagenum ++;
		ajaj(url+pagenum);
	}
	bind(jmore,"click",function(){more()});
	var sogou = window.sogou = window.sogou||{};
	var weixin = sogou.weixin = sogou.weixin||{};
	weixin.init=init;
	weixin.gzhcb=cb;
	
	var getstop = function(){return ((document.body && document.body.scrollTop) || (document.documentElement && document.documentElement.scrollTop) || 0);}
	window.onscroll = function(){
		var s = document.getElementById("quan_twitter_gotop_0"), t = getstop();
		if (t > 200 && s){
			s.style.display = "";
			s.onclick = function(){
				window.scrollTo(0,0);
				return false;
			}
		}
		if (t <= 200 && s){
			s.style.display = "none";
		}
	}
})();
var templatenum = 0;
bind(window,"load",function(){
	sogou.weixin.init("oIWsFtwcqc8F1tKXjaSc5lyW4rVo","true");
});
</script>
</body>
</html>
<?php $this->endPage() ?>
