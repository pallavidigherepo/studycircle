<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\Contact;
use App\Http\Requests\ContactURequest;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactURequest $request)
    {
        /*$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'secret' => config('services.recaptcha.secret'),
                'response' => $request->recaptcha_token
            )
        ));
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        dd($resultJson);
        if(strpos($response, '"success": true') !== FALSE) {
            echo '<h3>Thanks for your message!</h3>';
        } else {
            $response = [
                'success' => false,
                'message' => 'ReCaptcha Error. Please refresh the page again.',
                'captcha' => true,
            ];
        }*/
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = env('APP_URL');//$_SERVER['REMOTE_ADDR'];

        $data = [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $request->recaptcha_token,
                    'remoteip' => $remoteip
                ];
        $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                ]
            ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);        
        $resultJson = json_decode($result);

        if ($resultJson->success != true) {
            $response = [
                'success' => false,
                'message' => 'ReCaptcha Error. Please refresh the page again.',
                'captcha' => true,
            ];
        }
        if (isset($resultJson->score) && $resultJson->score >= 0.3) {
            //Validation was successful, add your form submission logic here
            $inputs = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'heard_from' => $request->heard_from,
                'subject' => $request->subject,
                'message' => $request->message
            ];
            
            $contact = Contact::create($inputs);
            Mail::to('support@meritest.in')->send(new ContactUsMail($contact));
            
            if (!Mail::failures()) {
                $contact->is_sent = 1;
                $contact->update();
            }
            $response = [
                'success' => true,
                'message' => 'You will be contacted soon.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'ReCaptcha Error. Please refresh the page again.',
                'captcha' => true,
            ];
        }
        return response()->json($response);
    }
}
