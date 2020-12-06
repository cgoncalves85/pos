<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="cupones-descuento">
    <p>Hello <?= Html::encode($cliente[0]['nombre']) ?>,</p>

    <p>You WIN a discount's coupun</p>

    <p>N° Coupon : <?= $cupon ?> - Discount : <?= $descuento ?></p>
</div>
