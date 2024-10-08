<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\plan_request;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index()
    {
        if (\Auth::user()->type == 'super admin' || (\Auth::user()->type == 'owner')) {
            if(\Auth::user()->type == 'super admin'){
                $plans = Plan::all();
            }else{
                $plans = Plan::where('status',1)->get();
            }

            return view('plan.index', compact('plans'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if (\Auth::user()->type == 'super admin') {
            $arrDuration = Plan::$arrDuration;

            return view('plan.create', compact('arrDuration'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'price' => 'required',

            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        if (\Auth::user()->type == 'super admin') {
            $payment = Utility::set_payment_settings();
            if (count($payment) > 0 || $request->price <= 0) {

                $validation                   = [];
                $validation['name']           = 'required|unique:plans';
                $validation['price']          = 'required|numeric|min:0';
                $validation['duration']       = 'required';
                $validation['max_user']       = 'required|numeric';
                $validation['max_account']    = 'required|numeric';
                $validation['max_contact']    = 'required|numeric';
                $validation['storage_limit']  = 'required|numeric';
                $validation['enable_chatgpt'] = 'required|string';

                $post = $request->all();

                if($request->trial == 1)
                {
                    $post['trial_days'] = !empty($request->trial_days) ? $request->trial_days : 0;
                }
                $post['status'] = 1;

                if (Plan::create($post)) {
                    return redirect()->back()->with('success', __('Plan Successfully created.'));
                } else {
                    return redirect()->back()->with('error', __('Something is wrong.'));
                }
            } else {
                return redirect()->back()->with('error', __('Please set payment api key & secret key for add new plan.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function edit($plan_id)
    {
        if (\Auth::user()->type == 'super admin') {
            $arrDuration = Plan::$arrDuration;
            $plan        = Plan::find($plan_id);
            return view('plan.edit', compact('plan', 'arrDuration'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, $plan_id)
    {
        if (\Auth::user()->type == 'super admin') {
            $plan = Plan::find($plan_id);
            $payment = Utility::set_payment_settings();
            if (count($payment) > 0 || $request->price <= 0) {


                if (!empty($plan)) {
                    $validation                = [];
                    $validation['name']        = 'required|unique:plans,name,' . $plan_id;
                    $validation['duration']    = 'required';
                    $validation['max_user']    = 'required|numeric';
                    $validation['max_account'] = 'required|numeric';
                    $validation['max_contact'] = 'required|numeric';
                    $validation['storage_limit']  = 'required|numeric';
                    $validation['enable_chatgpt'] = 'required|string';

                    $post = $request->all();
                    $post['enable_chatgpt'] = ($request->enable_chatgpt == 'on') ? 'on' : 'off';

                    $post['trial'] = !empty($request->trial) ? $request->trial : 0;

                    if($request->trial == 1){

                        $post['trial_days'] = !empty($request->trial_days) ? $request->trial_days : 0;
                    }
                    if ($plan->update($post)) {
                        return redirect()->back()->with('success', __('Plan successfully updated.'));
                    } else {
                        return redirect()->back()->with('error', __('Something is wrong.'));
                    }
                } else {
                    return redirect()->back()->with('error', __('Plan not found.'));
                }
            } else {
                return redirect()->back()->with('error', __('Please set payment api key & secret key for add new plan.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function destroy(Request $request, $id)
    {
        $userPlan = User::where('plan' , $id)->first();
        if($userPlan != null)
        {
            return redirect()->back()->with('error',__('The company has subscribed to this plan, so it cannot be deleted.'));
        }
        $plan = Plan::find($id);
        if($plan->id == $id)
        {
            $plan->delete();

            return redirect()->back()->with('success' , __('Plan deleted successfully'));
        }
        else
        {
            return redirect()->back()->with('error',__('Something went wrong'));
        }
    }

    public function userPlan(Request $request)
    {
        $objUser = \Auth::user();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->code);
        $plan    = Plan::find($planID);
        if ($plan) {
            if ($plan->price <= 0) {
                $objUser->assignPlan($plan->id);

                return redirect()->route('plans.index')->with('success', __('Plan successfully activated.'));
            } else {
                return redirect()->back()->with('error', __('Something is wrong.'));
            }
        } else {
            return redirect()->back()->with('error', __('Plan not found.'));
        }
    }

    public function getpaymentgatway($code)
    {

        $plan_id = \Illuminate\Support\Facades\Crypt::decrypt($code);
        $plan    = Plan::find($plan_id);
        $planReqs = plan_request::where('user_id',\Auth::user()->id)->where('plan_id',$plan_id)->first();
        if ($plan) {
            $admin_payment_setting = Utility::payment_settings();
            return view('plan/payments', compact('plan', 'admin_payment_setting','planReqs'));
        } else {
            return redirect()->back()->with('error', __('Plan is deleted.'));
        }
    }

    public function PlanTrial($id)
    {
        if(\Auth::user()->type != 'super admin')
        {
            try {
                $id       = \Crypt::decrypt($id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Plan Not Found.'));
            }
            $plan = Plan::find($id);
            $user = User::where('id', \Auth::user()->id)->first();

            if(!empty($plan->trial) == 1){

                $user->assignPlan($plan->id,'Trial',$user->id);
                $user->is_trial_done = 1;
                $user->save();
            }

            return redirect()->back()->with('success', 'Your trial has been started.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function updateStatus(Request $request)
    {
        $userPlan = User::where('plan' , $request->id)->first();
        if($userPlan != null)
        {
            return response()->json(['message' => __('The company has subscribed to this plan, so it cannot be disabled.')]);
        }
        $planId = $request->input('plan_id');

        $plan = Plan::find($planId);

        $plan->status = !$plan->status;
        $plan->save();

        if ($plan->status == true) {
            return response()->json(['message' => __('Plan successfully unable.')]);

        } else {
            return response()->json(['message' => __('Plan successfully disable.')]);
        }
    }


}
