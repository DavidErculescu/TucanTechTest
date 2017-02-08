<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class School extends Model {
    protected $table = 'schools';

    public function members() {
        return $this->belongsToMany(Member::class);
    }
}