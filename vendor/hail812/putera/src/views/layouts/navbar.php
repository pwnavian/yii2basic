<?php
use mdm\admin\components\MenuHelper;
use mdm\admin\models\Menu;
use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Nav;
use kartik\popover\PopoverX;
$server = Yii::$app->request->hostInfo;
$base = Yii::$app->homeUrl;

$script = <<<JS
$('#NotifPopover').hide();
$('#notifButton').click(function(e){
    
    
});

$('#NotifPopover').on('hidden.bs.modal', function (e) {
    $('#notifCount').html("");
    var arr = [];
    $("div.notification").each(function(index){
        arr.push($( this ).attr('id').replace('notif-',''));
    });
    console.log(arr)
    $.post({
    url : '$server$base'+'site/flag-notif',
    type : "POST",
    data : {arr},
    success : function(data){
        if(data) {
            $('#notifCount').html("");
        }
        // $('#notifCount').html(data);
    },
    error : function(data) {
        console.log(data.responseText)
    }
});

});

$.ajax({
    url : '$server$base'+'site/get-notif',
    type : "GET",
    success : function(data){
        if(data != 0) $('#notifCount').html(data);
    },
    error : function(data) {
        console.log(data)
    }
});
JS;

$this->registerJs($script);
$arr_path = explode("/",Yii::$app->request->pathInfo);
if(sizeof($arr_path) >='3' && ($arr_path[2] != 'index')) {
    if($arr_path[2] != 'view') $this->registerJs('$("[data-widget=pushmenu]").trigger("click");');
    // pr($arr_path);exit;
    while(sizeof($arr_path) >2) {
        array_pop($arr_path);
    }
    
    $url = implode("/",$arr_path);
    $menu = Menu::find()->where(['route'=>'/'.$url.'/index'])->one();
    if(!empty($menu)){
        $menuname = $menu->name;
    }
    else {
        $menuname = str_replace("-"," ", $arr_path[1]);
    }
    
    // pr($menuname);exit;
}
// pr(Yii::$app->user->id);exit;
?>
<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-blue navbar-light flex-column"><!-- -->
    <!-- Left navbar links -->
    <div class="navbar-collapse collapse justify-content-between col-md-12" style="height:1.5rem;">

    <a class="btn btn-link bd-search-docs-toggle p-0 ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="white" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <?= Yii::$app->General->getParentMenu(Yii::$app->user->id, 'dropdown') ?>
    </div>
    <h5><span class="block-company-name" style="font-weight:bold;color:white;margin:0;display:inline-block;padding:0px;vertical-align: middle;text-shadow: 3px 3px 3px #000000;"><?= Yii::$app->params['company_name'] ?></span></h5>
    
    <!-- <div style="display:inline-block;float:left;"><h3 style="font-weight:bold;color:white;margin:0;display:inline-block;padding:8px;vertical-align: middle;text-shadow: 3px 3px 3px #000000;"><?= Yii::$app->params['company_name'] ?></h3></div> -->
    <ul class="navbar-nav ml-auto icon-kanan-atas">
        <!-- <li class="nav-item">
          <?php
          echo Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              'options' => [
                  'class' => 'breadcrumb float-sm-right'
              ]
          ]);
          ?>
        </li> -->
        
        <li class="nav-item ml-2 mr-2 mt-2 text-center">
        <?php
            PopoverX::begin([
                    'id'=>'NotifPopover',
                    'placement' => PopoverX::ALIGN_BOTTOM,
                    'size'=> PopoverX::SIZE_LARGE,
                    'toggleButton' => ['id'=>'notifButton', 'label'=>'<img src="'.Yii::$app->homeUrl.'web/img/notif.png" alt="a" height="30px" width="30px"></img>', 'class'=>'btn btn-sm btn-outline-primary','title'=>'Notification',],
                    // 'header' => 'Cari Laporan Performance',
                    
                    'footer' => Html::a('See all notifications', $server.$base.'transaction/notification', [
                            'class' => 'btn btn-sm btn-primary col-md-12', 
                            // 'value'=>'PerfProd1',
                            // 'onclick' => 'getData("'.$server.'", "'.$base.'", this.value)'
                    ]),
                    'pluginEvents' => [
                        "load.complete.popoverX"=>"function() { clearNotif(); }",
                    ]
                ]);
            ?>
            <?= \app\widgets\Notification::widget() ?>
            
            <?php PopoverX::end(); ?>
            <span style="margin-left:-25px;margin-top:7px;position:absolute;font-size:.6rem;">Notifications</span><span class="badge badge2" id="notifCount"></span>
        </li>
        <li class="nav-item ml-2 mr-2 text-center">
        <?= Html::a('<img src="'.Yii::$app->homeUrl.'web/img/home.png" alt="a" height="30px" width="30px"></img>', ['/site/index'], ['title'=>'Home', 'class' => 'nav-link']) ?><span style="font-size:.6rem;">Home</span>
        </li>
        <?php if(isset($url)) : ?>
        <li class="nav-item ml-2 mr-2 text-center">
        <?= Html::a('<img src="'.Yii::$app->homeUrl.'web/img/transaction.png" alt="a" height="40px" width="40px"></img>', ['/'.$url.'/index'], ['title'=>$menuname, 'class' => 'nav-link']) .'<span style="font-size:.6rem;">'.$menuname.'</span>' ?>
        </li>
        <?php endif; ?>
        <li class="nav-item ml-2 mr-2 text-center">
        <?= Html::a('<img src="'.Yii::$app->homeUrl.'web/img/change-password.png" alt="a" height="34px" width="34px"></img>', ['/site/change-password'], ['title'=>'Change Password', 'class' => 'nav-link']) ?><span style="font-size:.6rem;">Change Password</span>
        </li>
        <!-- <li class="nav-item ml-3 mr-3 text-center">
        <? //echo Html::a('<img src="'.Yii::$app->homeUrl.'web/img/notif.png" alt="a" height="30px" width="30px"></img>', ['#'], ['title'=>'Notification', 'class' => 'nav-link']) ?>
        <span class="badge badge2">3</span><span style="font-size:.6rem;">Notifications</span>
        </li> -->
        
        <li class="nav-item ml-2 mr-2 text-center">
        <?= Html::a('<img src="'.Yii::$app->homeUrl.'web/img/logout.png" alt="a" height="32px" width="32px"></img>', ['/site/logout'], ['title'=>'Sign Out', 'data-method' => 'post', 'class' => 'nav-link']) ?><span style="font-size:.6rem;">Log Out</span>
        </li>
        
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
    
    </div>
    
    <!-- <div class="collapse navbar-collapse flex-column ml-lg-0 ml-3"> -->
    <div class="navbar justify-content-center col-md-12 menu-bawah" style="height:20px;">
    <!-- <div style="display:inline-block;float:left;"><h3 style="font-weight:bold;color:white;margin:0;display:inline-block;padding:8px;vertical-align: middle;text-shadow: 3px 3px 3px #000000;"><?= Yii::$app->params['company_name'] ?></h3></div> -->
    
    <!-- Right navbar links -->
   
    <?php
            $callback = function($menu){
               
               $data = $menu['data'];

               // filter url active
               if(Yii::$app->request->pathInfo != ''){
                   $urlIndex = ltrim($menu['route'], '/');
                   $arrUrl = explode("/", Yii::$app->request->pathInfo);
                   $urlReq = $arrUrl[0]."/".$arrUrl[1];
                   $urlActive = (strpos($urlIndex,$urlReq) === 0) ? true : null;
               }else{
                   $urlActive = null;
               }




                return [
                    'label' => $menu['name'],
                    'url' => [$menu['route']],
                    'option' => $data,
                    'icon' => $menu['data'],
                    'items' => $menu['children'],
                    'active' => $urlActive,
                ];
            };
            echo Nav::widget([
                // 'options' => ['class' => 'navbar-nav navbar-left'],
                'options' => ['class' => 'nav-pills ml-auto col-md-12', 'style'=>'height:20px;'],
                'items' => Yii::$app->General->getParentMenu(Yii::$app->user->id, 'text-white', 'display:inline; padding:0.5rem 1rem;'),
                // 'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true),
                'encodeLabels' => false
            ]);
            ?>
    </div>
</nav>

<!-- /.navbar -->
