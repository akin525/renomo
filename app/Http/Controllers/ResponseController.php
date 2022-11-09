<?php

namespace App\Http\Controllers;

use App\Models\web;

class ResponseController extends Controller
{
function responsefunding()
{
    $vertual=web::latest()->get();
$gp=json_decode(file_get_contents("php://input"), true);
return $gp;
        return view('admin/response', compact('vertual'));
}
}
