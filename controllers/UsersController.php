<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use app\models\Identity;
use app\components\AccessRule;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            	'ruleConfig' => [
            		'class' => AccessRule::className(),
            	],
                'only' => ['index','view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index','view', 'create', 'update', 'delete' ],
                        'allow' => true,
                        'roles' => [
                        	Identity::ROLE_ADMIN,
                        	Identity::ROLE_SUPERADMIN
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
    	
    	if(\Yii::$app->user->isGuest || !\Yii::$app->user->identity->isAdmin() )
    		throw new ForbiddenHttpException('You are not allowed to access this page.');
    	
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $model->setScenario('register');
		$post = Yii::$app->request->post();
        $formName = basename($model->className());
		
        if ( $model->load($post ) ) {
        	
        	// Default value
        	$model->is_super_admin = (isset($post[$formName]['is_super_admin']) ) ? $post[$formName]['is_super_admin'] : 0;
        	$model->role = ($model->is_super_admin) ? Identity::ROLE_SUPERADMIN : 30;
        	$model->fecha_conexion = (isset($post[$formName]['fecha_conexion']) ) ? $post[$formName]['fecha_conexion'] : Yii::$app->fn->GetDate('none');
        	$model->fecha_modif = (isset($post[$formName]['fecha_modif']) ) ? $post[$formName]['fecha_modif'] : Yii::$app->fn->GetDate('none');
        	$model->fecha_registro = (isset($post[$formName]['fecha_registro']) ) ? $post[$formName]['fecha_registro'] : Yii::$app->fn->GetDate();
        	$model->id_estado = (isset($post[$formName]['id_estado']) ) ? $post[$formName]['id_estado'] : 1;
        	
	        if ( $model->validate() ) {
	        		$model->setPassword();
	        		$model->generateAuthKey();
	        	if($model->save())
	        		return $this->redirect(['view', 'id' => $model->id]);
	        }
        }
        // Load empty/error form
		return $this->render('create', ['model' => $model] );
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$post = Yii::$app->request->post();
        $formName = basename($model->className());
		
        // default Form value
        $contrasenaPrevious = $model->contrasena;
        $model->contrasena = '';
        $model->passwordConfirm = '';
        
        if ( $model->load($post ) ) {
        	
        	// Default value
        	$model->is_super_admin = (isset($post[$formName]['is_super_admin']) ) ? $post[$formName]['is_super_admin'] : $model->is_super_admin;
        	$model->role = ($model->is_super_admin ) ? Identity::ROLE_SUPERADMIN : 30;
        	$model->fecha_modif = Yii::$app->fn->GetDate();
        	$model->id_estado = (isset($post[$formName]['id_estado']) ) ? $post[$formName]['id_estado'] : 1;
        	if($model->contrasena != $model->passwordConfirm)
        		$model->addError($model->passwordConfirm, 'Password Confirm must be repeated exactly.' );
        	
	        if ( !count($model->errors) && $model->validate() ) {
	        	if($model->contrasena == '') {
	        		$model->contrasena = $contrasenaPrevious;
	        	}
	        	else {
	        		$model->setPassword();
	        		$model->generateAuthKey();
	        	}
	        	if($model->save())
	        		return $this->redirect(['view', 'id' => $model->id]);
	        }
        }
        return $this->render('update', [
        	'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
