<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
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

    public function addEvent(Request $request)
    {
        $validated = $request->validate([
            'startDate' => 'required',
            'eventName' => 'required|max:255',
            'mail' => 'required|max:75',
            'phone' => 'required|max:15',
            'fullName' => 'required|max:100',
        ]);

        $startDate = $request->startDate;
        $allDate = explode("T",$startDate);
        $startDate = $allDate[0];
        if (!isset($allDate[1]))
        {
            $data = [
                "error"   =>  1,
                "msg"     =>  "You can't select the whole day.",
            ];
            return response($data);
        }
        $startHour = explode("-", $allDate[1])[0];

        $startDateTime = $startDate . ' ' . $startHour;

        $endDateTime = Carbon::parse($startDateTime)->addMinutes(30);

        $checkIt = EventModel::where("startDate", $startDateTime)->first();

        if (isset($checkIt) && $checkIt != null && !empty($checkIt))
        {
            $data = [
              "error"   =>  1,
              "msg"     =>  "You cannot make this reservation. It is no longer available.",
            ];
            return response($data);
        }

        $event = new EventModel();

        $event->fullName = $request->fullName;
        $event->eventName = $request->eventName;
        $event->mail = $request->mail;
        $event->phone = $request->phone;
        $event->description = isset($request->description) && $request->description != '' ? $request->description : null;
        $event->startDate = $startDateTime;
        $event->endDate = $endDateTime;

        $event->save();

        $data = [
          "title"   =>  $request->eventName,
          "start"   =>  $startDateTime,
          "end"   =>  $endDateTime->toDateTimeString(),
        ];

        $data = json_encode($data);

        return response($data);
    }

    function getSpecialEvent(Request $request)
    {
        $eventCount = EventModel::where('startDate', 'like', '%'.$request->date.'%')->count();

        return response($eventCount);
    }
}
