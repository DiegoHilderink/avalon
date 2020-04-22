<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valoraciones".
 *
 * @property int $id
 * @property int $objetos_id
 * @property int $usuario_id
 * @property int $valoracion
 * @property string|null $comentario
 *
 * @property Shows $objetos
 * @property Usuarios $usuario
 */
class Valoraciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valoraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['objetos_id', 'usuario_id', 'valoracion'], 'required'],
            [['objetos_id', 'usuario_id', 'valoracion'], 'default', 'value' => null],
            [['objetos_id', 'usuario_id', 'valoracion'], 'integer'],
            [['comentario'], 'string'],
            [['objetos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shows::className(), 'targetAttribute' => ['objetos_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetos_id' => 'Objetos ID',
            'usuario_id' => 'usuario ID',
            'valoracion' => 'Valoracion',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * Gets query for [[Objetos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasOne(Shows::className(), ['id' => 'objetos_id'])->inverseOf('valoraciones');
    }

    /**
     * Gets query for [[usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('valoraciones');
    }
}
