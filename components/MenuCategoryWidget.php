<?php
/**
 * Created by PhpStorm.
 * User: Konstantin
 * Date: 05.02.2017
 * Time: 17:41
 */

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;

class MenuCategoryWidget extends Widget
{
    public $template;
    public $model;
    public $data;
    public $tree;
    public $menuHtml;
    private $set_second_cache = 60;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        if ($this->template === null)
        {
            $this->template = 'menu';
        }
        $this->template .= '.php';
    }

    public function run()
    {
        //get cache
        if ($this->template == 'menu.php')
        {
            $cacheMenu = Yii::$app->cache->get('menu');
            if ($cacheMenu)
                return $cacheMenu;
        }

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //set cache
        if ($this->template == 'menu.php')
            Yii::$app->cache->set('menu', $this->menuHtml, $this->set_second_cache);

        return $this->menuHtml;
    }

    protected function getTree()
    {
        $tree = [];

        foreach ($this->data as $id => &$node)
        {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $category)
        {
            $str .= $this->toTemplate($category, $tab);
        }

        return $str;
    }

    protected function toTemplate($category, $tab)
    {
        ob_start();
        include __DIR__ . '/template_menu/' . $this->template;

        return ob_get_clean();
    }
}