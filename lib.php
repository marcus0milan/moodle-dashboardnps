<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Library callbacks for the Feedback Dashboard plugin.
 *
 * The contextual activity access uses Moodle's legacy local-plugin navigation
 * callback. This callback is available in Moodle 4.0.5 and lets the plugin
 * add the action before the standard page header is rendered.
 *
 * @package    local_feedbackdashboard
 * @copyright  2026 Marcus Vinícius Milan da Silva
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function local_feedbackdashboard_extend_navigation(global_navigation $navigation): void {
    \local_feedbackdashboard\local\hook_callbacks::add_activity_header_action();
}