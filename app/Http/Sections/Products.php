<?php

namespace App\Http\Sections;

use AdminColumn;// заменили из документации все use
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;
use AdminColumnEditable;// этот метод изначально не подключен - подключить

/**
 * Class Products
 *
 * @property \App\Category $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Products extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
        public function initialize()// добавили из документации
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500, function() {// сортировка меню бует по $priority = 
            return \App\Product::count();// заменили на Manufacture::count()
        });
    }
    public function onDisplay()
    {
        $table = AdminDisplay::datatablesAsync();// в AdminDisplay есть еще один метод создания простой табл datatablesAsync()
        $table->with('category', 'manufacture');// связи указали в файле продукт.пхп (модель)
        $table->setColumns(
            AdminColumn::text('id', '#'),//text - указывает на тип колонки. в первом параметре - название столбца из табл в БД. второй - заголовок колонки в таблице
            AdminColumn::link('name', 'Продукт'),// link ссылка на редактирование товара а не просто текст
            AdminColumn::image('thumb', 'Изображение'),// для картинки/ в первом параметре - название столбца из табл в БД. второй - заголовок колонки в таблице
            AdminColumnEditable::text('price', 'Цена'),// AdminColumnEditable - вариант отображения (прайс сразу можно редактировать)
            AdminColumnEditable::text('price_sale', 'Цена со скидкой'),
            AdminColumn::text('category.name', 'Категория'),
            AdminColumn::text('manufacture.name', 'Производитель'),
            AdminColumnEditable::checkbox('new', 'Да', 'Нет')->setLabel('Новинка'),
            AdminColumnEditable::checkbox('in_stock', 'Да', 'Нет')->setLabel('В наличии'),
            AdminColumnEditable::checkbox('sale', 'Да', 'Нет')->setLabel('Скидка')
                    );// устанавливаем колонки
        return $table;// вернуть таблицу
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel();// создаем форму на добавление товаров. panel() формирует внешний вид шапку, тело, низ
        $form->addBody([// выводить будем в бади
            AdminFormElement::columns()//выводим колонки
                ->addColumn([
                    AdminFormElement::text('name', 'Product Name')->required(),// описываем колонки
                    AdminFormElement::text('price', 'Price')->required(),
                    AdminFormElement::text('price_sale', 'Price sale'),
                    AdminFormElement::ckeditor('description', 'Description'),//ckeditor - визуальный редактор
                    AdminFormElement::image('thumb', 'Image'),
                ], 7)//второй параметр - чать от 12 как в бутстрапе
                ->addColumn([
                    AdminFormElement::select('category_id', 'Category', \App\Category::class)->setDisplay('name')->required(),//3й параметр- полный путь к нужной модели. ->setDisplay()что именно выводить в селекте (имя категории)
                    AdminFormElement::select('manufacture_id', 'Manufacture', \App\Manufacture::class)->setDisplay('name')->required(),
                    AdminFormElement::checkbox('in_stock', 'In Stock')->mutateValue(function($value) {
                                    return $value?'1':'0';// если велью есть - передать то что в нем. Если не существует  - записать 0
                                }),//mutateValue - Изменение значения поля перед передачей в модель. Если без этого. то без галочки будет ошибка. так как велью не будет вообще и нечего писать в БД
                    AdminFormElement::checkbox('new', 'New')->mutateValue(function($value) {
                                    return $value?'1':'0';// если велью есть - передать то что в нем. Если не существует  - записать 0
                                }),//mutateValue - Изменение значения поля перед передачей в модель.  Если без этого. то без галочки будет ошибка. так как велью не будет вообще и нечего писать в БД
                    AdminFormElement::checkbox('sale', 'Sale')->mutateValue(function($value) {
                                    return $value?'1':'0';// если велью есть - передать то что в нем. Если не существует  - записать 0
                                }),//mutateValue - Изменение значения поля перед передачей в модель.  Если без этого. то без галочки будет ошибка. так как велью не будет вообще и нечего писать в БД
                ], 5)
        ]);
        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
