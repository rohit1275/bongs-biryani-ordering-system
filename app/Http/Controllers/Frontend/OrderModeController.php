<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderModeController extends Controller
{
    public function index(Request $request)
    {
        $tableNo = $request->query('table');
        
        return view('pages.order-mode', compact('tableNo'));
    }

    public function select(Request $request)
    {
        $request->validate([
            'order_type' => 'required|in:delivery,takeaway,dine_in',
            'table_no' => 'nullable|string'
        ]);

        session(['order_type' => $request->order_type]);
        
        if ($request->table_no) {
            session(['table_no' => $request->table_no]);
        } else {
            session()->forget('table_no');
        }

        if ($request->order_type === 'delivery') {
            return redirect()->route('home');
        }

        return redirect()->route('menu');
    }
}
