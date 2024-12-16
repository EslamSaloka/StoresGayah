<?php

namespace App\Http\Controllers\ECommerce\Profile;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Models\Notification;

class NotificationsController extends ECommerceController
{
    public function destroy($domain,Notification $notification) {
        $notification->delete();
        return 1;
    }
}
