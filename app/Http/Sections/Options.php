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
 * Class Options
 *
 * @property \App\Option $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Options extends Section implements Initializable
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
            return \App\Option::count();// заменили на Manufacture::count()
        });
    }
    public function onDisplay()
    {
        $table = AdminDisplay::table();// в AdminDisplay есть метод создания простой табл table()
        $table->setColumns(
            AdminColumn::text('id', '#'),//text - указывает на тип колонки. в первом параметре - название столбца из табл в БД. второй - заголовок колонки в таблице
            AdminColumn::text('name', 'Ресурс'),
            AdminColumn::text('value', 'Данные')
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
        $form = AdminForm::form()->setElements([
                AdminFormElement::text('name', 'Ресурс')->required(),
                AdminFormElement::text('value', 'Данные')->required()

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
