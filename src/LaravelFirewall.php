<?php

namespace BlackBits\LaravelFirewall;

use Closure;
use Zttp\Zttp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaravelFirewall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // attempt access
        if ($this->shouldBlockAccess($request)) {
            return response()->view('firewall::firewall-blocked', ['ip' => $request->ip()], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    private function shouldBlockAccess(Request $request)
    {
        // check if firewall is explicitely enabled
        if (! config('firewall.enabled', false)) {
            return false;
        }

        // check blacklist (primary decision)
        if (array_search($request->ip(), config('firewall.blacklist')) !== false) {
            return true;
        }

        // check whitelist (secondary decision)
        if (array_search($request->ip(), config('firewall.whitelist')) !== false) {
            return false;
        }

        // check remote
        $url = config('firewall.remote_url');
        $token = config('firewall.remote_token');

        if (empty($url) || empty($token)) {
            return true;
        } // block access

        $isPermitted = Zttp::get($url, [
            'api_token' => $token,
            'ip'        => $request->ip(),
        ])->json()['status'] ?? false;

        // check if access is permitted
        if ($isPermitted) {
            return false;
        }

        // block access
        return true;
    }
}
