<?php

namespace app\controllers;

use app\models\Clients;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


class ClientsController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'details', 'update', 'create', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'details', 'update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Clients::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $clients = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'clients' => $clients,
            'pagination' => $pagination,
        ]);
    }

    public function actionDetails($id)
    {
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        return $this->render('details', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $request = \yii::$app->request;

        if($request->isPost){
            $model = new Clients();
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://app.pixelencounter.com/api/basic/monsters/random']);
            $photo = $client->request('GET');
            $model->attributes =  $request->post(); 
            $model->photo = $photo->getBody()->getContents();
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();           
            return $this->redirect(['clients/index']);

        }

        return $this->render('create');
    }

    public function actionUpdate($id)
    {
        $model = Clients::findOne($id);

        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        $request = \yii::$app->request;
        
        if($request->isPost){
            $model->attributes =  $request->post(); 
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            
            return $this->redirect(['clients/index']);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $model = Clients::findOne($id);
        if(!$model) throw new NotFoundHttpException("Página não encontrada");

        $model->deleted_at = date('Y-m-d H:i:s');
        $model->delete();
        return $this->redirect(['clients/index']);
    }

}
