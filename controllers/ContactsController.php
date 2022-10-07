<?php

namespace app\controllers;

use app\models\Clients;
use app\models\ClientContacts;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ContactsController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

     public function actionIndex()
    {
        $contacts = ClientContacts::find()
        ->select(['count(*) AS count','country_code'])
        ->groupBy('country_code')
        ->asArray()
        ->all();

        return $this->render('index', [
            'contacts' => $contacts,
        ]);
    }

     public function actionCreate($id)
    {
        $request = \yii::$app->request;
        $countries = [];
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com/v2/all']);
        $client = $client->request('GET');
        $res = json_decode($client->getBody());
        foreach($res as $country) $countries[$country->callingCodes[0]] = $country->name. ' ('.$country->callingCodes[0].')';

        $contact = new ClientContacts();

        if($request->isPost){
            $contact->load($request->post());
            $country_code = $request->post('ClientContacts')['country_code'];
            $number = $request->post('ClientContacts')['number'];
            $exists_number = Clients::find()->innerJoinWith('contacts')->where(['client_contacts.country_code' => $country_code])->where(['client_contacts.number' => $number])->one();
            if($exists_number){
                \yii::$app->getSession()->setFlash('error', 'Number already registered! Use another number');
                return $this->render('create', ['model' => $model, 'model_contact' => $contact, 'countries' => $countries]);
            }

            if ($contact->validate()) {
                $contact->client_id = $id;
                $contact->attributes = $request->post(); 
                $contact->created_at = date('Y-m-d H:i:s');
                $contact->save();  
                return $this->redirect(['clients/'.$id.'/update']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'model_contact' => $contact,
            'countries' => $countries
        ]);
    }

    public function actionUpdate($id, $id_contact)
    {
        $request = \yii::$app->request;
        $countries = [];
        $model = Clients::find()->where(['id' => $id])->one();
        $contact = $model->getContacts()->where(['id' => $id_contact])->one();
        if(!$model) throw new NotFoundHttpException("Página não encontrada");
        if(!$contact) throw new NotFoundHttpException("Página não encontrada");
        
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com/v2/all']);
        $client = $client->request('GET');
        $res = json_decode($client->getBody());
        foreach($res as $country) $countries[$country->callingCodes[0]] = $country->name. ' ('.$country->callingCodes[0].')';

        if($request->isPost){
            $contact->load($request->post());
            $country_code = $request->post('ClientContacts')['country_code'];
            $number = $request->post('ClientContacts')['number'];
            $exists_number = Clients::find()->innerJoinWith('contacts')->where(['!=', 'client_contacts.id', $id_contact])->andWhere(['client_contacts.country_code' => $country_code])->andWhere(['client_contacts.number' => $number])->one();
            if($exists_number){
                \yii::$app->getSession()->setFlash('error', 'Number already registered! Use another number');
                return $this->render('update', ['model' => $model, 'model_contact' => $contact, 'countries' => $countries]);
            }

            if ($contact->validate()) {
                $contact->attributes = $request->post(); 
                $contact->updated_at = date('Y-m-d H:i:s');
                $contact->save();
                return $this->redirect(['clients/'.$id.'/update']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_contact' => $contact,
            'countries' => $countries
        ]);
    }

    public function actionDelete($id, $id_contact)
    {
        $model = Clients::find()->where(['id' => $id])->one();
        $contact = $model->getContacts()->where(['id' => $id_contact])->one();
        if(!$model) throw new NotFoundHttpException("Página não encontrada");
        if(!$contact) throw new NotFoundHttpException("Página não encontrada");

        $contact->deleted_at = date('Y-m-d H:i:s');
        $contact->delete();
        return $this->redirect(['clients/'.$id.'/update']);
    }


}
