<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Request\Request as RequestModel;
use Log;
use Kreait\Firebase\Contract\Database;
use Illuminate\Validation\ValidationException;
use App\Base\Constants\Masters\PushEnums;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use App\Transformers\Payment\OwnerWalletTransformer;
use App\Jobs\Notifications\SendPushNotification;
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
use App\Base\Constants\Auth\Role;
use Carbon\Carbon;
use Str;
use Ixudra\Curl\Facades\Curl;
use App\Helpers\Payment\ThawaniPaymentService;


class ThawaniPayController extends Controller
{
    protected $thawaniService;

        public function __construct(ThawaniPaymentService $thawaniService)
        {
            $this->thawaniService = $thawaniService;
        }
    

    public function checkout()
    {

        $orderId = uniqid(); // Generate a unique order ID
        $amount = request()->input('amount');

        // Create a Thawani session
        $session = $this->thawaniService->createSession($amount, $orderId);
            


        if (isset($session['data']['session_id'])) {
            $sessionId = $session['data']['session_id'];


            return redirect("https://uatcheckout.thawani.om/pay/{$sessionId}?key=HGvTMLDssJghr9tlN9gr4DVYt0qyBy");
        }

        return back()->with('error', 'Payment session could not be created.');

    }


}
