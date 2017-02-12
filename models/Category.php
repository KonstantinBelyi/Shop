<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    //===================================================================================
    //возвращает категорию, конкатенирует поля с его родителем
    public static function getConcatenationParentAndCategory($id)
    {
        $category = Category::findOne($id);

        if (empty($category))
            return null;

        if (!$category->parent_id)
            return $category;

        $category_parent = Category::findOne($category->parent_id);

        $fieldsCategory = [
            'name' => $category->name . ' ' . $category_parent->name,
            'keywords' => $category->keywords . ' ' . $category_parent->keywords,
            'description' => $category->description . ' ' . $category_parent->description,
        ];

        return $fieldsCategory;
    }
    //===================================================================================
}
