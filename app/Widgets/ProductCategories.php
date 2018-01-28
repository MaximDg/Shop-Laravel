<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Category;// подключили

class ProductCategories extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.product_categories', [
            'config' => $this->config,
            'categories' => Category::all()// передали в вид

        ]);
    }
}
