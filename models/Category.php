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

    public static $limit_popular_products = 6;
    public static $limit_recommend_products = 6;
    public static $pagination_page_size = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
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
