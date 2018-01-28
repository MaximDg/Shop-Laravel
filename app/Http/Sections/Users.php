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
use AdminColumnEditable;

/**
 * Class Users
 *
 * @property \App\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section implements Initializable
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
            return \App\User::count();// заменили на User::count()
        });
    }
    public function onDisplay()
    {
        $table = AdminDisplay::table();
        $table->with('roles');// таблица будет браться из roles
        $table->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),//задали ширину колонки
                AdminColumn::link('name', 'Name'),
                AdminColumn::text('email', 'Email'),
                AdminColumn::lists('roles.name', 'Role')//lists - вернет нормальный вид массива
        );
        return $table;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::form()->setElements([
                AdminFormElement::text('name', 'User Name')->required(),
                AdminFormElement::text('email', 'User Email')->required(),
                AdminFormElement::password('password', 'User Password')->hashWithBcrypt()->required(),//hashWithBcrypt() - шифрует т.к. это пароль
                AdminFormElement::multiselect('roles', 'Roles', \App\Role::class)->setDisplay('name')//multiselect - позволяет выбрать несколько
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
