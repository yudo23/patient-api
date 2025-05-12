<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\AccessKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessKeyMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessKey = $request->header("Access-Key");

        if (!$accessKey || !AccessKey::where("token", $accessKey)->exists()) {
            return ResponseHelper::apiResponse(false,"Invalid access key",null,null,401);
        }

        return $next($request);
    }
}
