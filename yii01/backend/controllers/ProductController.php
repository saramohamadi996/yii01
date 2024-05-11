<?php

namespace backend\controllers;

use backend\components\BaseRepository;
use backend\models\Product;
use yii\web\Controller;
use Yii;


//class ProductController extends Controller
//{
//    public function actionIndex()
//    {
//        $searchModel = new ProductSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
//
//    /**
//     * @throws NotFoundHttpException
//     */
//    public function actionView($id)
//    {
//        $model = $this->findModel($id);
//        return $this->render('view', ['model' => $model]);
//    }
//
//    public function actionCreate()
//    {
//        $model = new Product();
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//        return $this->render('create', ['model' => $model]);
//    }
//
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//        return $this->render('update', ['model' => $model]);
//    }
//
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//        return $this->redirect(['index']);
//    }
//
//    public function findModel($id)
//    {
//        if (($model = Product::findOne($id)) !== null) {
//            return $model;
//        }
//        throw new NotFoundHttpException('The requested page does not exist.');
//    }
//}


class ProductController extends Controller
{
    private $repository;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repository = new BaseRepository(Product::class);
    }

    public function actionIndex()
    {
        // Logic to get data for index page
    }

    public function actionView($id)
    {
        $model = $this->repository->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = $this->repository->createModel(Yii::$app->request->post());
        if ($model) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => new Product()]);
    }

    public function actionUpdate($id)
    {
        $model = $this->repository->updateModel($id, Yii::$app->request->post());
        if ($model) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->repository->deleteModel($id);
        return $this->redirect(['index']);
    }
}
