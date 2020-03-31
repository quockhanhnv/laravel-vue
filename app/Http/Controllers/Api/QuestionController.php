<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\QuestionRequest;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function store(QuestionRequest $request)
    {
    	return response()->json([
            'status' => true,
            'code'   => Response::HTTP_OK,
            'message' => 'Successfully!!!'
        ]);
    }
}
