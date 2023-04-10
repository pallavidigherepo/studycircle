<?php

namespace App\Http\Middleware;

use App\Models\ClientProject;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;    //to get configuration data

class DatabaseSwitcher
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next):Response
    {

        if (!$request->server('HTTP_PROJECT')) {
            return $next($request);
        }
        //check if user logged in
        if ( !$this->auth->guest() )
        {
            //get user's database
            $user_db = $request->server('HTTP_PROJECT');
            if (preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $user_db)) {
                abort(404);
            }
            $clientInfo = ClientProject::where('client_name', $user_db)->first();

            if ($clientInfo) {
                $connectionName = 'mysql';
                //$connectionName = $clientInfo->client_name;

                $config = Config::get('database.connections.' . $connectionName);

                $config = [
                    'driver' => 'mysql',
                    'host' => $clientInfo->host,
                    'port' => $clientInfo->port,
                    'database' => $clientInfo->database,
                    'username' => $clientInfo->username,
                    'password' => $clientInfo->password
                ];
                config()->set('database.connections.' . $connectionName, $config);
                \DB::purge($connectionName);
            }
        }
        return $next($request);
    }
}
