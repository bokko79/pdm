<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qs_works".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property QsSubworks[] $qsSubworks
 */
class QsWorks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qs_works';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv kategorije'),
            'description' => Yii::t('app', 'Opis kategorije'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQsSubworks()
    {
        return $this->hasMany(QsSubworks::className(), ['work_id' => 'id']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectQs()
    {
        return $this->hasMany(ProjectQs::className(), ['work_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function posOfProject($project)
    {
        return \common\models\ProjectQs::find()->where('project_id='.$project.' and work_id='.$this->id)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function subsOfProjectWork($project)
    {
        $run = [];
        foreach($this->posOfProject($project) as $position){

        }
        return \common\models\ProjectQs::find()->where('project_id='.$project.' and work_id='.$this->id)->all();
    }
}
