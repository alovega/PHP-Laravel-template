<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\LogHelper;
use App\Helpers\DebugLogger;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-log', function () {

    DebugLogger::debugLog('john_doe', 'User logged in', '1234-5678-9101-1121', 'WEB', true);
    // Test if the function correctly parses a valid log line with all components (e.g., timestamp, app version, username, call ID, and message).
    $logLine1 = "2024-11-29 12:34:56 DEBUG APP v1.0 : [user1 123456] : Some log message here.";

    DebugLogger::debugLog('john_doe', 'User logged in with placeholder callId', '--------', 'WEB', true);
    //Test if the function handles a log line with "--------" as the callId correctly (returns null for callId).
    $logLine2 = "2024-11-29 12:34:56 DEBUG APP v1.0 : [user1 --------] : Some log message with missing call ID.";
    DebugLogger::debugLog('john_doe', 'This is an invalid log line', 'invalid-call-id', 'WEB', false);
    //Test if the function returns null when the log line doesn’t match the expected format.
    $logLine3 = "Invalid log line format without the expected structure.";
   
    $parsedLog = LogHelper::parseJsDebugLog($logLine1);

    // Return the parsed log as a JSON response
    return response()->json($parsedLog);
});