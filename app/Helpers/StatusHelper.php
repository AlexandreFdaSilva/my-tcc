<?php

namespace App\Helpers;

use App\Enums\Status;

class StatusHelper {
    public static function getStatusText($status) {
        switch ($status) {
            case Status::NotInitialized:
                return __('messages.Not Initialized');
            case Status::InProgress:
                return __('messages.In Progress');
            case Status::Completed:
                return __('messages.Completed');
            default:
                return '';
        }
    }
}
