<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarioshows".
 *
 * @property int $id
 * @property int $objetos_id
 * @property int $usuario_id
 * @property int $seguimiento_id
 * @property string $tipo
 *
 * @property Seguimiento $seguimiento
 * @property Shows $objetos
 * @property Usuarios $usuario
 */
class Usuarioshows extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarioshows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['objetos_id', 'usuario_id', 'seguimiento_id', 'tipo'], 'required'],
            [['objetos_id', 'usuario_id', 'seguimiento_id'], 'default', 'value' => null],
            [['objetos_id', 'usuario_id', 'seguimiento_id'], 'integer'],
            [['tipo'], 'string', 'max' => 10],
            [['seguimiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seguimiento::className(), 'targetAttribute' => ['seguimiento_id' => 'id']],
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
            'usuario_id' => 'Usuario ID',
            'seguimiento_id' => 'Seguimiento ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[Seguimiento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguimiento()
    {
        return $this->hasOne(Seguimiento::className(), ['id' => 'seguimiento_id'])->inverseOf('usuarioshows');
    }

    /**
     * Gets query for [[Objetos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasOne(Shows::className(), ['id' => 'objetos_id'])->inverseOf('usuarioshows');
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('usuarioshows');
    }
}
