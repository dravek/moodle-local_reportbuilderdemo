<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_reportbuilderdemo
 * @copyright  2021 David Matamoros <davidmc@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

declare(strict_types=1);

use core_reportbuilder\system_report_factory;
use local_reportbuilderdemo\user_system_report;

require_once('../../config.php');

require_login();

$PAGE->set_url(new moodle_url('/local/reportbuilderdemo/user.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('user', 'local_reportbuilderdemo'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('user', 'local_reportbuilderdemo'));

// Create report instance.
$userreport = system_report_factory::create(user_system_report::class, context_system::instance());
echo $userreport->output();

echo $OUTPUT->footer();
