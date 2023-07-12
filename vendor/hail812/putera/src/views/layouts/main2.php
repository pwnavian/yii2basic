<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;


if (Yii::$app->controller->action->id === 'login') {

  echo $this->render(
        'main-login',
        ['content' => $content]
    );

}else{
    
\app\assets\AppAsset::register($this);
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
// $this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>web/images/logo.png" type="image/x-icon" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        @media (max-width:768px){
            .block-company-name{display:none !important;}
            .menu-bawah {display:none !important;}
        }
        @media (min-width:768px){
            #dropdownMenuLink{
                display:none;
            }
        }
    </style>
</head>
<body class="hold-transition layout-navbar-fixed layout-fixed <?= (Yii::$app->request->pathInfo != '' ? : 'sidebar-collapse') ?>"><!-- -->
<?php $this->beginBody() ?>

<?= \diecoding\toastr\ToastrFlash::widget() ?>

<!-- Brand Logo -->
  
    



<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>
    
    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content2', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php } ?>
