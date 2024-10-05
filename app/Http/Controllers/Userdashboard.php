<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Attending;
use Illuminate\Support\Facades\DB;

class Userdashboard extends Controller
{
    public function __invoke()
    {
        // ดึงจำนวนผู้ใช้และเหตุการณ์
        $userCount = User::count();
        $eventCount = Event::count();

        // ดึงข้อมูล attendings
        $attendings = DB::table('attendings')
            ->join('users', 'attendings.user_id', '=', 'users.id')
            ->join('events', 'attendings.event_id', '=', 'events.id')
            ->select(
                'users.id as user_id',
                'users.name as name_user',
                'events.title as event_name',
                'events.start_time as event_time',
                'events.start_date as event_start',
                'events.end_date as event_end'
            )
            ->get();

            $events = Event::all(); 
        
            // คำนวณเปอร์เซ็นต์สำหรับแต่ละเหตุการณ์
            foreach ($events as $event) {
                $totalUsers = User::count(); // จำนวนผู้ใช้ทั้งหมด
                $attendingCount = Attending::where('event_id', $event->id)->count(); // จำนวนผู้ใช้ที่เข้าร่วมเหตุการณ์
            
                // คำนวณเปอร์เซ็นต์
                $event->progress = $totalUsers > 0 ? ($attendingCount / $totalUsers) * 100 : 0;
            
                // เรียกใช้ฟังก์ชันเพื่อรับสีของแถบโปรเกรส
                $event->progressClass = $this->getProgressBarClass($event->progress);
            }

        // ส่งข้อมูลทั้งหมดไปยัง view
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'eventCount' => $eventCount,
            'attendings' => $attendings,
            'events' => $events,
        ]);
    }

    private function getProgressBarClass($progress)
    {
        if ($progress <= 30) {
            return '#e74a3b'; // Danger
        } elseif ($progress <= 50) {
            return '#f6c23e'; // Warning
        } elseif ($progress <= 70) {
            return '#36b9cc'; // Info
        } else {
            return '#1cc88a'; // Success
        }
    }
}
