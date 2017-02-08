<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $member_id
 * @property integer $school_id
 */
class MemberSchool extends Model {
    protected $table = 'member_school';
    public $timestamps = FALSE;
}