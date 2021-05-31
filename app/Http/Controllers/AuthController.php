<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function main(){
        $input  = $this->request->json()->all();
        $action = $input["action"];
        return $this->$action($input);
    }

    public function login($input){
        $login  = DB::table($input["table"])->where('user_name', '=', $input["username"])->where('user_password', '=',$input["password"])->get();
        if($login) {
            return ["success"=> true, "message"=>"Login Success", "data"=>$login];
          } else {
            return ["success" => false, "message"=>"Login Failed"];
          }
    }
}
