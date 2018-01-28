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

/**
 * Class Categorie
 *
 * @property \App\Manufacture $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Categorie extends Section implements Initializable
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
            return \App\Category::count();// заменили на Manufacture::count()
        });
    }
    public function onDisplay()
    {
        $table = AdminDisplay::table();// в AdminDisplay есть метод создания простой табл table()
        $table->setColumns(
            AdminColumn::text('id', '#'),//text - указывает на тип колонки. в первом параметре - название столбца из табл в БД. второй - заголовок колонки в таблице
            AdminColumn::text('name', 'Категория'),
            AdminColumn::image('thumb', 'Изображение')// для картинки/ в первом параметре - название столбца из табл в БД. второй - заголовок колонки в таблице
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
        return AdminForm::form()->setElements([// формирует форму. Встроенный метод
            AdminFormElement::text('name', 'Category Name')->required(),//->required() - обязательно для заполнения (т.к. обязательно при записи БД)
            AdminFormElement::image('thumb', 'Изображение'),//'thumb' - куда сохранять в БД.'Изображение' - название (типо лейба)
        ]);//Для формирования подлей используется класс AdminFormElement
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
