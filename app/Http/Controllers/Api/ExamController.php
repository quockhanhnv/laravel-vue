<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ExamRequest;
use App\Services\ExamService;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    private $examService;

    private $questionService;

    public function __construct(ExamService $examService, QuestionService $questionService)
    {
        $this->examService = $examService;
        $this->questionService = $questionService;
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
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    public function store(ExamRequest $request)
    {
        try {
            $exam = $this->examService->save(['name' => $request->name]);

            $this->examService->attachQuestion($request->questions, $exam->id);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exam'   => $exam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    public function update(ExamRequest $request, $id)
    {
        try {
            $exam = $this->examService->save(['name' => $request->name], $id);
            $examClone = clone($exam);

            $questionIdNeedDelete = $this->getIgnoreQuestionId($examClone->questions, $request->questions);

            $this->questionService->delete($questionIdNeedDelete);

            $this->examService->attachQuestion($request->questions, $id);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exam'   => $exam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    public function show($id)
    {
        try {
            $exam = $this->examService->findById($id);
            $exam->questions;

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exam'   => $exam,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
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
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    private function getIgnoreQuestionId($oldQuestions, $newQuestions)
    {
        $oldQuestionIds =  $oldQuestions->pluck('pivot')->pluck('question_id')->toArray();
        $newQuestionIds = [];

        foreach ($newQuestions as $question) {
            array_push($newQuestionIds, $question['question_id']);
        }

        return array_diff($oldQuestionIds, $newQuestionIds);
    }
}
