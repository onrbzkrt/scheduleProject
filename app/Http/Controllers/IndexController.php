<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->format("Y-m-d");
        $data = EventModel::where("startDate",">=",$now)->get();
        $dateRange = [];

        foreach ($data as $datum)
        {
            $checkIt = explode(' ', $datum->startDate)[0];
            if (isset($dateRange[$checkIt]))
            {
                $dateRange[$checkIt] = $dateRange[$checkIt] + 1;
            }
            else
            {
                $dateRange[$checkIt] = 1;
            }
        }


        return view('index', compact("data", "dateRange"));
    }
}
