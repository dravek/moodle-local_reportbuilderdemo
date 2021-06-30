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

use core_reportbuilder\system_report;
use core_reportbuilder\local\entities\user;
use core_reportbuilder\local\helpers\database;

/**
 * System report for testing the user entity
 *
 * @package     local_reportbuilderdemo
 * @copyright   2021 Paul Holden <paulh@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_system_report extends system_report {

    /**
     * Initialise the report
     */
    protected function initialise(): void {
        global $CFG;

        $userentity = new user();
        $usertablealias = $userentity->get_table_alias('user');

        // Set the main report table.
        $this->set_main_table('user', $usertablealias);

        $paramguest = database::generate_param_name();
        $this->add_base_condition_sql("{$usertablealias}.id <> :{$paramguest}", [
            $paramguest => $CFG->siteguest,
        ]);

        // Add our user entity.
        $this->add_entity($userentity);

        // Add columns to the report.
        $columns = [
            'user:fullnamewithpicturelink',
            'user:email',
            'user:city',
            'user:country',
            'user:confirmed',
        ];
        $this->add_columns_from_entities($columns);
        $this->set_initial_sort_column('user:fullnamewithpicturelink', SORT_ASC);

        // Add filters to our report.
        $filters = [
            'user:fullname',
            'user:email',
            'user:department',
        ];
        $this->add_filters_from_entities($filters);

        // Set report as downloadable and set our custom file name.
        $this->set_downloadable(true, 'myfilename');
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
