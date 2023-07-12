<?php
namespace app\components;
use yii\base\Component;
use Yii;
use yii\base\Model;
use app\models\Employee;
use app\models\Machine;
use app\models\AlloyType;
use app\models\Shift;
use yii\helpers\ArrayHelper;




class General extends Component{

    function getMachine($mc){
        $machines = Machine::find()->where(['machine_group_code'=>$mc])->all();
		if(!empty($machines)) return ArrayHelper::map($machines,'machine_code','machine_name');
    }

    function getAlloy(){
        $listAlloyType = [''=>'....'];
		$alloyType=AlloyType::find()->all();
		if(!empty($alloyType)) return array_merge($listAlloyType, ArrayHelper::map($alloyType,'alloy_type','alloy_type'));
    }

    function getShift(){
        $shifts = Shift::getShift();
		$shift = ArrayHelper::map($shifts,'shift','description');
    }

    function getSupervisor(){
		$listSpv = ['NO SPV'=>'TANPA SUPERVISOR'];
		$supervisor=Employee::find()->where(['occupation'=>'SPV','spv_code'=>['ROLLING','FINISHING'], 'is_active' => '1'])->all();
		$listSpv+=ArrayHelper::map($supervisor,'nama','nama');
		return $listSpv;
	}

    function getOperator($machine=null){
		// pr($machine);exit;
		$listOpr = ['NO OPR'=>'TANPA OPERATOR'];
		// if(!empty($machine)){
		// 	$operator = Employee::getOperator($machine);
		// }else{
			$operator = Employee::find()->where(['or', ['is_active'=>1,'occupation'=>'OPERATOR','machine'=>$machine] , ['in','departement', ['PROD1','PROD'], 'occupation'=>'STAFF']])->all();
		// }
			$opr_exist = Employee::getOperator($machine);
		$listOpr += ArrayHelper::map($operator,'nama','nama');
		$listOpr += ArrayHelper::map($opr_exist,'nama','nama');
		return $listOpr;
	}

    function getHelper(){
		$listHelper = ['NO HELPER'=>'NO HELPER'];
		$helper = Employee::find()->where(['and' , ['or',['spv_code'=>'ASSIST'],['occupation'=>'OPERATOR']],['is_active' => '1'], ['in','departement',['PROD1','PROD','PROD-A']]])->all();
		// pr($helper);exit;
		$listHelper+=ArrayHelper::map($helper,'nama','nama');
		return $listHelper;
	}
}