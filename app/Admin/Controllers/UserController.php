<?php

namespace App\Admin\Controllers;

use App\Model\UserModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserModel());

        $grid->column('id', __('Id'));
        $grid->column('cname', __('公司名称'));
        $grid->column('username', __('用户名'));
        // $grid->column('password', __('Password'));
        $grid->column('people', __('法人'));
        $grid->column('address', __('公司地址'));
        // $grid->column('logo', __('营业执照'));
        $grid->column('tel', __('电话'));
        $grid->column('email', __('邮箱'));
        $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(UserModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cname', __('Cname'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('people', __('People'));
        $show->field('address', __('Address'));
        $show->field('logo', __('Logo'));
        $show->field('tel', __('Tel'));
        $show->field('email', __('Email'));
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
        $form = new Form(new UserModel());

        $form->text('cname', __('Cname'));
        $form->text('username', __('Username'));
        $form->password('password', __('Password'));
        $form->text('people', __('People'));
        $form->text('address', __('Address'));
        $form->text('logo', __('Logo'));
        $form->text('tel', __('Tel'));
        $form->email('email', __('Email'));

        return $form;
    }
}
