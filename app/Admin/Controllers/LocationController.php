<?php

namespace App\Admin\Controllers;

use App\Location;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LocationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Locations';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Location);

        $grid->column('location_name', __('Location Name'));
        $grid->column('pin_code', __('Pin Code'));

        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Location);
        
        $form->text('location_name', __('Location Name'))->rules(function ($form) {
            return 'required';
        });
        $form->text('pin_code', __('Pin Code'))->rules(function ($form) {
            return 'required';
        });
       
        $form->tools(function (Form\Tools $tools) {
           $tools->disableDelete(); 
           $tools->disableView();
       });
       $form->footer(function ($footer) {
           $footer->disableViewCheck();
           $footer->disableEditingCheck();
           $footer->disableCreatingCheck();
       });
        return $form;
    }
}
