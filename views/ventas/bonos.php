<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bonos */
/* @var $form ActiveForm */
?>
<div class="ventas-bonos pt-2 pl-4 pr-4 pb-2">
    <?php if (count($listaBonos) == 0) { ?>
        <div class="content-alert bg-danger">
            <label class="text-uppercase" style="font-size: .95em;"><i class="fa fa-info-circle mr-2" aria-hidden="true"></i>El Cliente NO posee puntos suficientes para ser canjeados.</label>
        </div>
    <?php } else { ?>
        <table class="table table-fluid table-striped mt-2">
            <thead align="center">
                <th>Descripción del Bono</th>
                <th>Puntos Necesarios</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach ($listaBonos as $bono) { ?>
                    <tr>
                        <td class="lbl-view" style="vertical-align: middle;"><?= $bono->observacion ?></td>
                        <td align="center"><?= Yii::$app->formatter->asInteger($bono->cantidad_puntos) ?> <small class="x-small">PTOS.</small>
                        </td>
                        <td align="center">
                            <?= Html::button('Aplicar Bono', ['class' => 'btn btn-primary btn-sm text-uppercase', 'onclick' => 'aplicarBono('.$bono->id.');', 'id' => $bono->id]) ?>
                        </td>
                    </tr>
               <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div><!-- ventas-bonos -->
