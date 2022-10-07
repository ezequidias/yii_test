<?php

namespace app\models;
use  yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

class Clients extends ActiveRecord
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
        return 'clients';
    } 

     public function rules()
     {
         return [
            [['name', 'email'], 'required'],  
            [['email'], 'string', 'max' => 255], 
            [['name'], 'string', 'min' => '5'],
            [['email'], 'email'], 
         ];
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior('softDelete', SoftDeleteQueryBehavior::className());
        return $query->notDeleted();
    }

    public function getContacts()
    {
        return $this->hasMany(ClientContacts::class, ['client_id' => 'id']);
    }

}