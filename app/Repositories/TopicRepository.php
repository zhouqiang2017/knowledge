<?php

namespace app\Repositories;
use App\Topic;
use Illuminate\Http\Request;

/**
 * Class TopicRepository
 *
 * @package \app\Repositories
 */
class TopicRepository
{
    public function getTopicsForTagging(Request $request)
    {
        return Topic::select(['id', 'name'])
            ->where('name', 'like', '%' . $request->query('q') . '%')
            ->get();
    }
}
