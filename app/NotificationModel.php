<?php
namespace App;

use App\Http\Controllers\Functions;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['title', 'body', 'image'];

}
