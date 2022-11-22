<?php

namespace App\Http\Controllers\Api;

use App\Models\data;

class FetchdataController
{
    public function listdata()
    {

        $data = data::all();

        return response()->json([
            'success'=>1,
            'message' => "Data fetch successfully", 'data' => $data
        ], 200);

    }
}
