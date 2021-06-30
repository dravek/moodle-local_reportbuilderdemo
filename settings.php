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
 * Add page to admin menu.
 *
 * @package    local_reportbuilderdemo
 * @copyright  2021 David Matamoros <davidmc@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) { // Needs this condition or there is error on login page.
    // Report with the list of courses.
    $ADMIN->add('development', new admin_externalpage('local_reportbuilderdemo_course',
        get_string('course', 'local_reportbuilderdemo'),
        new moodle_url('/local/reportbuilderdemo/course.php')));

    // Report with the list of users.
    $ADMIN->add('development', new admin_externalpage('local_reportbuilderdemo_user',
        get_string('user', 'local_reportbuilderdemo'),
        new moodle_url('/local/reportbuilderdemo/user.php')));

    // Both reports on the same page.
    $ADMIN->add('development', new admin_externalpage('local_reportbuilderdemo_usercourse',
        get_string('usercourse', 'local_reportbuilderdemo'),
        new moodle_url('/local/reportbuilderdemo/user_course.php')));
}