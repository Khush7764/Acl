<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurpleController extends Controller
{
    public function freshGrid()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);   
    }

    public function threeMonthList()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);
    }

    public function threeMonthEdit()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);
    }

    public function sixtyTwoDaysList()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);
    }

    public function sixtyTwoDaysEdit()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);   
    }

    public function sixMonthList()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);
    }

    public function sixMonthEdit()
    {
        $pageHeader = "Loan Matrix";
        return view('page')->with(['pageheader'=>$pageHeader]);
    }

    public function sendExcelReport()
    {
        
    }

    public function addNewTemplate()
    {
        
    }
}
