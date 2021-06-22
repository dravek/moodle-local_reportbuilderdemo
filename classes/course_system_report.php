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

declare(strict_types=1);

namespace local_reportbuilderdemo;

use core_reportbuilder\local\entities\course;
use core_reportbuilder\system_report;

/**
 * System report for testing the course entity
 *
 * @package     local_reportbuilderdemo
 * @copyright   2021 David Matamoros <davidmc@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_system_report extends system_report {

    /**
     * Initialise the report
     */
    protected function initialise(): void {
        $entity = new course();

        // Set the main report entity.
        $this->set_main_table('course', $entity->get_table_alias('course'));
        $this->add_entity($entity);

        // Add columns to the report.
        $columns = [
            'course:coursefullnamewithlink',
            'course:shortname',
            'course:category',
            'course:format',
            'course:startdate',
            'course:enddate',
            'course:visible',
        ];
        $this->add_columns_from_entities($columns);

        // Add filters to our report.
        $filters = [
            'course:fullname',
            'course:shortname',
            'course:category',
            'course:format',
            'course:startdate',
            'course:enddate',
            'course:visible',
        ];
        $this->add_filters_from_entities($filters);

        // Set report as downloadable.
        $this->set_downloadable(true);
    }

    /**
     * Ensure we can view the report
     *
     * @return bool
     */
    protected function can_view(): bool {
        return true;
    }
}
