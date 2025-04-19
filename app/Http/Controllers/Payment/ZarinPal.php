<?php

namespace App\Http\Controllers\Payment;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use nusoap_client;
class ZarinPal extends Controller
{
    ////////////////////////////////////////////////////////////////////////////////////pay
    public function pay($id,$product,$price) {
        $MerchantID = 'bb8d3044-abac-11e8-b72d-005056a205be';  //Required
        $Amount = $price; //Amount will be based on Toman  - Required
        $Description = 'خرید بسته آموزشی';  // Required
        $CallbackURL = 'http://www.elhamzare.com/payAck/'.$id.'/'.$product.'/'.$price;  // Required
        $userid = $id;
        $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $result = $client->call('PaymentRequest', [
            [
                'MerchantID'     => $MerchantID,
                'Amount'         => $Amount,
                'Description'    => $Description,
                'userid'        => $userid,
                'CallbackURL'    => $CallbackURL,
            ],
        ]);
        if ($result['Status'] == 100) {
            return redirect('https://www.zarinpal.com/pg/StartPay/'.$result['Authority']);
        } else {
            echo'ERR: '.$result['Status'];
        }
    }

    public function PayAck($id,$product,$price)
    {
        $MerchantID = 'bb8d3044-abac-11e8-b72d-005056a205be';
        $Amount = $price; //Amount will be based on Toman
        $Authority = $_GET['Authority'];

        if ($_GET['Status'] == 'OK') {
            $client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
            $client->soap_defencoding = 'UTF-8';
            $result = $client->call('PaymentVerification', [
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,

                ],
            ]);

            if ($result['Status'] == 100) {
                $user = User::find($id);
                $user->update(['status'=>$product]);
                return redirect('http://www.elhamzarei.com/');
            } else {
                echo 'Transation failed. Status:' . $result['Status'];
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////pay
}
