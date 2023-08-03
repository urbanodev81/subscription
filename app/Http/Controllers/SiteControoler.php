<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SiteControoler extends Controller
{
    public function index(Plan $plan)  {
        $plans =$plan->with(['features','typePlan'])->get();
        return view('home.index', compact('plans'));
    }

    public function createSessionPlan(Plan $plan, $urlPlan){
        if(!$plan = $plan->where('url', $urlPlan)->first()){
            return redirect()->route('site.home');
        }

        session()->put('plan', $plan);

        return redirect()->route('subscriptions.checkout');

    }
}
