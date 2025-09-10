<?php

namespace App\Modules\Management\EventManagement\Event\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Management\EventManagement\EventFacilities\Models\Model as EventFacilitiesModel;
use App\Modules\Management\EventManagement\Speakers\Models\Model as SpeakerModel;
class Model extends EloquentModel
{
    use SoftDeletes;
    protected $table = "events";
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

    public function event_facilities()
    {
        return $this->hasOne(EventFacilitiesModel::class, 'event_id', 'id');
    }
    public function event_speakers()
    {
        return $this->hasMany(SpeakerModel::class, 'event_id', 'id');
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
    }}