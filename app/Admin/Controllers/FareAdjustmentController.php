<?php

namespace App\Admin\Controllers;

use App\FareAdjustment;
use App\Order;
use App\Customer;
use App\AppSetting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\DB;

class FareAdjustmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fare Adjustments';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FareAdjustment);

        $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order Id'));
        $grid->column('additional_fare', __('Additional Fare'));
       
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->filter(function ($filter) {
            //Get All status
            
            
            $filter->like('additinal_fare', 'Additinal Fare');
            
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
        $show = new Show(FareAdjustment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order Id'));
        $show->field('additional_fare', __('Additional Fare'));
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
        $form = new Form(new FareAdjustment);
        
        $orders = Order::pluck('order_id', 'id');
        $form->select('order_id', __('Order Id'))->options($orders)->default(1)->rules(function ($form) {
            return 'required';
        });
        $form->text('additional_fare', __('Additional Fare'))->rules(function ($form) {
            return 'required';
        });
         $form->saved(function (Form $form) {
            $this->update_fare($form->model()->order_id,$form->model()->additional_fare);
           
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
    
    public function update_fare($id,$additional_fare){
        
            $total = Order::where('id',$id)->value('total');
            $new_total = $additional_fare+$total;
            Order::where('id',$id)->update(['total' => $new_total,'additional_fare' =>$additional_fare]); 
            $customer_id = Order::where('id',$id)->value('customer_id');
            $customer = Customer::where('id',$customer_id)->first();
            $stripe = new Stripe();
            $charge = $stripe->charges()->create([
                'customer' => $customer->stripe_token,
                'currency' => AppSetting::where('id',1)->value('default_currency'),
                'amount'   => $additional_fare,
            ]);
            //echo($charge);exit;
            
    }

}
