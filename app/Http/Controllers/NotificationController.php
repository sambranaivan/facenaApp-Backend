<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
class NotificationController extends Controller
{
    //
    /**
     * user_id del usuario
     * from, id de la ultima consulta para no traer todo cada vez
     */
    public function getNotifications(Request $request)
    {
        $data = json_decode($request->getContent());
        $user_id = $data->user_id;

        $n = Notification::where('user_id',$user_id)->where('status',true)->get();

         return response()->json($n);
    }

    public function deleteNotification(Request $request)
    {
        $data = json_decode($request->getContent());
        $n = Notification::find($data->id);
        if($n)
        {
        $n->status = false;
        $n->save();
        return "borrado";
        }
        return 'no existe';
    }
}
