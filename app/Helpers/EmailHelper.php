<?php 
namespace App\Helpers;

use App\Jobs\SendEmailJob;
use App\Mail\ReservationAdminEmail;
use App\Mail\ReservationUserEmail;

class EmailHelper
{
    public function sendSuccessReservationUserEmail($details,$recipient)
    {
        SendEmailJob::dispatch(new ReservationUserEmail($details), $recipient);
    }

    public function sendSuccessReservationAdminEmail($details,$user,$recipient)
    {
        SendEmailJob::dispatch(new ReservationAdminEmail($details,$user), $recipient);
    }
    
}

?>