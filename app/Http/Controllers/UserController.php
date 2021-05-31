<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $user = \DB::table("tx_hdr_user")->orderBy("user_id", "desc")->get();
        return $user[0]->user_id;
    }

    public function filter($id){
        $filter = \DB::table("tx_hdr_user")->where("user_id", $id)->get();
        return $filter;
    }
    public function create_user(){
        $input = $this->request->all();
        $requestHeader = [
            "user_name"     => $input["username"],
            "user_password" => $input["password"],
        ];

        $insert = DB::table("tx_hdr_user")->insert($requestHeader);
        $user = \DB::table("tx_hdr_user")->orderBy("user_id", "desc")->get();
        $hdr_id = $user[0]->user_id;

        $requestDetail = [
            "dtl_hdr_id" => $hdr_id,
            "dtl_user_email"=> $input["email"],
            "dtl_user_address"=> $input["address"],
            "dtl_user_phone"=> $input["phone"],
        ];
        $insert = DB::table("tx_dtl_user")->insert($requestDetail);


        if($insert){
            return "Insert success";
        } else {
            return "Insert failure";
        }
    }
    //
}
