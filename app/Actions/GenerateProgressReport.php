<?php
// app/Actions/GenerateProgressReport.php

namespace App\Actions;

use App\Models\Enrolment;
use App\Models\ProgressReport;

class GenerateProgressReport
{
    public function handle(Enrolment $enrolment): ProgressReport
    {
        $enrolment->load('grades');

        $totalScore    = $enrolment->grades->sum('score');
        $totalMaxScore = $enrolment->grades->sum('max_score');
        $average       = $totalMaxScore > 0
            ? round(($totalScore / $totalMaxScore) * 100, 2)
            : 0;

        return ProgressReport::updateOrCreate(
            [
                'student_id' => $enrolment->student_id,
                'course_id'  => $enrolment->course_id,
            ],
            [
                'average_grade'   => $average,
                'completed_items' => $enrolment->grades->count(),
                'generated_at'    => now(),
            ]
        );
    }
}