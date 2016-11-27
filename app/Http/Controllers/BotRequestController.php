<?php

namespace App\Http\Controllers;

use App\Jobs\BotJobHandler;
use Illuminate\Http\Request;

class BotRequestController extends Controller
{
    public function handleUserRequests(Request $request)
    {
        \Log::debug($request->getQueryString());
        if ($request->getMethod() == "GET" && $_GET["hub_challenge"] != null && $_GET["hub_challenge"] != "")
        {
            \Log::debug("Request is a hub Challenge from fb. Responding with challenge..... value");
            return $_GET["hub_challenge"];
        }else
        {
            $requestJSON = $request->getContent();
            \Log::debug("Request JSON From FB ".$requestJSON);
            $this->dispatch(new BotJobHandler($requestJSON));
        }
    }
}
