<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('apikey')) {
            $errors = [];
            array_push($errors, ['code' => 'apikey', 'message' => 'Api key is required!']);
            return response()->json([
                'errors' => $errors
            ], 403);
        }
//         if (!$request->hasHeader('test')) {
//            $errors = [];
//            array_push($errors, ['code' => 'test', 'message' => 'test is required!']);
//            return response()->json([
//                'errors' => $errors
//            ], 403);
//        }
//        if ($request->header('test') != "true" || $request->header('test') != "false") {
//            $errors = [];
//            array_push($errors, ['code' => 'test', 'message' => "test only take two value 'true' or 'false' "]);
//            return response()->json([
//                'errors' => $errors
//            ], 403);
//        }
            $apikey = $request->header('apikey');

            $user = User::where('apikey',$apikey)->first();
            if (!$user){
                return response()->json([
                    'message' => "Invalid Api key"
                ], 403);
            }

        return $next($request);
    }
}
