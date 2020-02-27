<?php

namespace App\Admin\Controllers;

use App\Model\AppModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AppController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'APP管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AppModel());

        $grid->column('id', __('Id'));
        $grid->column('uid', __('用户ID'));
        $grid->column('appid', __('Appid'));
        $grid->column('secret', __('Secret'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(AppModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('uid', __('Uid'));
        $show->field('appid', __('Appid'));
        $show->field('secret', __('Secret'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AppModel());

        $form->number('uid', __('Uid'));
        $form->text('appid', __('Appid'));
        $form->text('secret', __('Secret'));

        return $form;
    }
}
