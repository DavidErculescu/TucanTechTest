<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Member extends Model {
    protected $table = 'members';

    public function schools() {
        return $this->belongsToMany(School::class);
    }
}