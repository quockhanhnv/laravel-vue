<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamService;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    private $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function index(Request $request)
    {
        try {
            $limit = $request->get('limit') ?? config('app.paginate.per_page');
            $orderBys = [];

            if ($request->get('column') && $request->get('sort')) {
                $orderBys['column'] = $request->get('column');
                $orderBys['sort']   =  $request->get('sort');
            }

            $examPaginate = $this->examService->getAll($orderBys, $limit);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exams'  => $examPaginate->items(),
                'meta'   => [
                    'total'       => $examPaginate->total(),
                    'perPage'     => $examPaginate->perPage(),
                    'currentPage' => $examPaginate->currentPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $exam = $this->examService->save(['name' => $request->name]);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exam'   => $exam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $exam = $this->examService->save(['name' => $request->name], $id);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exam'   => $exam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        try {
            $exam = $this->examService->findById($id);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exam'   => $exam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->examService->delete([$id]);
            
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
