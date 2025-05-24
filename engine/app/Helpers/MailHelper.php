<?php

use Illuminate\Http\Request;

class MailHelper {

    public static function sendMail($emailData)
    {
        try {
            $emailData['sender_name'] = config('modules.general_configs.sender_name');
            $emailData['sender_email'] = config('modules.general_configs.sender_email');
            \Mail::send($emailData['template'], $emailData, function ($message) use ($emailData) {
                $message->from($emailData['sender_email'], $emailData['sender_name']);
                $message->to($emailData['to'])->subject($emailData['subject']);
            });
        }catch (Exception $e){}
        return true;
    }

}