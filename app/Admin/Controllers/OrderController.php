<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Order(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('order_sn');
            $grid->column('name');
            $grid->column('pic')->image('', 100, 100);
            $grid->column('num');
            $grid->column('money_type');
            $grid->column('money');
            $grid->column('first_name');
            $grid->column('last_name');
            $grid->column('mobile');
            $grid->column('address');
            //0、未支付；1、已支付；2、已发货
            $grid->column('status')->radio(['未支付', '已支付', '已发货'], true);
            $grid->column('logistics_company')->editable(true);
            $grid->column('logistics_number')->editable(true);
            $grid->column('created_at');

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
            $grid->disableCreateButton();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Order(), function (Show $show) {
            $show->field('id');
            $show->field('order_sn');
            $show->field('name');
            $show->field('pic')->image('', 100, 100);
            $show->field('num');
            $show->field('money_type');
            $show->field('money');
            $show->field('first_name');
            $show->field('last_name');
            $show->field('mobile');
            $show->field('address');
            $show->field('status')->using(['未支付', '已支付', '已发货'])->label();
            $show->field('logistics_company');
            $show->field('logistics_number');
            $show->field('created_at');

            $show->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableDelete();
                });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Order(), function (Form $form) {
            $form->display('id');
            $form->text('order_sn');
            $form->text('product_id');
            $form->text('name');
            $form->text('pic');
            $form->text('num');
            $form->text('money_type');
            $form->text('money');
            $form->text('first_name');
            $form->text('last_name');
            $form->text('mobile');
            $form->text('address');
            $form->text('status');
            $form->text('logistics_company');
            $form->text('logistics_number');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
