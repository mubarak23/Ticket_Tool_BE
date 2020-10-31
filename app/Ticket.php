<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //

     protected $fillable = [
        'case_id', 'user_id', 'agent_name', 'agent_email', 'agent_phone', 'terminal_id',
          'issue_type', 'issue', 'RRN', 'submitted_by', 'amount', 'reference_id', 'comment', 'assign_to', 'assign_to_email', 'status', 'close_issue_status'
    ];

    protected $primaryKey = 'case_id';

    public function actions(){
    	return $this->hasOne(Action_Ticket::class, 'case_id', 'case_id');
    }


}
