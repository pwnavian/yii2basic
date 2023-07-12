<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
$style = <<<CSS
div.sidemenu:hover{
    background-color:#e5c6b7d9;
}
CSS;
$this->registerCss($style);
?>

<div class="content-wrapper" style="height:inherit;">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header"> -->
        <!-- <div class="container-fluid"> -->
            <!-- <div class="row mb-2"> -->
                <!-- <div class="col-sm-6"> -->
                    <!-- <h1 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1> -->
                <!--</div>--><!-- /.col -->
                <!-- <div class="col-sm-6"> -->
                    
                <!-- </div> --><!-- /.col -->
            <!-- </div> --><!-- /.row -->
        <!--</div>--><!-- /.container-fluid -->
    <!-- </div> -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" style="padding-top:.5rem;">
      <div class="d-flex" style="margin-right:1rem;">
      <aside style="height: inherit; width:1rem; "><div class="vh-100 sidemenu" style="display:flex;justify-content:center;align-items:center;" onclick="test()" data-widget="pushmenu" role="button"><div class="bg-primary" style="display:flex;width:100%;height:7rem;justify-content:center;align-items:center;"><a href="#" role="button" value="1"><i class="fa fa-chevron-left" id="iconMenu"></i></a></div></div></aside>
        <div class="card" style="overflow-x:hidden;overflow-y:auto;padding:20px;">
          <?= $content ?><!-- /.container-fluid -->
        </div>
      </div>

    </div>
    <!-- /.content -->
</div>

<script>
    function test(){
        // console.log('a');
        // $('[data-widget=pushmenu]').PushMenu('toggle')
        // var icon = x.childNodes;
        // // +icon[0].className
        var class_name=document.getElementById("iconMenu").className;
        if(class_name == 'fa fa-chevron-right') $("#iconMenu").attr('class','fa fa-chevron-left');
        else $("#iconMenu").attr('class','fa fa-chevron-right');
    }
</script>