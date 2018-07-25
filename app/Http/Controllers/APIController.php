<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo;

class APIController extends Controller
{
    public function changeSwitch(Request $request)
    {        
        $data = explode("-", $request->id);
        $sw = \App\SwitchState::where('allocate', $data[2]);
        $swData = $sw->first();
        if($swData['state']=="0"){
            $swNow = "1";
            $sw->update(['state'=> "1"]);
        }
        else if($swData['state']=="1"){
            $swNow = "0";
            $sw->update(['state'=> "0"]);
        }
        
        return $this->sendStateMqtt($swData['topic'], $swNow);;
    }

    public function changeMultiSwitch(Request $request)
    {
        $data = explode("-", $request->roomid);
        $room = $data[2] - 1;
        if($request->action == "all-on"){
            $swNow = "1";
            if($data[2]>4){
                $swNow = "0";
            }
        }
        else if($request->action == "all-off"){
            $swNow = "0";
            if($data[2]>4){
                $swNow = "1";
            }
        }
        for($i = 1; $i<=5; $i++){
            $topic = \App\SwitchState::where('allocate', ($room*5) + $i)->first()['topic'];
            \App\SwitchState::where('allocate', ($room*5) + $i)->update(['state'=>$swNow]);
            $this->sendStateMqtt($topic, $swNow);
        }
        return "oke";
    }

    public function getSwitch(Request $request)
    {
        $someArray = array();
        foreach(\App\SwitchState::all() as $data){            
            $someArray[] = [
                "id" => 'switch-light-'.$data['allocate'],
                "state" => $this->conditioning($data['allocate'], $data['state'])
            ];
        }
        return json_encode($someArray);
    }

    public function sendStateMqtt($topic, $message)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://178.128.21.58:3000/topic', [
            \GuzzleHttp\RequestOptions::JSON => [
                'topic' => $topic, 
                'message' => $message
            ]
        ]); 
        return $response;
    }

    public function conditioning($id, $state)
    {
        if($id > 16){
            if($state == 0){
                return 1;
            }
            else if ($state == 1){
                return 0;
            }
        }
        else {
            return $state;
        }
    }

    public function changeGarage()
    {
        $stateNow = \App\Topic::where('topic', '/room/4/door')->first();
        if($stateNow['message'] == 1){
            $this->sendStateMqtt('/room/4/door', "0");
            \App\Topic::where('topic', '/room/4/door')->update(['message'=> "0"]);
        }
        else if($stateNow['message'] == 0){
            $this->sendStateMqtt('/room/4/door', "1");
            \App\Topic::where('topic', '/room/4/door')->update(['message'=> "1"]);
        }
        return redirect()->back();
    }

    public function changeTemp(Request $request)
    {
        $temp = $request->temp;
        $this->sendStateMqtt('/room/11/ac/1/temp', "m".$temp);
        return "oke";
    }

    public function endpoint(Request $request)
    {
        Nexmo::message()->send([
            'to'   => env('SMS_ADDRESS', '6285740101829'),
            'from' => 'Vortex-Home',
            'text' => '[Peringatan] Sistem mendeteksi bahwa tombol darurat di Rumah 1 telah ditekan.'
        ]);
        return "oke";
    }
}
