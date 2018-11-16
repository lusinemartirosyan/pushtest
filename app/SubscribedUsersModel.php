<?php

namespace App;

use App\Http\Controllers\Functions;
use Illuminate\Database\Eloquent\Model;

class SubscribedUsersModel extends Model
{
    protected $table = 'subscribed_users';
    public $timestamps = false;


}
