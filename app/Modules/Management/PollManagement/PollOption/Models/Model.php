<?php

namespace App\Modules\Management\PollManagement\PollOption\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Management\PollManagement\Poll\Models\Model as PollModel;
use App\Modules\Management\PollManagement\PollVote\Models\Model as PollVoteModel;
class Model extends EloquentModel
{
    use SoftDeletes;
    protected $table = "poll_options";
    protected $guarded = [];
    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
            if (strlen($data->slug) > 50) {
                $data->slug = substr($data->slug, strlen($data->slug) - 50, strlen($data->slug));
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }
    public function scopeTrased($q)
    {
        return $q->onlyTrashed();
    }

    public function poll_id()
    {
        return $this->belongsTo(PollModel::class,'poll_id');
    }
    public function votes()
    {
        return $this->hasMany(PollVoteModel::class, 'option_id');
    }
}