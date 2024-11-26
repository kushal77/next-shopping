<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Mail;

class ContactController extends Controller
{

    public function postContact()
    {
        try {
            $data = request()->all();

            Mail::send('email_template.contactemail', ['data' => $data],
                function ($m) use ($data) {
                    $m->from($data['email']);
                    $m->to('maharjan.aakriti26@gmail.com')->subject('Contact Email');
                }
            );

            if ('success') {
                return jsonize([], true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

}
