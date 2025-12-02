<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait ActivityLogger
{
    /**
     * Log user activity
     */
    public static function logActivity(
        string $description,
        ?string $logName = null,
        ?string $subjectType = null,
        ?int $subjectId = null,
        ?string $event = null,
        ?array $properties = null
    ) {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'log_name' => $logName,
            'description' => $description,
            'subject_type' => $subjectType,
            'subject_id' => $subjectId,
            'event' => $event,
            'properties' => $properties,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}