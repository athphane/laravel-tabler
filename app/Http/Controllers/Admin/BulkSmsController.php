<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkSmsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class BulkSmsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.bulk-sms.index');
    }


    /**
     * Send the damn sms
     *
     * @param BulkSmsRequest $request
     * @return RedirectResponse
     * @throws ConfigurationException|TwilioException
     */
    public function sendSms(BulkSmsRequest $request): RedirectResponse
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $client = new Client($sid, $token);

        $numbers = explode("\n", $request->input('to'));
        $count = 0;
        foreach ($numbers as $number) {
            $client->messages->create(
                $number,
                [
                    'from' => $request->input('sender'),
                    'body' => $request->input('message'),
                ]);

            $count++;
        }

        $this->flashSuccessMessage($count . " Message sent!");

        return redirect()->action([self::class, 'index']);
    }
}
