<?php

namespace app\controllers;


use Yii;
use app\models\Home;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\Expression;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\db\ActiveRecord;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class HomeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'value' => new Expression('NOW()'),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $this->view->title = 'Все статьи';

        $sort = new Sort([
            'attributes' => [
                'time_add' => [
                    'asc' => ['time_add' => SORT_ASC],
                    'desc' => ['time_add' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Дата',
                ],
            ],
        ]);

        $query = Home::find()->where('flag = 1');
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sort->orders)
            ->all();
        return $this->render('index', compact('posts', 'pages', 'sort'));
    }

    public function actionShow($id) {

        $model = Home::findOne($id);
        return $this->render('show', compact('model'));

    }

    public function actionAdd() {

        $model = new Home();
        if ($model->load(Yii::$app->request->post())) {
            $model->ip = Yii::$app->request->userIP;
            $model->time_add = gmdate("Y-m-d H:i:s",);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные успешно отправлены');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->render('add', ['model' => $model]);
    }

}

