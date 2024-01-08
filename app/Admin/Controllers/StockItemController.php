<?php

namespace App\Admin\Controllers;

use App\Models\StockItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Show;

class StockItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Items';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockItem());

        $grid->column('id', __('Id'));
        $grid->column('company_id', __('Company id'));
        $grid->column('created_by_id', __('Created by id'));
        $grid->column('stock_category_id', __('Stock category id'));
        $grid->column('stock_sub_category_id', __('Stock sub category id'));
        $grid->column('financila_period_id', __('Financila period id'));
        $grid->column('name', __('Name'));
        $grid->column('sku', __('Sku'));
        $grid->column('generate_sku', __('Generate sku'));
        $grid->column('update_sku', __('Update sku'));
        $grid->column('barcode', __('Barcode'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'));
        $grid->column('gallery', __('Gallery'));
        $grid->column('buying_price', __('Buying price'));
        $grid->column('selling_price', __('Selling price'));
        $grid->column('orriginal_quantity', __('Orriginal quantity'));
        $grid->column('current_quantity', __('Current quantity'));
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
        $show = new Show(StockItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('created_by_id', __('Created by id'));
        $show->field('stock_category_id', __('Stock category id'));
        $show->field('stock_sub_category_id', __('Stock sub category id'));
        $show->field('financila_period_id', __('Financila period id'));
        $show->field('name', __('Name'));
        $show->field('sku', __('Sku'));
        $show->field('generate_sku', __('Generate sku'));
        $show->field('update_sku', __('Update sku'));
        $show->field('barcode', __('Barcode'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'));
        $show->field('gallery', __('Gallery'));
        $show->field('buying_price', __('Buying price'));
        $show->field('selling_price', __('Selling price'));
        $show->field('orriginal_quantity', __('Orriginal quantity'));
        $show->field('current_quantity', __('Current quantity'));
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
        $form = new Form(new StockItem());
        $u =Admin::user();

        $form->hidden('company_id', __('Company id'))
        ->default($u->company_id)
        ->readonly();
        if($form->isCreating()){
            $form->hidden('created_by_id', __('Created by id'));
        }
        else{
            $form->hidden('created_by_id', __('Created by id'))
            ->default($u->id)
            ->readonly();
        }
        $sub_cat_ajax_url = 'api/stock-sub-categories';
        $sub_cat_ajax_url = $sub_cat_ajax_url. '?company_id='.$u->company_id;
        
        $form->select('stock_category_id', __('Stock Category'))
        ->ajax($sub_cat_ajax_url);

        $form->decimal('stock_sub_category_id', __('Stock sub category id'));
        $form->decimal('financila_period_id', __('Financila period id'));
        $form->text('name', __('Name'));
        $form->text('sku', __('Sku'));

        if($form->isEditing()){
            $form->radio('update_sku', __('Update SKU'))
           ->options(['yes' => 'yes', 'No'=> 'No'])->when ('yes', function (Form $form){
            $form->text('sku', __('ENTER SKU(Batch number'))
            ->required();
        });}
        else{
        $form->radio('generate_sku', __('Generate SKU'))
        ->options(['Manual' => 'Manual', 'Auto'=> 'Auto'])
        ->when('Manual', function (Form $form) {
            $form->text('sku', __('ENTER SKU(Batch number'))
            ->required();
        })
        ->required();
    }
       
        if($form->isCreating()){
            $form->radio('update_sku', __('Update SKU'))
           ->options(['Manual' => 'Manual', 'Auto'=> 'Auto'])->when ('Manual', function (Form $form){
            $form->text('sku', __('ENTER SKU(Batch number'))
            ->required();
        });}
        else{
        $form->radio('generate_sku', __('Generate SKU'))
        ->options(['Manual' => 'Manual', 'Auto'=> 'Auto'])
        ->when('Manual', function (Form $form) {
            $form->text('sku', __('ENTER SKU(Batch number'))
            ->required();
        })
        ->required();
    }
        $form->text('barcode', __('Barcode'));
        
        $form->image('image', __('Image'))
        ->uniqueName();
        $form->multipleImage('gallery', __('Item Gallery'))
        ->uniqueName()
        ->downloadable()
        ->removable();
        $form->decimal('buying_price', __('Buying price'))
        ->required()
        ->default(0);
        $form->decimal('selling_price', __('Selling price'))
        ->required()
        ->default(0);
        $form->decimal('orriginal_quantity', __('Orriginal quantity(in units)'))
        ->required()
        ->default(0);
        $form->decimal('current_quantity', __('Current quantity')
    )
    ->required()
    ->default(0);
        $form->text('description', __('Description'))
        ->required()
        ->default(0);

        return $form;
    }
}
