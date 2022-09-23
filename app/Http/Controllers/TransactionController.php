<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionsList()
    {
        $pageHeader = "Transactions List";
        return view('page')->with(['pageheader'=>$pageHeader]);        
    }
}
