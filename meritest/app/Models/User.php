<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    

    public static function getApiData() {
        $ch = curl_init();
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',

        );
        curl_setopt($ch, CURLOPT_URL, "https://services.india.gov.in/service/listing?cat_id=1&ln=en");
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);


        //curl_setopt($ch, CURLOPT_URL, "https://services.india.gov.in/service/listing?cat_id=1&ln=en");


        // $output contains the output string
        $response = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);   
        dd($response);
        return $response;
    }
}
