<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property string $id
 * @property string $profile_id
 * @property string $file_id
 * @property string $parent_id
 * @property string $lang_code
 * @property string $title
 * @property string $subtitle
 * @property string $content
 * @property string $excerpt
 * @property string $type
 * @property string $status
 * @property integer $comment_status
 * @property string $next_post
 * @property string $time
 * @property string $update_time
 *
 * @property PostCategories[] $postCategories
 * @property PostComments[] $postComments
 * @property PostFiles[] $postFiles
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'title', 'content', 'type',], 'required'],
            [['profile_id', 'file_id', 'category_id', 'comment_status', 'next_post', 'time', 'update_time'], 'integer'],
            [['content', 'type', 'status'], 'string'],
            [['lang_code'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 128],
            [['subtitle', 'excerpt'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'category_id' => Yii::t('app', 'Kategorija'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'content' => Yii::t('app', 'Content'),
            'excerpt' => Yii::t('app', 'Excerpt'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'next_post' => Yii::t('app', 'Next Post'),
            'time' => Yii::t('app', 'Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PostCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostComments()
    {
        return $this->hasMany(PostComments::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostFiles()
    {
        return $this->hasMany(PostFiles::className(), ['post_id' => 'id']);
    }
}
