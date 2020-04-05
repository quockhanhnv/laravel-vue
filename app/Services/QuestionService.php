<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
	/**
     * param array $data
     * $data key: content
     * int $id | null
     */
    public function save(array $data, int $id = null)
    {
        return Question::updateOrCreate(           
            [
                'id' => $id
            ],
            [
                'content' => $data['content']
            ]
        );
    }

    public function getAll($orderBys = [], $limit = 10)
    {
        $query = Question::query();

        if ($orderBys) {
            $query->orderBy($orderBys['column'], $orderBys['sort']);
        }

        return $query->paginate($limit);
    }

    public function findById(int $id)
    {
        return Question::find($id);
    }

    public function delete($ids = [])
    {
        return Question::destroy($ids);
    }
}