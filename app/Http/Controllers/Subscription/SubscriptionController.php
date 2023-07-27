<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {


        if (auth()->user()->subscribed('default')) {
            return redirect()->route('subscriptions.premium');
        }

        return view('subscription.index', [
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }

    public function store(Request $request) {
        $request->user()
            ->newSubscription('default','price_1NWQLPKZZFedVuOFdZqORN3C')
            ->create($request->token);

            return redirect()->route('subscriptions.premium');

    }

    public function premium() {

        if (!auth()->user()->subscribed('default')) {
            return redirect()->route('subscriptions.checkout');
        }

        return view('subscription.premium');

    }

    public function account() {

        $invoices = auth()->user()->invoices();
        return view('subscription.account',compact('invoices'));
    }

    public function invoiceDownload($invoiceId){

        return Auth::user()->downloadInvoice($invoiceId, [
            'vendor' => config('app.name'),
            'product' => 'assinatura vip'
        ]);
    }

    public function cancel(){

        auth()->user()->subscription('default')->cancel();
        return redirect()->route('subscriptions.account');
    }

    public function resume(){

        auth()->user()->subscription('default')->resume();
        return redirect()->route('subscriptions.account');
    }
}
