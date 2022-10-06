<?php

namespace app\controllers;

use app\models\Clients;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ContactsController extends \yii\web\Controller
{

     public function actionCreate($id)
    {
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com/v3.1/all']);
        $res = $client->request('GET');

        $request = \yii::$app->request;

        if($request->isPost){
            $model = new Clients();

            $model->attributes =  $request->post(); 
            $model->save();           
            return $this->redirect(['clients/index']);

        }

        return $this->render('create', [
            'model' => $model,
            'countries' => json_decode($res->getBody()->getContents())
        ]);
    }
  

}
