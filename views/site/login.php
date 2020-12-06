<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Ingrese sus datos para Iniciar Sesión</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <p class="mb-1">
            <?= Html::a('Olvidé mi contraseña', ['site/forgot-password'], ['class' => 'btn-link']) ?>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>