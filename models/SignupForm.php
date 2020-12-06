<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nombre_completo;
    public $username;
    public $email;
    public $tienda_id;
    public $password;
    public $rol_id;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'nombre_completo', 'rol_id', 'tienda_id'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'El nombre de usuario ya está siendo utilizado..'],
            ['nombre_completo', 'string', 'max' => 255],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Esta dirección de correo electrónico ya está siendo utilizada..'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombre_completo' => 'Nombre Completo',
            'username' => 'Usuario',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'tienda_id' => 'Tienda',
            'rol_id' => 'Rol',

        ];
    }      

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->nombre_completo = $this->nombre_completo;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->tienda_id = $this->tienda_id;
        $user->rol_id = $this->rol_id;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
