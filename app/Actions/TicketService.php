<?php
namespace App\Actions;
use App\Exceptions\InvalidRequestException;

use App\Ticket;
use Illuminate\Http\Request;


class TicketService{

    public function execute( $data){
        try {
             $create_issue = Ticket::create($data);
             return response()->json(['message' => 'Ticket Subimtted Sucessfully'], 200);
        }catch (\Exception $exception) {
            throw new InvalidRequestException($exception->getMessage(), 400);
        }
    }

}