
<?php
namespace App\Actions;
use App\Exceptions\InvalidRequestException;

use App\Action_Ticket;
use Illuminate\Http\Request;


class ActionService{

    public function execute( $data){
        try {
             $create_issue = Action_Ticket::create($data);
             return response()->json(['message' => 'Action Subimtted Sucessfully'], 201);
        }catch (\Exception $exception) {
            throw new InvalidRequestException($exception->getMessage(), 400);
        }
    }

}