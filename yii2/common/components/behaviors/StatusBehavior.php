<?php
/**
 * Created by PhpStorm.
 * User: SergLit
 * Date: 05.01.2018
 * Time: 18:25
 */

namespace common\components\behaviors;
use yii\base\Behavior;
use yii\base\Model;
use yii\db\ActiveRecord;

class StatusBehavior extends Behavior
{

    public $statusList ;

     public function events()
     {
         return [
           //  ActiveRecord::EVENT_AFTER_FIND => 'afterFindStatus'
         ];
     }

    public function getStatusList ()
    {
       return $this -> statusList;
    }

    public function getStatusName ()
    {
        $list = $this->owner->getStatusList();
        return $list[$this->owner->status_id];
    }

    /*
    public function AfterFindStatus ()
    {
        $this->owner->title = $this->owner->title .'  '.  $this->owner->date_create ;
    }
     */


}