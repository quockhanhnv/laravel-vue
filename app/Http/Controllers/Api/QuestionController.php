<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\QuestionRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Services\QuestionService;
use App\Services\AnswerService;

class QuestionController extends Controller
{
    private $questionService;

    private $answerService;

    public function __construct(QuestionService $questionService, AnswerService $answerService)
    {
        $this->questionService = $questionService;
        $this->answerService   = $answerService;
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

            $questionPaginate = $this->questionService->getAll($orderBys, $limit);

            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'exams'  => $questionPaginate->items(),
                'meta'   => [
                    'total'       => $questionPaginate->total(),
                    'perPage'     => $questionPaginate->perPage(),
                    'currentPage' => $questionPaginate->currentPage(),
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

    public function store(QuestionRequest $request)
    {
        try {
            DB::beginTransaction();

            $question = $this->questionService->save(['content' => $request->content]);

            foreach ($request->answers as $answer) {
                $answer['question_id'] = $question->id;
                $this->answerService->save($answer);
            }

            DB::commit();

            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
                'question' => $question,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }

    public function update(QuestionRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $question = $this->questionService->findById($id);
            $oldAnswerIds = $question->answers->pluck('id')->toArray();
            $newAnswerIds = [];

            foreach ($request->answers as $item) {
                if (!empty($item['id'])) {
                    array_push($newAnswerIds, $item['id']);
                }
            }

            $answerIdsNeedDelete = array_diff($oldAnswerIds, $newAnswerIds);
            
            $this->answerService->delete($answerIdsNeedDelete);

            $question = $this->questionService->save(['content' => $request->content], $id);

            foreach ($request->answers as $answer) {
                $answer['question_id'] = $id;
                $this->answerService->save($answer, $answer['id'] ?? null);
            }

            $question->answers;

            DB::commit();

            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
                'question' => $question,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

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
            $question = $this->questionService->findById($id);

            if (!$question) {
                return response()->json([
                    'status'   => false,
                    'code'     => Response::HTTP_NOT_FOUND,
                    'message'  => 'Question dose not exists'
                ]);
            }

            $question->answers;

            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
                'question' => $question,
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
            DB::beginTransaction();
            $this->questionService->delete([$id]);
            $this->answerService->deleteByQuestion($id);
            DB::commit();

            return response()->json([
                'status'   => true,
                'code'     => Response::HTTP_OK,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'errors' => [
                    'status'  => false,
                    'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ]
            ]);
        }
    }
}
