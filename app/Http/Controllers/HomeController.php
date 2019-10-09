<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerLog;
use App\CustomerLogSelect;
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
        $logs = CustomerLog::orderBy('operation_date', 'desc')->get();

        //guardando el log de seleccion
        $select = new CustomerLogSelect();
        $select->registros = count($customers);
        $select->operation_date = date('Y-m-d H:i:s');
        $select->ip_address = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $select->host = $_SERVER['REMOTE_ADDR'];
        $select->save();

        $selects = CustomerLogSelect::orderBy('operation_date', 'desc')->get();

        return view('home',compact('customers', 'logs', 'selects'));
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

    public function logtxt() {
        $logs = CustomerLog::where('operation', '=', 'UPDATE')->whereRaw("last_document<>new_document")->get();

        $content = 'Contenido cifrado (Base 64)' . PHP_EOL . base64_encode('Fecha,Hora,Documento Anterior,Nuevo Documento, Usuario'). PHP_EOL;
        foreach ($logs as $log) {
            $content .= base64_encode(date('Y-m-d', strtotime($log->operation_date)) .
                ',' . date('H:i:s', strtotime($log->operation_date)) .
                ',' . $log->last_document .
                ',' . $log->new_document .
                ',gearsis_gestion') . PHP_EOL. PHP_EOL. PHP_EOL;
        }
        $content .= 'Contenido descifrado' . PHP_EOL . 'Fecha,Hora,Documento Anterior,Nuevo Documento, Usuario'. PHP_EOL;
        foreach ($logs as $log) {
            $content .= date('Y-m-d', strtotime($log->operation_date)) .
                ',' . date('H:i:s', strtotime($log->operation_date)) .
                ',' . $log->last_document .
                ',' . $log->new_document .
                ',gearsis_gestion' . PHP_EOL;
        }

        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', 'Log cambios en documento.txt')
        ];
        return \Response::make($content, 200, $headers);
    }
}
