<?php
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use yii\helpers\Html;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

  <div>
    <a href="<?=Yii::$app->homeUrl?>" class="brand-link" style="height:50px;">
        <img src="<?=$assetDir?>/img/test.jpg" alt="AdminLTE Logo" class="elevation-3 rounded mx-auto d-block" style="opacity: .8;width:2rem;">
        <!-- <span class="brand-text font-weight-light">AdminLTE </span> -->
    </a>
  </div>

     <!-- <?= Html::a('<span class="logo-mini"><img src="'.$assetDir.'/img/test.jpg"/></span><span class="logo-lg"><img src="'.$assetDir.'/img/test.jpg"/></span>', Yii::$app->homeUrl, ['class' => 'logo']) ?> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                <img src="<?= $assetDir ?>/img/user.png" class="img-circle elevation-2" alt="User Image"/>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=Yii::$app->user->identity?->first_name?></a>


            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $callback = function($menu){
                // $data = eval($menu['data']);
                //if have syntax error, unexpected 'fa' (T_STRING)  Errorexception,can use
               $data = $menu['data'];

               // filter url active
               // if(Yii::$app->request->pathInfo != ''){
               //     $urlIndex = ltrim($menu['route'], '/');
               //     $arrUrl = explode("/", Yii::$app->request->pathInfo);
               //     $urlReq = $arrUrl[0]."/".$arrUrl[1];
               //     $urlActive = (strpos($urlIndex,$urlReq) === 0) ? true : null;
               // }else{
               //     $urlActive = null;
               // }

               $urlActive = null;
               // filter url active
               if(Yii::$app->request->pathInfo != ''){

                 $urlIndex = ltrim($menu['route'], '/');
                 $arrUrl = explode("/", Yii::$app->request->pathInfo);
                //  pr($arrUrl);exit;
                 $urlReq = $arrUrl[0]."/".$arrUrl[1]."/";

                 if(Yii::$app->request->pathInfo == $urlIndex){
                   $urlActive = true;
                 }else{

                   if($menu['activeOnRoutes'] != 1 && strpos($urlIndex,$urlReq) === 0 ){
                     $urlActive = true;
                   }else{
                     $urlActive = null;
                   }

                 }

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


            $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
            // print('<pre>');print_r($items);print('</pre>');exit;
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $items
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
