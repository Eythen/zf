<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Product;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Ramsey\Uuid\Uuid;

class ProductController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Product(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('pic')->image('', 100, 100);
            $grid->column('money');
            $grid->column('money_type');
            $grid->column('num');
            $grid->column('二维码')->qrcode(function () {
                return env('APP_URL') . "?uid=" . $this->uid;
            }, 200, 200);
            $grid->column('链接')->display(function () {
                return env('APP_URL') . "?uid=" . $this->uid;
            })->copyable();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
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
        return Show::make($id, new Product(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('pic');
            $show->field('money');
            $show->field('money_type');
            $show->field('num');
            $show->field('uid');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Product(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->image('pic')->disk('admin')->saveFullUrl()->uniqueName()->autoUpload();
            $form->text('money')->required();
            //USD美元TWD台币HKD港币SGD新加坡元
            $form->radio('money_type')->options(['USD' => '美元', 'TWD'=> '台币', 'HKD' => '港币', 'SGD' => '新加坡元'])->default('USD');
            $form->number('num')->required();
            $data = Uuid::uuid1();
            $form->hidden('uid')->value($data->getHex());

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
