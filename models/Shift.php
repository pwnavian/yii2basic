<?php

namespace app\models;

use Yii;
use yii\db\Query;
/**
 * This is the model class for table "shift".
 *
 * @property integer $shift
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 */
class Shift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public function beforeSave($insert) {
        
		if($this->isNewRecord){
			$this->start_time = date("H:i:s", strtotime($_POST['Shift']['start_time']));
			$this->end_time = date("H:i:s" , strtotime($_POST['Shift']['end_time']));
			$this->create_by = Yii::$app->user->id;
			$this->created = new \yii\db\Expression('NOW()');
        }
		else{
			$this->start_time = date("H:i:s", strtotime($_POST['Shift']['start_time']));
			$this->end_time = date("H:i:s" , strtotime($_POST['Shift']['end_time']));
			$this->modi_by = Yii::$app->user->id;
			$this->modified = new \yii\db\Expression('NOW()');
			
		}
		return parent::beforeSave($insert);
    }

	public static function tableName()
    {
        return 'CTM_DPR_SHIFT_TAB';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'modified', 'create_by', 'modi_by', 'start_time', 'end_time'], 'safe'],
            [['description'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shift' => 'Shift',
            'description' => 'Description',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'create_by' =>  'Create By',
            'created' =>  'Created',
            'modi_by' => 'Modify By',
            'modified' => 'Modified',
        ];
    }
	
	public static function getShift(){
		$query = new Query;
		$query->select('shift,description')
		->from('ctm_dpr_shift_tab');
		// ->where(['not', ['(case when time(now()) > start_time and time(now()) < end_time then shift end)'=>null]]);
		
		$is = $query->all();
		return $is;	
		// return 2;	
	}
	
	public function getHour($date=null,$shift=null){
		$query = new Query;
		$query->select('start_time, end_time')
		->from('ctm_dpr_shift_tab')
		->where(['shift'=>$shift]);
		$is = $query->one();
		
		if(!empty($is)){
			if($shift == 3){
				$hour['start'] = date('Y-m-d H:i:s', strtotime($date. ' ' . $is['start_time']));
				$hour['finish'] = date('Y-m-d H:i:s', strtotime("+1 days", strtotime($date. ' ' . $is['end_time'])));
			}
			else {
				$hour['start'] = date('Y-m-d H:i:s', strtotime($date. ' ' . $is['start_time']));
				$hour['finish'] = date('Y-m-d H:i:s', strtotime($date. ' ' . $is['end_time']));
			}
			
		}		
		return $hour;	
		// return 2;	
	}
	
	public function getShift2($start, $finish){
		$query = new Query;
		$query->select('shift,description')
		->from('ctm_dpr_shift_tab')
		->where(['not', ['(case when "'.$start.'" > start_time and "'.$finish.'" < end_time then shift end)'=>null]]);
		
		$is = $query->all();
		return $is;	
		// return 2;	
	}
	
	public function getShift3($date=null, $start, $finish){
		$date1 = date('Y-m-d', strtotime($date));
		if($start > $finish) {
			$date2 = date('Y-m-d', strtotime($date .'+1 days'));
			
		}
		else {
			$date2 = date('Y-m-d', strtotime($date));
		}
		
		
		$query = new Query;
		$query->select('shift,description')
		->from('ctm_dpr_shift_tab')
		->where(['not', ['(case when "'.$date1.' '.$start.'" > CONCAT("'.$date1.'"," ",start_time) and "'.$date2.' '.$finish.'" < CONCAT("'.$date2.'"," ",end_time) then shift end)'=>null]]);
		
		$is = $query->all();
		print_r('(case when "'.$date1.' '.$start.'" > CONCAT("'.$date1.'"," ",start_time) and "'.$date2.' '.$finish.'" < CONCAT("'.$date2.'"," ",end_time) then shift end)');
		print('<pre>');print_r($is);print('</pre>');exit;
		return $is;	
		// return 2;	
	}

	public function getShift4($date, $time){
		// pr(($time > '22:00:00' && $time <= '23:59:59') || ($time >='00:00:00' && $time < '06:00:00'));exit;
		// $date1 = date('Y-m-d', strtotime($date));
		if(($time >='00:00:00' && $time < '06:00:00')) {
			$date2 = date('Y-m-d', strtotime('+1 days', strtotime($date)));
			
		}
		else {
			$date2 = date('Y-m-d', strtotime($date));
		}
		
		// pr($date);
		// pr($date2);
		// pr($time);exit;
		$sql = 'select shift, description from (select shift, description, concat("'.$date.'", " ",start_time) as date_start, concat((case when start_time > end_time then DATE_ADD("'.$date.'", INTERVAL 1 DAY) else "'.$date.'" end)," ", end_time) as date_finish from ctm_dpr_shift_tab) t where "'.$date2.' '.$time.'" >= date_start  and "'.$date2.' '.$time.'" <= date_finish';
		$is = \Yii::$app->db->createCommand($sql)->queryOne();
		// pr($is);exit;
		if(!empty($is)) return $is['shift'];
		else return 1;	
		// return 2;	
	}
}
