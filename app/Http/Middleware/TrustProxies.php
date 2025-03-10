<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers;

    /**
     * Create a new middleware instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Set the correct header constant for detecting proxies
        $this->headers = Request::HEADER_X_FORWARDED_FOR;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // Perform any necessary logic here (if needed)

        return parent::handle($request, $next);
    }
}
