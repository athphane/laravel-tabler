<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show success message
     *
     * @param string $message
     */
    protected function flashSuccessMessage($message = '')
    {
        // get current data
        $values = session('alerts', []);

        // append the new data
        $values[] = [
            'title' => __('Success!'),
            'text' => $message ?: __('Your inputs have been saved.'),
            'type' => 'success',
        ];

        // flash the new data
        session()->flash('alerts', $values);
    }
}
