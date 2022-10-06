<?php

namespace app\controllers;

use app\models\Clients;
use app\models\ClientContacts;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ContactsController extends \yii\web\Controller
{

     public function actionCreate($id)
    {
        $errors = [];
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com/v3.1/all']);
        $res = $client->request('GET');

        $request = \yii::$app->request;

        if($request->isPost){
            $contact = new ClientContacts();
            // var_dump($request->post());
            // $contact->load($request->post());
            // if ($contact->validate()) {
                $contact->client_id = $id;
                $contact->country_code =  $request->post('country_code'); 
                $contact->number = $request->post('number');
                $contact->created_at = date('Y-m-d H:i:s');
                $contact->save();  
                $errors = [];
                // return $this->redirect(['clients/'.$id.'/update']);
            // } else {
            //     // validation failed: $errors is an array containing error messages
            //     $errors = $contact->errors;
            // }
        }

        return $this->render('create', [
            'model' => $model,
            'errors' => $errors,
            'countries' => json_decode($res->getBody()->getContents())
        ]);
    }

    public function actionUpdate($id, $id_contact)
    {
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");
        
        $contact = ClientContacts::findOne($id_contact);
        if(!$contact) throw new NotFoundHttpException("Página não encontrada");

        $request = \yii::$app->request;
        
        if($request->isPost){
            $model->attributes =  $request->post(); 
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['clients/'.$id.'/update']);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id, $id_contact)
    {
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        $contact = ClientContacts::findOne($id_contact);
        if(!$contact) throw new NotFoundHttpException("Página não encontrada");

        $contact->deleted_at = date('Y-m-d H:i:s');
        $contact->delete();
        return $this->redirect(['clients/'.$id.'/update']);
    }


}
