<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap4\ActiveForm;
use app\models\Cotizaciones;
use app\models\CotizacionesProductos;

class CotizacionesForm extends Model
{
    private $_cotizaciones;
    private $_productos;

    
    public function rules()
    {
        return [
            [['Cotizaciones', 'Productos'], 'required'],
            [['Productos'], 'safe'],
        ];
    }

    public function save()
    {
       if(!$this->cotizaciones->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->cotizaciones->save()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveProductos()) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }
    

    public function saveProductos()
    {
        $mantener = [];
        foreach ($this->productos as $producto) {

            $producto->cotizaciones_id = $this->cotizaciones->id;

            if (!$producto->save()) {
              return false;
            }
            $mantener[] = $producto->producto_id;
        }
        $query = CotizacionesProductos::find()->andWhere(['cotizaciones_id' => $this->cotizaciones->id]);
        if ($mantener) {
            //Filtrar por los productos que no estan en la lista de mantener
            $query->andWhere(['not in', 'producto_id', $mantener]);
        }

        foreach ($query->all() as $producto) {
            $producto->delete();
        }
        return true;
    }

    public function delete()
    {
        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->deleteProductos()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->cotizaciones->delete()) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }

    public function deleteProductos()
    {
        foreach ($this->productos as $producto) {
           if (!$producto->delete()) {
                return false;
            }
        }
        return true;
    }

    
    public function getCotizaciones()
    {
        return $this->_cotizaciones;
    }

    public function setCotizaciones($cotizaciones)
    {
        if ($cotizaciones instanceof Cotizaciones) {
            $this->_cotizaciones = $cotizaciones;
        } else if (is_array($cotizaciones)) {
            $this->_cotizaciones->setAttributes($cotizaciones);
        }
    }

    public function getProductos()
    {
        if ($this->_productos=== null) {
            $this->_productos = $this->cotizaciones->isNewRecord ? [] : $this->cotizaciones->productos;
        }
        return $this->_productos;
    }

    private function getProducto($key)
    {
        $producto = $key && strpos($key, 'nuevo') === false ? CotizacionesProductos::findOne($key) : false;
        if (!$producto) {
            $producto = new CotizacionesProductos();
            $producto->loadDefaultValues();
        }
        return $producto;
    }

    public function setProductos($productos)
    {
        unset($productos['__id__']);
        $this->_productos = [];
        foreach ($productos as $key => $producto) {
            if (is_array($producto)) {
                $this->_productos[$key] = $this->getProducto($key);
                $this->_productos[$key]->setAttributes($producto);
            } elseif ($productos instanceof CotizacionesProductos) {
                $this->_productos[$producto->id] = $producto;
            }
        }
    }

}
