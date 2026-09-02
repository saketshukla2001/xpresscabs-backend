<?php

namespace App\Http\Controllers\Api\V1\Payment\Khalti;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\ApiController;
use App\Models\Payment\UserWalletHistory;
use App\Models\Payment\DriverWalletHistory;
use App\Transformers\Payment\WalletTransformer;
use App\Transformers\Payment\DriverWalletTransformer;
use App\Http\Requests\Payment\AddMoneyToWalletRequest;
use App\Transformers\Payment\UserWalletHistoryTransformer;
use App\Transformers\Payment\DriverWalletHistoryTransformer;
use App\Models\Payment\UserWallet;
use App\Models\Payment\DriverWallet;
use App\Base\Constants\Masters\WalletRemarks;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Jobs\NotifyViaMqtt;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Support\Facades\Log;

/**
 * @group Khalti Payment Gateway
 *
 * Payment-Related Apis
 */
class KhaltiPaymentController extends ApiController
{

    /**
     * Initialize Payment
     * 
     * 
     * 
     * */
    public function initialize(Request $request){

    
        $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://dev.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "return_url": "https://ayoservices.com/",
    "website_url": "https://ayoservices.com/",
    "amount": "1000",
    "purchase_order_id": "Order01",
        "purchase_order_name": "test",

    "customer_info": {
        "name": "Test Bahadur",
        "email": "test@khalti.com",
        "phone": "9800000001"
    }
    }

    ',
    CURLOPT_HTTPHEADER => array(
        'Authorization: key 35a71cd8446a4a8aaef23fcf5dbf038e',
        'Content-Type: application/json',
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl); 

    $decoded_response = json_decode($response);
    

    if (property_exists($decoded_response,'status_code')) {
            

        if($decoded_response->status_code==401){

             return response()->json(['success'=>false,'message'=>'invalid-secret-key-configured']);
        }

    
    return response()->json(['success'=>false,'message'=>'initialize-failed']);



    } else {
    
    return response()->json(['success'=>true,'message'=>'success','data'=>json_decode($response)]);  

    }



    }

   

    public function success(Request $request)
    {

        return view('success',['success']);

    }
    
}
