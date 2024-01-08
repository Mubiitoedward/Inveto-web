<?php

namespace App\Admin\Controllers;

use App\Models\StockSubCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Show;
use App\Models\StockCategory;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Encore\Admin\Grid\Displayers\Editable;

class StockSubCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'StockSubCategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockSubCategory());

        $u = Admin::user();
        $grid->model()->where('company_id',$u->company_id)
        ->orderBy('id','desc');




        $grid->disableBatchActions();

        $grid->column('id', __('Id'))
        ->sortable();

        $grid->column('image', __('Image'))
        ->lightbox(['width' => 50, 'height' => 50,
        'zooming' => true,
        'fullscreen' => true,
        'download' => true,
        'class' => 'img-responsive img-rounded',
        
    ]);

        $grid->column('name', __('Name'))
        ->sortable();
        $grid->column('stock_category_id', __('Stock category id'))
        ->display(function($stock_category_id){
            $category = StockCategory::find($stock_category_id);
            return $category->name;
            if($category == null){
                return 'N/A';
                 return $category->name;
        }})
        ->sortable();
     
        $grid->column('status', __('Status'))
        ->display(function($status){
            if($status == 'active'){
                return "<span class='label label-success'>Active</span>";
            }else{
                return "<span class='label label-danger'>Inactive</span>";
            }
        });
        $grid->column('current_quantity', __('Current quantity'))
        ->display(function($current_quantity){
            return number_format($current_quantity,2). ' ' .$this->measurement_unit;
        })
        ->sortable();
        $grid->column('reorder_level', __('Reorder level'))
        ->display(function($reorder_level){
            return number_format($reorder_level,2). ' ' .$this->measurement_unit;
        })
        ->editable()
        ->sortable();
        $grid->column('buying_price', __('Investment'))
        ->sortable();
        $grid->column('selling_price', __('Expected Sales'))
        ->sortable();
        $grid->column('expected_profit', __('Expected profit'))
        ->sortable();
        $grid->column('earned_profit', __('Earned profit'))
        ->sortable();
        $grid->column('description', __('Description'))
        ->sortable()
        ->hide();
        $grid->column('created_at', __('Created at'))
        ->sortable()
        ->hide();
       

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
        $show = new Show(StockSubCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('stock_category_id', __('Stock category id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'));
        $show->field('measurement_unit', __('Measurement unit'));
        $show->field('status', __('Status'));
        $show->field('current_quantity', __('Current quantity'));
        $show->field('reorder_level', __('Reorder level'));
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
        $form = new Form(new StockSubCategory());
        $u = Admin::user();
        $form->hidden('company_id', __('Company id'))
        ->default($u->company_id);

$categories = StockCategory::where(['company_id'=>$u->company_id,
'status'=>'active'])->get();

        $form->select('stock_category_id', __('Stock category '))
        ->options($categories->pluck('name','id'))
        ->rules('required');
        $form->text('name', __('Sub Category Name'))
        ->rules('required|min:3|max:255');
        $form->text('description', __('Description'));
        $form->image('image', __('Image'));
        $form->text('measurement_unit', __('Measurement unit'))
        ->rules('required');
        
        $form->decimal('reorder_level', __('Reorder level'));
        $form->radio('status', __('Status'))
        ->Options(['active'=>'Active','inactive'=>'Inactive'])
        ->default('active');
       

        return $form;
    }
}
