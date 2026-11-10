<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Course-wide Excel export for the Feedback Dashboard plugin.
 *
 * Generates a plain spreadsheet (no styling, like Moodle native reports)
 * with one row per Feedback activity that contains a valid 0-to-10 NPS question.
 *
 * Columns: nome_da_aula, numero_de_respondentes, nps.
 *
 * @package    local_feedbackdashboard
 * @copyright  2026 Marcus Vinícius Milan da Silva
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/feedback/lib.php');
require_once($CFG->libdir . '/excellib.class.php');

use local_feedbackdashboard\local\nps_service;

$courseid = required_param('id', PARAM_INT);

// Optional filter (same "activities[]" parameter used by course.php).
$selectedactivityids = optional_param_array('activities', [], PARAM_INT);
$selectedactivityids = array_values(array_unique(array_map('intval', $selectedactivityids)));

$course = get_course($courseid);

require_login($course);

require_capability(
    'local/feedbackdashboard:viewall',
    context_system::instance()
);

$sql = "SELECT cm.id AS cmid,
               f.id AS feedbackid,
               f.name AS feedbackname,
               f.anonymous
          FROM {feedback} f
          JOIN {course_modules} cm ON cm.instance = f.id
          JOIN {modules} m ON m.id = cm.module AND m.name = :modname
         WHERE cm.course = :courseid
           AND cm.deletioninprogress = 0
      ORDER BY f.name ASC, cm.id ASC";

$records = $DB->get_records_sql($sql, [
    'modname' => 'feedback',
    'courseid' => $course->id,
]);

$rows = [];

foreach ($records as $record) {
    $modulecontext = context_module::instance((int) $record->cmid, IGNORE_MISSING);

    if (!$modulecontext) {
        continue;
    }

    // Same access checks used by course.php and download_course.php.
    if (
        !has_capability('mod/feedback:viewreports', $modulecontext)
        || !has_capability('local/feedbackdashboard:view', $modulecontext)
    ) {
        continue;
    }

    if (!empty($selectedactivityids) && !in_array((int) $record->cmid, $selectedactivityids, true)) {
        continue;
    }

    $summary = nps_service::get_summary((object) [
        'id' => (int) $record->feedbackid,
        'anonymous' => (int) $record->anonymous,
    ]);

    // Only Feedback activities with a valid NPS question.
    if (empty($summary['hasnps'])) {
        continue;
    }

    // Lesson name = text after the first " - ".
    // "Pesquisa de Satisfação - Aula 05 - Neurologia" => "Aula 05 - Neurologia".
    $fullname = format_string($record->feedbackname, true, ['context' => $modulecontext]);
    $parts = explode(' - ', $fullname, 2);
    $lessonname = (isset($parts[1]) && trim($parts[1]) !== '') ? trim($parts[1]) : $fullname;

    $rows[] = [
        'name' => $lessonname,
        'respondents' => (int) $summary['totalresponses'],
        'nps' => ((int) $summary['validresponses'] > 0) ? (int) round($summary['nps']) : null,
    ];
}

$filename = clean_filename(
    'nps_' . format_string($course->shortname, true) . '_' . userdate(time(), '%Y%m%d')
) . '.xlsx';

$workbook = new MoodleExcelWorkbook('-');
$workbook->send($filename);

$sheet = $workbook->add_worksheet('NPS');

$sheet->write_string(0, 0, 'nome_da_aula');
$sheet->write_string(0, 1, 'numero_de_respondentes');
$sheet->write_string(0, 2, 'nps');

$rownumber = 1;
foreach ($rows as $row) {
    $sheet->write_string($rownumber, 0, $row['name']);
    $sheet->write_number($rownumber, 1, $row['respondents']);

    if ($row['nps'] !== null) {
        $sheet->write_number($rownumber, 2, $row['nps']);
    }

    $rownumber++;
}

$workbook->close();
exit;
