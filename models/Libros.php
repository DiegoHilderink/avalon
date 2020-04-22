<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isbn
 * @property int $editorial_id
 * @property int $autor_id
 * @property int $genero_id
 * @property int $pais_id
 * @property string|null $evento_id
 * @property string|null $fecha
 * @property string|null $sinopsis
 *
 * @property Criticas[] $criticas
 * @property Empresas $editorial
 * @property Generos $genero
 * @property Integrantes $autor
 * @property Paises $pais
 */
class Libros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['fecha'], 'safe'],
            [['sinopsis'], 'string'],
            [['nombre', 'evento_id'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
            [['editorial_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::className(), 'targetAttribute' => ['editorial_id' => 'id']],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generos::className(), 'targetAttribute' => ['genero_id' => 'id']],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Integrantes::className(), 'targetAttribute' => ['autor_id' => 'id']],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paises::className(), 'targetAttribute' => ['pais_id' => 'id']],
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
            'isbn' => 'Isbn',
            'editorial_id' => 'Editorial ID',
            'autor_id' => 'Autor ID',
            'genero_id' => 'Genero ID',
            'pais_id' => 'Pais ID',
            'evento_id' => 'Evento ID',
            'fecha' => 'Fecha',
            'sinopsis' => 'Sinopsis',
        ];
    }

    /**
     * Gets query for [[Criticas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriticas()
    {
        return $this->hasMany(Criticas::className(), ['libro_id' => 'id'])->inverseOf('libro');
    }

    /**
     * Gets query for [[Editorial]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEditorial()
    {
        return $this->hasOne(Empresas::className(), ['id' => 'editorial_id'])->inverseOf('libros');
    }

    /**
     * Gets query for [[Genero]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Generos::className(), ['id' => 'genero_id'])->inverseOf('libros');
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Integrantes::className(), ['id' => 'autor_id'])->inverseOf('libros');
    }

    /**
     * Gets query for [[Pais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Paises::className(), ['id' => 'pais_id'])->inverseOf('libros');
    }

    public function getCriticasWithUsers($sort = null)
    {
        return $this->getCriticas()->select('u.*, *')->joinWith('usuario u')->orderBy(isset($sort) ? $sort->orders : 'id')->all();
    }
}
