<?php

namespace App\Modules\Management\PollManagement\Poll\Controller;
use App\Modules\Management\PollManagement\Poll\Actions\GetAllData;
use App\Modules\Management\PollManagement\Poll\Actions\DestroyData;
use App\Modules\Management\PollManagement\Poll\Actions\GetSingleData;
use App\Modules\Management\PollManagement\Poll\Actions\StoreData;
use App\Modules\Management\PollManagement\Poll\Actions\UpdateData;
use App\Modules\Management\PollManagement\Poll\Actions\UpdateStatus;
use App\Modules\Management\PollManagement\Poll\Actions\SoftDelete;
use App\Modules\Management\PollManagement\Poll\Actions\RestoreData;
use App\Modules\Management\PollManagement\Poll\Actions\ImportData;
use App\Modules\Management\PollManagement\Poll\Validations\BulkActionsValidation;
use App\Modules\Management\PollManagement\Poll\Validations\DataStoreValidation;
use App\Modules\Management\PollManagement\Poll\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index()
    {

        $data = GetAllData::execute();
        return $data;
    }

    public function store(DataStoreValidation $request)
    {
        $data = StoreData::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = GetSingleData::execute($slug);
        return $data;
    }

    public function update(DataStoreValidation $request, $slug)
    {
        $data = UpdateData::execute($request, $slug);
        return $data;
    }
    public function updateStatus()
    {
        $data = UpdateStatus::execute();
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = DestroyData::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = RestoreData::execute();
        return $data;
    }
    public function import()
    {
        $data = ImportData::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

    public function checkVote($id)
    {
        $sessionId = request('session_id');
        $hasVoted = \App\Modules\Management\PollManagement\PollVote\Models\Model::where('poll_id', $id)
            ->where('session_id', $sessionId)
            ->exists();

        return response()->json(['has_voted' => $hasVoted]);
    }

    public function submitVote($id)
    {
        $request = request();
        $sessionId = $request->input('session_id');
        $pollOptionId = $request->input('poll_option_id');

        // Check if already voted
        $existingVote = \App\Modules\Management\PollManagement\PollVote\Models\Model::where('poll_id', $id)
            ->where('session_id', $sessionId)
            ->first();

        if ($existingVote) {
            return response()->json(['success' => false, 'message' => 'Already voted'], 400);
        }

        // Create new vote
        $vote = \App\Modules\Management\PollManagement\PollVote\Models\Model::create([
            'poll_id'        => $id,
            'poll_option_id' => $pollOptionId,
            'session_id'     => $sessionId,
            'status'         => 'active'
        ]);

        return response()->json(['success' => true, 'vote' => $vote]);
    }

    public function getPollResults($id)
    {
        $results = \App\Modules\Management\PollManagement\PollVote\Models\Model::where('poll_id', $id)
            ->selectRaw('poll_option_id, COUNT(*) as votes')
            ->groupBy('poll_option_id')
            ->pluck('votes', 'poll_option_id')
            ->toArray();

        return response()->json(['results' => $results]);
    }

}