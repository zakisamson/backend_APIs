<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
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

    public function add_product($input){
        $data   = $input["data"];
        $insert = DB::table($input["table"])->insert($data);
        if($insert) {
            return ["success"=> true, "message"=>"Register Success"];
          } else {
            return ["success" => false, "message"=>"Register Failed"];
          }
    }
}
