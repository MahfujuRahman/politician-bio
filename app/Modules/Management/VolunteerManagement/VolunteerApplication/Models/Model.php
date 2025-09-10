<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerApplication\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
class Model extends EloquentModel
{
    use SoftDeletes;
    protected $table = "volunteer_applications";
    protected $guarded = [];
    protected $casts = [
        'help_types' => 'array',
        'time_slots' => 'array',
        'week_days'  => 'array'
    ];
    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = ($data->first_name ?? 'volunteer') . "-" . ($data->last_name ?? 'application') . "-" . $random_no;
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
}