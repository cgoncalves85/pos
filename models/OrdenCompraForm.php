<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap4\ActiveForm;
use app\models\OrdenCompra;
use app\models\OrdenProductos;

class OrdenCompraForm extends Model
{
    private $_orden;
    private $_productos;

    
    public function rules()
    {
        return [
            [['OrdenCompra', 'Productos'], 'required'],
            [['Productos'], 'safe'],
        ];
    }

    public function save()
    {
       if(!$this->ordenCompra->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->ordenCompra->save()) {
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

            $producto->orden_compra_id = $this->ordenCompra->id;

            if (!$producto->save()) {
              return false;
            }
            $mantener[] = $producto->producto_id;
        }
        $query = OrdenProductos::find()->andWhere(['orden_compra_id' => $this->ordenCompra->id]);
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

        if (!$this->orden->delete()) {
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

    
    public function getOrdenCompra()
    {
        return $this->_orden;
    }

    public function setOrdenCompra($orden)
    {
        if ($orden instanceof OrdenCompra) {
            $this->_orden = $orden;
        } else if (is_array($orden)) {
            $this->_orden->setAttributes($orden);
        }
    }

    public function getProductos()
    {
        if ($this->_productos=== null) {
            $this->_productos = $this->ordenCompra->isNewRecord ? [] : $this->ordenCompra->productos;
        }
        return $this->_productos;
    }

    private function getProducto($key)
    {
        $producto = $key && strpos($key, 'nuevo') === false ? OrdenProductos::findOne($key) : false;
        if (!$producto) {
            $producto = new OrdenProductos();
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
            } elseif ($productos instanceof OrdenProductos) {
                $this->_productos[$producto->id] = $producto;
            }
        }
    }

}
