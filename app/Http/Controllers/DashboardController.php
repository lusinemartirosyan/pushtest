<?php

namespace App\Http\Controllers;

use App\NotificationModel;
use App\SubscribedUsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function createNotification(Request $request)
    {
        //dd($request->image);
        $time = time();
        $this->validate($request, [
            'file' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'max:60',
            'body' => 'max:225'
        ]);


        if ($request->file) {
            $image = $request->file('file');
            $name = $time .'.'. $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $request->image = $name;

        }
        $notification = new NotificationModel;
        $notification->title = $request->title;
        $notification->link = $request->link;
        $notification->body = $request->body;
        $notification->image = (isset($name) && !empty($name) ? $name : null);
        $notification->save();

        return redirect()->route('all.notifications');

    }

    public function AllNotifications()
    {
        $notifications = NotificationModel::get();

        return view('listing', ['notifications' => $notifications]);
    }
    public function GetNotification()
    {
        $notification = NotificationModel::first();

        return $notification;
    }
    public function SendNotification()
    {
        $id = input::get('id');
        $notification = NotificationModel::where('send', 0)->first();
        $user = SubscribedUsersModel::where('id', 6)->first();
        $key = $user['p256dh'];
        $serveKey = 'AAAAhOJFR70:APA91bHLZD9c9IUqf_jX8eOfczIJ-w4pbrIdrb9tfv9pjbc5ybuGNkvfAWqGmPgnVTfm7Rho4PiRIQpsoWmFSVu7LHIfehvenuiVrCjND6gPhOASJYHfMdDAsSOsmq8xQyVSDI4FHLOk';
        $aryEndpoint = explode("/send/", $user['endpoint']);


        $token = $key;
        $url = 'https://fcm.googleapis.com/fcm/send';

        $notification = array('title' =>$notification['title'] , 'body' => $notification['body']);
        $arrayToSend = array('to' => $token, 'notification' => $notification);

        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key= AAAAhOJFR70:APA91bHLZD9c9IUqf_jX8eOfczIJ-w4pbrIdrb9tfv9pjbc5ybuGNkvfAWqGmPgnVTfm7Rho4PiRIQpsoWmFSVu7LHIfehvenuiVrCjND6gPhOASJYHfMdDAsSOsmq8xQyVSDI4FHLOk';

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $json );

        $result = curl_exec ( $ch );
        curl_close ( $ch );

        DB::table('notifications')
            ->where('id', $id)
            ->update(['send' => 1]);

    }


}
