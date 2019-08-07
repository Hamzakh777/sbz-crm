<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity as ActivityModel;
use App\Http\Controllers\Controller;

class UserLogController extends Controller
{
    /**
     * Get the user log
     * 
     * @param id integer
     * @return response
     */
    public function index($id)
    {
        $userLog = ActivityModel::where('subject_id', '=', $id)->orderBy('created_at', 'desc')->paginate(12);

        return response()->json([
            'userLog' => $userLog,
        ]);
    }
}
