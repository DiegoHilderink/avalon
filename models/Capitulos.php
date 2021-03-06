<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "capitulos".
 *
 * @property int $id identificaddor del objeto.
 * @property string $nombre nombre del objeto.
 * @property string $sinopsis resumen del objeto.
 *
 * @property Listacapitulos[] $listacapitulos
 */
class Capitulos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'capitulos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'sinopsis'], 'required'],
            [['sinopsis'], 'string'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'sinopsis' => 'Sinopsis',
        ];
    }

    /**
     * Gets query for [[Listacapitulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListacapitulos()
    {
        return $this->hasMany(Listacapitulos::className(), ['capitulo_id' => 'id'])->inverseOf('capitulo');
    }

    public static function findPorNombre($nombre) {
        return static::findOne(['nombre' => $nombre]);
    }
}
