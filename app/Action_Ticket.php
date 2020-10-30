<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action_Ticket extends Model
{
    //
    protected $fillable = [
        'case_id', 'user_id', 'issue', 'issue_type', 'assign_to', 'submitted_by', 'actions'
    ];
    
}
