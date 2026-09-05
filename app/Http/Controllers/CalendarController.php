<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surgery;
use App\Models\ShiftHandover;
use App\Models\MedicalRecord;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display the hospital staff calendar & real-time clock page.
     */
    public function index(Request $request)
    {
        // Selected year and month (default to current month)
        $year = (int) $request->input('year', Carbon::now()->year);
        $month = (int) $request->input('month', Carbon::now()->month);

        $currentDate = Carbon::createFromDate($year, $month, 1);
        $prevMonth = (clone $currentDate)->subMonth();
        $nextMonth = (clone $currentDate)->addMonth();

        // Fetch surgeries for the selected month
        $surgeries = Surgery::with(['patient', 'surgeon'])
            ->whereYear('scheduled_at', $year)
            ->whereMonth('scheduled_at', $month)
            ->orderBy('scheduled_at', 'asc')
            ->get();

        // Fetch shift handovers for the selected month
        $handovers = ShiftHandover::with(['sender', 'receiver', 'branch'])
            ->whereYear('handover_time', $year)
            ->whereMonth('handover_time', $month)
            ->orderBy('handover_time', 'asc')
            ->get();

        // Fetch OPD medical records for the selected month
        $medicalRecords = MedicalRecord::with(['patient', 'doctor', 'branch'])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'asc')
            ->get();

        // Group events by date string (YYYY-MM-DD)
        $eventsByDate = [];

        foreach ($surgeries as $s) {
            $dateStr = Carbon::parse($s->scheduled_at)->format('Y-m-d');
            $eventsByDate[$dateStr][] = [
                'type' => 'surgery',
                'title' => __('ការវះកាត់') . ': ' . ($s->patient->name ?? __('អ្នកជំងឺ')),
                'time' => Carbon::parse($s->scheduled_at)->format('h:i A'),
                'doctor' => $s->surgeon->name ?? '-',
                'room' => $s->room_number ?? '-',
                'status' => $s->status,
                'detail_url' => route('surgeries.show', $s->id),
            ];
        }

        foreach ($handovers as $h) {
            $dateStr = Carbon::parse($h->handover_time)->format('Y-m-d');
            $eventsByDate[$dateStr][] = [
                'type' => 'handover',
                'title' => __('ការប្រគល់-ទទួលវេន') . ': ' . ($h->sender->name ?? '-'),
                'time' => Carbon::parse($h->handover_time)->format('h:i A'),
                'receiver' => $h->receiver->name ?? '-',
                'notes' => $h->notes ?? '-',
                'detail_url' => route('handovers.show', $h->id),
            ];
        }

        foreach ($medicalRecords as $m) {
            $dateStr = Carbon::parse($m->created_at)->format('Y-m-d');
            $eventsByDate[$dateStr][] = [
                'type' => 'opd',
                'title' => __('OPD') . ': ' . ($m->patient->name ?? __('អ្នកជំងឺ')),
                'time' => Carbon::parse($m->created_at)->format('h:i A'),
                'doctor' => $m->doctor->name ?? '-',
                'symptoms' => $m->symptoms ?? '-',
                'detail_url' => route('medical-records.show', $m->id),
            ];
        }

        // Calendar days calculation
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        
        $startDayOfWeek = $startOfMonth->dayOfWeek; // 0 = Sunday, 1 = Monday, etc.
        $daysInMonth = $currentDate->daysInMonth;

        return view('calendar.index', compact(
            'year',
            'month',
            'currentDate',
            'prevMonth',
            'nextMonth',
            'daysInMonth',
            'startDayOfWeek',
            'eventsByDate'
        ));
    }
}
