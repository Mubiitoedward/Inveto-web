<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Models\User;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;


class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Company';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());
        $grid->disableBatchActions();
        $grid->quickSearch('name');

        $grid->column('id', __('Id')) ->hide();
        $grid->column('owner_id', __('Owner'))
        ->display(function ($owner_id) {
            $user = User::find($owner_id);
            if ($user == null) {
                return "Not Found";
            }
            return $user->name;
        });
        $grid->column('name', __('Name'))
        ->hide();
       
        $grid->column('email', __('Email'));
        $grid->column('logo', __('Logo'))
        ->hide();
        $grid->column('website', __('Website'))
        ->hide();
        $grid->column('phone', __('Phone'))
        ->hide();
        $grid->column('address', __('Address'))
        ->hide();
        $grid->column('about', __('About'))
        ->hide();
        $grid->column('facebook', __('Facebook'))
        ->hide();
        $grid->column('twitter', __('Twitter'))
        ->hide();
        $grid->column('pobox', __('Pobox'))
        ->hide();
        $grid->column('color', __('Color'));
        $grid->column('slogan', __('Slogan'))  ->hide();
        $grid->column('created_at', __('Registered'))
        ->display(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        })->hide();
        $grid->column('updated_at', __('Updated at'))
        ->display(function ($updated_at) {
            return date('d-m-Y', strtotime($updated_at));
        });

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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('owner_id', __('Owner id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('logo', __('Logo'));
        $show->field('website', __('Website'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('about', __('About'));
        $show->field('facebook', __('Facebook'));
        $show->field('twitter', __('Twitter'));
        $show->field('pobox', __('Pobox'));
        $show->field('color', __('Color'));
        $show->field('slogan', __('Slogan'));
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

        /**
     *  $admin_role_users = DB::table('admin_role_users')->where('role_id', 2)->get();
       * $admin_role_users_array = [];
       * foreach ($admin_role_users as $admin_role_user) {
        *    $admin_role_users_array[$admin_role_user->user_id] = $admin_role_user->user_id;
       * }
     *
     *
     */
        $admin_role_users = DB::table('admin_role_users')->where('role_id', 2)->get();
        $company_admins = [];
        foreach ($admin_role_users as $key => $value) {
            $user = User::find($value->user_id);
            if ($user == null) {
                continue; 
            }
            $company_admins[$user->id] = $user->name;
        }
        #dd($company_admins);


        $form = new Form(new Company());

        $form->select('owner_id', __('Company Owner'))->options($company_admins);
        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->text('logo', __('Logo'));
        $form->url('website', __('Website'));
        $form->mobile('phone', __('Phone'));
        $form->text('address', __('Address'));
        $form->text('about', __('About'));
        $form->url('facebook', __('Facebook'));
        $form->url('twitter', __('Twitter'));
        $form->text('pobox', __('Pobox'));
        $form->color('color', __('Color'));
        $form->text('slogan', __('Slogan'));

        return $form;
    }
}
