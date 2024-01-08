<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('password', __('Password'));
        $grid->column('name', __('Name'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('company_id', __('Company id'));
        $grid->column('First_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('status', __('Status'));
        $grid->column('phone', __('Phone'));
        $grid->column('address', __('Address'));
        $grid->column('about', __('About'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('avatar', __('Avatar'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('company_id', __('Company id'));
        $show->field('First_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('status', __('Status'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('about', __('About'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $u =Admin::user();
        $form->hidden('company_id')->value($u->company_id)
        ->readonly()
        ->default($u->company_id);

        $form->divider('personal information');

        $form->text('First_name', __('First name'))
        ->rules('required|max:255');
        $form->text('last_name', __('Last name'))
        ->rules('required|max:255');
        $form->mobile('phone', __('Phone'))
        ->rules('required|max:255');
        $form->text('address', __('Address'))
        ->rules('required|max:255');
        
     
        $form->divider('Account information');
        $form->radio('status', __('Status'))
        ->options(['Active' => 'Active', 'Inactive'=> 'Inactive'])
        ->default('Active');
        $form->image('avatar', __('Avatar'));
        $form->text('email', __('Username'));
        $form->password('password', __('Password'));
        $form->text('about', __('About'));

        return $form;
    }
}
