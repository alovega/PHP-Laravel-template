<?php
namespace App\Helpers;

class LogHelper
{
    public static function parseJsDebugLog($logLine)
    {
        // Regular expression to capture the different parts of the log line
        $pattern = '/^(.+?) DEBUG APP (.+?) : \[(.+?) (.+?)\] : (.+)/';

        preg_match($pattern, $logLine, $matches);

        if (!empty($matches)) {
            return [
                'timestamp' => $matches[1],
                'app_version' => $matches[2],
                'username' => trim($matches[3]),
                'call_id' => trim($matches[4]) === "--------" ? null : trim($matches[4]), // Handle missing callId
                'message' => $matches[5],
            ];
        }

        // Fallback if the regex doesn't match (invalid log format)
        return null; 
    }
}
