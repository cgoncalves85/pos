<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\InventarioAuditoria;
use app\models\InventarioAuditoriaProductos;

class InventarioAuditoriaForm extends Model
{
    private $_auditoria;
    private $_productos;

    
    public function rules()
    {
        return [
            [['InventarioAuditoria', 'Productos'], 'required'],
            [['Productos'], 'safe'],
        ];
    }

    public function save()
    {
       if(!$this->inventarioAuditoria->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->inventarioAuditoria->save()) {
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

            $producto->inventario_auditoria_id = $this->inventarioAuditoria->id;

            if (!$producto->save()) {
              return false;
            }
            $mantener[] = $producto->producto_id;
        }
        $query = InventarioAuditoriaProductos::find()->andWhere(['inventario_auditoria_id' => $this->inventarioAuditoria->id]);
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

        if (!$this->auditoria->delete()) {
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

    
    public function getInventarioAuditoria()
    {
        return $this->_auditoria;
    }

    public function setInventarioAuditoria($auditoria)
    {
        if ($auditoria instanceof InventarioAuditoria) {
            $this->_auditoria = $auditoria;
        } else if (is_array($auditoria)) {
            $this->_auditoria->setAttributes($auditoria);
        }
    }

    public function getProductos()
    {
        if ($this->_productos=== null) {
            $this->_productos = $this->inventarioAuditoria->isNewRecord ? [] : $this->inventarioAuditoria->productos;
        }
        return $this->_productos;
    }

    private function getProducto($key)
    {
        $producto = $key && strpos($key, 'nuevo') === false ? InventarioAuditoriaProductos::findOne($key) : false;
        if (!$producto) {
            $producto = new InventarioAuditoriaProductos();
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
            } elseif ($productos instanceof InventarioAuditoriaProductos) {
                $this->_productos[$producto->id] = $producto;
            }
        }
    }

}
