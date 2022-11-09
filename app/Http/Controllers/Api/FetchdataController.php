<?php

namespace App\Http\Controllers\Api;

use App\Models\data;

class FetchdataController
{
    public function listdata()
    {

        $data = data::where(['network', 'like', '%data%'])->get();

        return response()->json([
            'success'=>0,
            'message' => "electricity fetch successfuly", 'data' => $data
        ], 200);

    }
}
