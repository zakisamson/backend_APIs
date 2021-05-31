<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BillingController extends Controller
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
        $billing = \DB::table("tx_hdr_billing")->get();
        return $billing;
    }

    public function add_items(){
        $input = $this->request->all();
        $requestBillHeader = [
            "name_hdr_billing" => $input["nama"],
            "phone_hdr_billing" => $input["nomor"],
            "email_hdr_billing" => $input["email"],
            "ket_hdr_billing" => $input["keterangan"],
            "address_hdr_billing" => $input["alamat"],
        ];
        $insert = DB::table("tx_hdr_billing")->insert($requestBillHeader);

        $user = \DB::table("tx_hdr_billing")->orderBy("id_hdr_billing","desc")->get();
        $hdr_id = $user[0]->id_hdr_billing;

        $requestBillDetail = [
            "dtl_hdr_id" => $hdr_id,
            "product_name" => $input["nama_produk"],
            "quantity" => $input["jumlah"],
        ];
        $insert = DB::table("tx_dtl_billing")->insert($requestBillDetail);

        if($insert){
            return "Insert success";
        } else {
            return "Insert failure";
        }
    }
    //
}
