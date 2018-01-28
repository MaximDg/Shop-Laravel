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
use App\OrderItem;


class Orders extends Section implements Initializable
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
public function initialize()// добавили из документации
    {
        // Добавление пункта меню и счетчика кол-ва записей в разделе
        $this->addToNavigation($priority = 500, function() {// сортировка меню бует по $priority = 
            return \App\Order::count();// заменили на Order::count()
        });
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table() // 
        ->with('user')//используется функция юзер, связывающая модели в Ордер.пхп
        ->setColumns(
                AdminColumn::link('id', '#')->setWidth('30px'),//link ссылка будет вести всегда на то что прописано в public function onEdit($id)
                AdminColumn::relatedLink('user.email', 'Почта заказчика'),
                AdminColumn::text('total_sum', 'Сумма заказа')

            );
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)// теперь кнопка редактирования в админке работать не будет, так как изменили функцию
    {
        $orderItem = OrderItem::where('order_id', $id)->get();//формируем вывод всех заказов одного пользователя при клике на айди
        $html = '<ul>';
            foreach ($orderItem as $item) {
                $html.='<li>';
                $html.=$item->product->name.',';
                $html.=$item->quantity.',';
                $html.=$item->price;
                $html.='</li>';
            }
        $html.= '</ul>';
        return $html;
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
