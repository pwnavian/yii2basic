<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use cakebake\actionlog\model\ActionLog;
use yii\db\Query;
/**
 * This is the model class for table "employee".
 *
 * @property string $kode
 * @property string $nama
 * @property string $jabatan
 * @property string $departement
 */
class Employee extends \yii\db\ActiveRecord
{
    public $photo;
    public $nik;
    public static function getDb()
    {
        return \Yii::$app->master;
    }
	/**
     * @inheritdoc
     */
    public function beforeSave($insert) {

		if($this->isNewRecord){

			// ActionLog::add('success', $this->getoldAttributes(), $this->getAttributes());
			$this->create_by = Yii::$app->user->id;
			$this->created = new \yii\db\Expression('NOW()');
        }
		else{
			// ActionLog::add('success', $this->getoldAttributes(), $this->getAttributes());
			$this->modi_by = Yii::$app->user->id;
			$this->modified = new \yii\db\Expression('NOW()');

		}
		return parent::beforeSave($insert);
    }

	public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['nama'], 'string', 'max' => 30],
            [['occupation', 'departement'], 'string', 'max' => 10],
            [['section', 'pangkat'], 'string', 'max' => 50],
            [['golongan'], 'string', 'max' => 4],
            [['occupation_code','user_id', 'machine', 'work_date','is_qrcode','birth_date','status','start_contract','end_contract','shift_status','is_app'], 'safe'],
            [['birth_place','gender','no_identitas','no_kpj','address','no_hp','mother_name','email_bpjs','is_update_bpjs'], 'safe']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
			'id' => 'ID',
            'nama' => 'Nama',
            'user_id' => 'User ID',
            'departement' => 'Departement',
            'occupation' => 'Jabatan',
            'section' => 'Section',
            'golongan' => 'Golongan',
            'pangkat' => 'Pangkat',
            'work_date' => 'Tanggal Masuk',
            'machine' => 'Machine',
            'create_by' => 'Create By',
            'created' => 'Created',
            'modi_by' => 'Modi By',
            'modified' => 'Modified',
        ];
    }

	public function findByLogin(){
		$employee = Employee::find()->where(['user_id'=>Yii::$app->user->id])->asArray()->one();
		if(!empty($employee)) return $employee['nama'];
	}

	public static function getOperator($machine){
		$operators = new Query;
		// pr($machine);exit;
		$operators->select('distinct(operator) as nama')->from('v_union_downtime')->where('machine in("'.$machine.'")');
		$operator = $operators->all();

		return $operator;
    }


    public function getJenisAbsen($code){

      if($code == "1"){
        $text = 'IN';
      }else if($code == "3"){
        $text = 'OUT';
      }else{
        $text = '';
      }

      return $text;

    }

    public function getSkillSet($nik){

      $test_available = ['SIEGEN'=>'SIEGEN','TOSHIBA'=>'TOSHIBA','HERCULES'=>'HERCULES','CHURCHILL'=>'CHURCHILL','BUBUT'=>'BUBUT'];
      
  
  
      $connection = Yii::$app->getDb();
      $sql = "select id, skills as description from ctm_dpr_master_skill_matrix_tabs where nik in ('".$nik."')
      ";
  
      $command = $connection->createCommand($sql);
  
      $test_assigned = $command->queryAll();
      if(!empty($test_assigned)){
        $test_assigned = ArrayHelper::map($test_assigned,'id','description');
      }

      foreach($test_assigned as $val){
        unset($test_available[$val]);
        // pr($val);exit;
      }
  
      return[
          'avaliable2' => $test_available,
          'assigned2' => $test_assigned
      ];
    }

    public function addNewSkill2($id, $skills)
    {
      // pr($id);
      // pr($persons);exit;
		foreach ($skills as $skill) {
        try {
          
            $skillMatrix = new SkillMatrix();
            $skillMatrix->nik = $id;
            $skillMatrix->skills = $skill;

            $valid = $skillMatrix->validate();

            $skillMatrix->save();
        
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
    }

    public function removeSkill2($id, $skills)
      {
      // pr($skills);exit;
      
  		foreach ($skills as $skill) {
              try {
                  
  				    $cond = "where skills IN ('".$skill."')";


  				$sql = "select nik from ctm_dpr_master_skill_matrix_tabs ".$cond;
  				$connection = Yii::$app->getDb();
  				$command = $connection->createCommand($sql);
  				$data = $command->queryOne();
  				// print_r($data);exit;
  				if(!empty($data)){
  					SkillMatrix::deleteAll(['skills'=>$skill, 'nik'=>$data['nik']]);
  				}
              } catch (Exception $exc) {
                  Yii::error($exc->getMessage(), __METHOD__);
              }
          }
      }

    public function getForm()
    {
        return $this->hasOne(FormKpiOperator::className(), ['nik' => 'kode']);
    }

}
