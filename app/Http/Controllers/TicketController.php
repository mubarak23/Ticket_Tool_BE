<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Actions\TicketService;
use App\Ticket;

class TicketController extends Controller
{
    //

    public function create_ticket(Request $request, TicketService $TicketService){

        $validation = Validator::make($request->all(), [
            'case_id' => 'required',
            'user_id' => 'required',
            'agent_name' => 'required',
            'agent_email' => 'required|email',
            'agent_phone' => 'required',
            'terminal_id' => 'required',
            "reference_id" => 'required',
            "issue_type" => 'required',
            'assign_to' => 'required',
            'issue' => 'required',
            'submitted_by' => 'required',
            'comment' => 'required',
            'assign_to_email' => 'required|email'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 401);
        }

         $data = $request->all();


        if($data['issue_type'] == 'OTTHERS') $data['RRN'] = 'NULL';

        if($data['issue_type'] == 'WALLET') $data['RRN'] = 'NULL';

        $create_ticket = $TicketService->execute($data);
        //$this->dispatch_mail($data);
        return $create_ticket;

    }
}
