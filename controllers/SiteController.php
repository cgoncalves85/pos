<?php

namespace app\controllers;

use Yii;
use app\models\Ventas;
use app\models\Clientes;
use app\models\Proveedores;
use app\models\Productos;
use app\models\Cupones;
use app\models\Gastos;
use app\models\Bancos;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\search\UserSearch;
use app\models\Rol;
use app\models\Tiendas;
use app\models\AccessHelpers;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
     
        $operacion = str_replace("/", "-", Yii::$app->controller->route);
     
        $permitirSiempre = ['site-captcha', 'site-index', 'site-error', 'site-contact', 'site-login', 'site-logout'];
     
        if (in_array($operacion, $permitirSiempre)) {
            return true;
        }
     
        if (!AccessHelpers::getAcceso($operacion)) {
            echo $this->render('../nopermitido');
            exit;
            return false;
        }
     
        return true;
    } 

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $v = (new \yii\db\Query())
            ->select(['Month(fecha) as mes', 'count(*) as cantidad'])
            ->from('ventas')
            ->where(['status' => 1])
            ->groupBy('Month(fecha)')
            ->all();

        for ($i=0; $i < count($v) ; $i++) {
            for ($j=0; $j < 12 ; $j++) { 
                if ($v[$i]['mes'] == $j+1) {
                    $valor = $v[$i]['cantidad'];
                    $datos[$j] = $valor;
                } else {
                    if (empty($datos[$j])) {
                        $datos[$j] = '0';
                    }
                }
            }            
        }

        $ventas = Ventas::find()->where(['status' => 1])->all();
        $nro_ventas = count($ventas);

        $clientes = Clientes::find()->where(['status' => 1])->all();
        $nro_clientes = count($clientes);

        $proveedores = Proveedores::find()->where(['status' => 1])->all();
        $nro_proveedores = count($proveedores);

        $productos = Productos::find()->where(['status' => 1])->all();
        $nro_productos = count($productos);

        $existencias = (new \yii\db\Query())
            ->select(['sum(cantidad) as cant'])
            ->from('existencias')
            ->where(['tienda_id' => $id_tienda])
            ->all();
        $nro_existencias = intval($existencias[0]['cant']);

        $gastos = Gastos::find()->where(['tienda_id' => $id_tienda])->all();
        $nro_gastos = count($gastos);

        $cupones = Cupones::find()->all();
        $nro_cupones = count($cupones);         

        $bancos = Bancos::find()->where(['status' => 1])->all();
        $nro_bancos = count($bancos);                         

        return $this->render('index', [
            'datos' => $datos,
            'nro_ventas' => $nro_ventas,
            'nro_clientes' => $nro_clientes,
            'nro_proveedores' => $nro_proveedores,
            'nro_productos' => $nro_productos,
            'nro_existencias' => $nro_existencias,
            'nro_gastos' => $nro_gastos,
            'nro_cupones' => $nro_cupones,
            'nro_bancos' => $nro_bancos,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }   

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre');         

        $buscaRoles = Rol::find()->all();
        $roles = ArrayHelper::map($buscaRoles, 'id', 'nombre');

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
            'tiendas' => $tiendas,
            'roles' => $roles,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
