<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerLog;
use App\Field;
use App\ProfileWidget;
use App\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    public function __construct(){

    }

    public function index(){
        $customers = Customer::get();
        $logs = CustomerLog::get();
        return view('home',compact('customers', 'logs'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();

        return redirect()->route('customer.index');
    }

    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view('edit', compact('customer'));
    }

    public function update($id, Request $request) {
        $customer = Customer::findOrFail($id);
        $customer->fill($request->all());
        $customer->update();

        return redirect()->route('customer.index');
    }

    public function destroy($id) {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index');
    }
}
