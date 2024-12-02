<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class DebugLogger
{
    const APP_VERSION = '1.0.0'; // Replace with your actual app version

    public static function debugLog($username = "", $text, $callId, $device = "APP", $realtime = false)
    {
        // Get current UTC time string in PHP format
        $utcTimeString = date('Y-m-d H:i:s'); // Adjust format as needed

        // Format UUID or use default placeholder
        $formattedCallId = self::formatUUID($callId) ?? '--------';

        // Format the log text similarly to the JavaScript function
        $logText = "{$utcTimeString} DEBUG {$device} " . self::APP_VERSION . " : [{$username} {$formattedCallId}] : {$text}";

        // If real-time logging is required, handle it (e.g., send to a specific log channel)
        if ($realtime) {
            Log::channel('realtime')->info($logText); // Make sure to configure the 'realtime' channel if used
        }

        // Log to the default log channel
        Log::info($logText);
    }

    private static function formatUUID($uuid)
    {
        // Define UUID formatting logic here if needed
        return $uuid; // Adjust according to your needs (e.g., mask, validate, or format the UUID)
    }
}