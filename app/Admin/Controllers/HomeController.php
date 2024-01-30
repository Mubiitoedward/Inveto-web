<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content



        ->title('Dashboard')
        ->description('Welcome to the dashboard')
        ->header('Waka Gas')
        ->row(function (Row $row) {

            $row->column(4, function (Column $column) {
                $box = new Box('Users Details', 'Info');
                $box->removable();
                $box->collapsable();
                 $box->style('success');
                $box->solid();
               
                $column->append($box);

                $infoBox = new InfoBox('Companies', 'Companies', 'aqua', '/companies', '40');
                $infoBox->removable();
                $infoBox->collapsable();
                $infoBox->style('warning');
                $infoBox->solid();
               
                $column->append($infoBox);


                $infoBox = new InfoBox('Stock Categories', 'stock-categories', 'aqua', '/stock-categories', '50');
                $infoBox->removable();
                $infoBox->collapsable();
                $infoBox->style('primary');
                $infoBox->solid();
               
                $column->append($infoBox);

            });



            $row->column(4, function (Column $column) {
               

                $form = new Form();

                $form->action('example');

                $form->email('email')->default('qwe@aweq.com');
                $form->password('password');
                $form->text('name');
                $form->url('url');
                $form->color('color');
                $form->map('lat', 'lng');
                $form->date('date');
                $box = new Box('Users Task', $form);
                $box->style('primary');
                $box->solid();
                $column->append($box);

            });

            $row->column(4, function (Column $column) {
               
                

                $form = new Form();

                $form->action('example');

                $form->email('email')->default('qwe@aweq.com');
                $form->password('password');
                $form->text('name');
                $form->url('url');
                $form->color('color');
                $form->map('lat', 'lng');
                $form->date('date');
                $box = new Box('Users Task', $form);
                $box->style('primary');
                $box->solid();
                $column->append($box);

            });








        // return $content
        //     ->title('Dashboard')
        //     ->description('Description...')
        //     ->row(Dashboard::title())
        //     ->row(function (Row $row) {

        //         $row->column(4, function (Column $column) {
        //             $column->append(Dashboard::environment());
        //         });

        //         $row->column(4, function (Column $column) {
        //             $column->append(Dashboard::extensions());
        //         });

        //         $row->column(4, function (Column $column) {
        //             $column->append(Dashboard::dependencies());
        //         });
             });
    }
}
