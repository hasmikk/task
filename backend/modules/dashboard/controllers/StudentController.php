<?php

namespace backend\modules\dashboard\controllers;

use common\models\search\SearchStudent;
use common\models\Student;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchStudent();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->new_password);

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Password successfully updated !');
            } else {
                Yii::$app->getSession()->setFlash('warning', 'Failed to reset password!');
            }

            return $this->redirect(['index']);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        $html = $this->renderPartial('reset_password', [
            'model' => $model,
        ]);

        return [
            'html' => $html,
            'success' => true
        ];
    }

    public function actionSendMail($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $html = $this->renderPartial('partial/mail_form', [
                'model' => $model,
            ]);

            return [
                'html' => $html,
                'success' => true
            ];
        }

        if (Yii::$app->request->isPost) {
            $subject = Yii::$app->request->post('subject');
            $body = Yii::$app->request->post('body');
            $mailTo = Yii::$app->request->post('email');
            $mailFrom = Yii::$app->params['email'];

            if ($model->sendMail($mailFrom, $mailTo, $subject, $body)) {
                Yii::$app->getSession()->setFlash('success', 'Mail request sent!');
            }else{
                Yii::$app->getSession()->setFlash('danger', 'Failed to process data!');
            }

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }


    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
