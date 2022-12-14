<?php

namespace app\models;
use  yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

class ClientContacts extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true
            ],
        ];
    }

     /**
     * @return string table
     */
    public static function tableName()
    {
        return 'client_contacts';
    } 

     public function rules()
     {
         return [
            [['country_code', 'number'], 'string'],
            [['country_code', 'number'], 'required'],
            [['number'], 'string', 'length' => [9, 9]], 
         ];
     }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior('softDelete', SoftDeleteQueryBehavior::className());
        return $query->notDeleted();
    }
}