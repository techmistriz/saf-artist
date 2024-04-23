<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Therapist;
use App\Models\Child;
use App\Models\ScheduledSession;
use Carbon\Carbon;
use Validator;
use Auth;
use Hash;
use App\Http\Requests\UserRequest;
use App\Traits\UserTrait;
use ImageUploadHelper;
use FileUploadHelper;

class CronController extends Controller
{   

    public function __construct() {
       
    }

    public function checkSession(Request $request) {
        
        try { 

            $today = Carbon::today()->addDay();
            Child::$shouldAppends = false;
            User::$shouldAppends = false;
            Therapist::$shouldAppends = false;
            // return $today;

            $ScheduledSessionModel = ScheduledSession::query();
            // $ScheduledSessionModel->with(['child', 'parent', 'therapist']);
            $ScheduledSessionModel->with(['child' => function ($query) {
                $query->selectRaw('*');
                $query->selectRaw(Child::decryptableColumnsMapping());
            }]);

            $ScheduledSessionModel->with(['parent' => function ($query) {
                $query->selectRaw('*');
                $query->selectRaw(User::decryptableColumnsMapping());
            }]);

            $ScheduledSessionModel->with(['therapist' => function ($query) {
                $query->selectRaw('*');
                $query->selectRaw(Therapist::decryptableColumnsMapping());
            }]);

            $ScheduledSessionModel->whereHas('child');
            $ScheduledSessionModel->whereHas('parent');
            $ScheduledSessionModel->whereHas('therapist');
            $ScheduledSessionModel->where('session_date', '=', $today);

            $scheduledSessions = $ScheduledSessionModel->get();

            // dd($scheduledSessions->toArray());

            if($scheduledSessions->count()){

                foreach ($scheduledSessions as $key => $session) {
                    
                    $child      = $session->child;
                    $parent     = $session->parent;
                    $therapist  = $session->therapist;

                    // dd($therapist);

                    \App\Notifications\PushNotification::upcommingScheduleSessionNotification($session);

                }

                return $this->prepareResultForAPI(true, null, "Notifications sent successfully.");
            }
            
            return $this->prepareResultForAPI(false, null, "Session not found.");

        } catch (\Exception $e) {

            return $this->prepareResultForAPI(false, null, 'Something went wrong.');
        }  
    }

}