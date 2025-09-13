<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\GetUsers;
use App\Jobs\CleanLogs;
use App\Jobs\CheckForNewOrder;
use App\Jobs\OrderReceived;
use App\Jobs\OpenGetirVendor;

$openingTime = config('credentials.vendor.openingTime', '9:00');
$closingTime = config('credentials.vendor.closingTime', '21:00');
Schedule::job(new CheckForNewOrder)->everyMinute()->between($openingTime, $closingTime);
Schedule::job(new GetUsers)->everyTenMinutes()->between($openingTime, $closingTime);
Schedule::job(new CleanLogs)->daily();
Schedule::job(new OpenGetirVendor)->dailyAt($openingTime);
// Schedule::job(new OpenGetirVendor)->everyMinute();
// Schedule::job(new OrderReceived)->everyMinute();
