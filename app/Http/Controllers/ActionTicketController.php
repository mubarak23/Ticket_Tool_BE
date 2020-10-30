<?php

namespace App\Http\Controllers;

use App\Actions\ActionService;
use Illuminate\Http\Request;
use App\Action_Ticket;

class ActionTicketController extends Controller
{
    //

    //create icket issue
    public function create_action_on_ticket(Request $request, ActionService $ActionService){

        $validation = Validator::make($request->all(), [
            'case_id' => 'required',
            'user_id' => 'required',
            'issue_type' => 'required',
            'assign_to' => 'required',
            'submitted_by' => 'required',
            'actions' => 'required'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 401);
        }

         $data = $request->all();

         $check_action_ticket = Action_Ticket::where('user_id', $data['user_id'])->where('case_id', $data['case_id'])->exist()
         if($check_action_ticket){
         	//run an update
         	$update_ticket_action = Action_Ticket::where('user_id', $user_id)->where('case_id', $data['case_id'])->first();
         	$update_ticket_action->update(['status', $data['status']]);
         	return response()->json(['message' => 'Action on Ticket Updated Sucessfully'], 201);
         }

        $create_action_on_ticket= $ActionService->execute($data);
        //$this->dispatch_mail($data);
        if($create_action_on_ticket){
        	return $create_action_on_ticket
        }
        return response()->json(["message" => "failed to process issue action"], 400);

    }
}
