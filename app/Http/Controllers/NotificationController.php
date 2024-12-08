<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NotificationModel;

class NotificationController extends Controller
{
    public function index_notification()
    {
        return view('notifications.list');
    }
    public function notification_index(Request $request)
    {
        $data['getRecord'] = User::get();
        return view('admin.notification.update', $data);
    }

    public function notification_send(Request $request)
    {
        // dd($request->all());

        $saveDb = new NotificationModel;
        $saveDb->user_id = trim($request->user_id);
        $saveDb->title = trim($request->title);
        $saveDb->message = trim($request->message);
        $saveDb->save();

        $user = User::where('id', '=', $request->user_id)->first();
        if (!empty($user->token)) {

        }
        try {
            $accessToken = getenv('GOOGLE_APPLICATION_CREDENTIALS');

            $token = $user->token;
            $body['title'] = $request->title;
            $body['message'] = $request->message;
            $body['body'] = $request->message;

            $url = "POST https://fcm.googleapis.com/v1/projects/pembo-realestate/messages:send";

            $notification = array('title' => $request->title, 'body' => $request->message);

            $arrayToSend = array('to' => $token, 'data' => $body, 'priority' => "high");

            $json1 = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer=' . $accessToken;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            curl_close($ch);

        } catch (Exception $e) {
            echo $e;
        }
        return redirect('admin/notification')->with('success', "Notification Successfully Sent!");

    }
}
