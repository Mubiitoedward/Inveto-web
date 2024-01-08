<?php

namespace App\Admin\Controllers;

use App\Models\StockCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StockCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Categories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockCategory());
        $grid->disableBatchActions();
        $grid->disableExport();
        $grid->quickSearch('name','status');

        $u = Admin::user();
        $grid->model()->where('company_id',$u->company_id);

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __(' Category Name'))->sortable();
        $grid->column('description', __('Description'))->hide();
        $grid->picture('image', __('Image'))->image();
        $grid->column('status', __('Status'))
        ->display(function($status){
            if($status == 'active'){
                return "<span class='label label-success'>Active</span>";
            }else{
                return "<span class='label label-danger'>Inactive</span>";
            }
        })->sortable()
        ;
        $grid->column('buying_price', __('Investment'))
        ->display(function($buying_price){
            return number_format($buying_price,2);
        })
        ->sortable();
        $grid->column('selling_price', __('Expected Sales'))
        ->display(function($selling_price){
            return number_format($selling_price,2);
        })
        ->sortable();
        $grid->column('expected_profit', __('Expected profit'))
            ->display(function($expected_profit){
            return number_format($expected_profit,2);
        })
        ->sortable();
        $grid->column('earned_profit', __('Earned profit'))
        ->display(function($earned_profit){
            return number_format($earned_profit,2);
        })
        ->sortable();
        $grid->column('created_at', __('Created at'))
        ->display(function($created_at){
            return date('d-m-Y',strtotime($created_at));
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
        $show = new Show(StockCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'));
        $show->field('status', __('Status'));
        $show->field('buying_price', __('Buying price'));
        $show->field('selling_price', __('Selling price'));
        $show->field('expected_profit', __('Expected profit'));
        $show->field('earned_profit', __('Earned profit'));
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
        $form = new Form(new StockCategory());

        $u = Admin::user();
        $form->hidden('company_id', __('Company id'))
        ->default($u->company_id);
        $form->text('name', __('Name'))
        ->rules('required|min:3|max:255');
        $form->textarea('description', __('Description'));
        $form->image('image', __('Image'));
        $form->radio('status', __('Status'))
        ->options(['active'=>'Active','inactive'=>'Inactive'])->default('active')
        ->rules('required');
        
        return $form;
    }
}
