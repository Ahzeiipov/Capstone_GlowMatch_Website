<?php

namespace App\Http\Controllers;


use App\Models\Product;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $product = Product::count();


        $date_awal = date('Y-m-01');
        $date_akhir = date('Y-m-d');

        $data_date = array();
        $data_income = array();

        while (strtotime($date_awal) <= strtotime($date_akhir)) {
            $data_date[] = (int) substr($date_awal, 8, 2);

            $date_awal = date('Y-m-d', strtotime("+1 day", strtotime($date_awal)));
        }

        $date_awal = date('Y-m-01');

        if (auth()->user()->level === 1) {
            return view('admin.dashboard', compact( 'product',));
        } 
        
    }
}
