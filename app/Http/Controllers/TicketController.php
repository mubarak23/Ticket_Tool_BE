<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Actions\TicketService;
use App\Ticket;

class TicketController extends Controller
{
    //

	//create icket issue
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

    //fetch ticket details
    public function ticket_details(case_id){
          $ticket_details = Ticket::where('case_id', $case_id)->first();
           return response()->json(['message' => 'Ticket  Details', 'data' => $ticket_details], 200);
    }

    //fetch issue lists base on login user
    public function user_ticket_lists($user_id){
    	$query = Ticket::where('user_id', $user_id)->get();
    	$counts = $query->count();
    	return response()->json(['message' => 'Ticket lists created by specific user', 'data' => $query], 200);
    }

    //update Ticket status
    public function update_ticket_status(Request $request){
    	   $validation = Validator::make($request->all(), [
            'case_id' => 'required',
            'user_id' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 401);
        }

         $data = $request->all();

         //check if the tticket exsits
         $ticket_exist = Ticket::where('user_id', $data['user_id'])->where('case_id', $data['case_id'])->exists();
         if(!$ticket_exist){
         	return response()->json(['message' => ' Ticket with the provided details does not exists'], 400);
          }

          $update_status = Ticket::where('user_id', $data['user_id'])->where('case_id', $data['case_id'])->first();
          $update_status->update(['status' => $data['status']]);
          

          return response()->json(['message' => 'Status Updated Successfully', 'data' => $update_status], 200);

      }


      public function Ticket_details($user_id, $case_id){
      		$ticket = Ticket::where('user_id', $user_id)->where('case_id', $case_id)->first();
      		$ticket_action = Ticket::find($case_id)->actions;
      		$actions = $ticket_action->actions;
      		$ticket['actions'] = $actions;
      		return $ticket;

      }




}
