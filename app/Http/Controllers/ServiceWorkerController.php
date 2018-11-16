<?php

namespace App\Http\Controllers;

use App\SubscribedUsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class ServiceWorkerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = SubscribedUsersModel::get();

        echo '<pre>';
        print_r($notifications);
        echo '</pre>';

    }

   public function SaveSubscription()
   {
           $data = Input::get('data');
           $aryData = json_decode($data, true);

           $newUser = new SubscribedUsersModel;
           $newUser['endpoint'] = $aryData['endpoint'];
           $newUser['p256dh'] = $aryData['keys']['p256dh'];
           $newUser['auth'] = $aryData['keys']['auth'];

            $user = SubscribedUsersModel::where('endpoint', '=', $aryData['endpoint'])->first();
            if(empty($user))
            {
                $newUser->save();
            }



       return 'success';

   }
}
