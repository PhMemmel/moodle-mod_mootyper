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
 * The mod_mootyper grade removed event.
 *
 * @package     mod_mootyper
 * @copyright   2016 AL Rachels (drachels@drachels.com)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_mootyper\event;
defined('MOODLE_INTERNAL') || die(); // @codingStandardsIgnoreLine

/**
 * The mod_mootyper grade removed event class.
 *
 * @package    mod_mootyper
 * @copyright  2016 AL Rachels drachels@drachels.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class grade_deleted extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'mootyper';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('grade_deleted', 'mod_mootyper');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' removed a 'mootyper' mode '{$this->other['mode']}'
             grade for exercise '{$this->other['exercise']}' for user id
            '$this->relateduserid' while in the course with id '$this->contextinstanceid'.";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/mootyper/gview.php', array('id' => $this->contextinstanceid));
    }

    /**
     * replace add_to_log() statement.
     *
     * @return array of parameters to be passed to legacy add_to_log() function.
     */
    protected function get_legacy_logdata() {
        $url = new \moodle_url('gview.php', array('id' => $this->contextinstanceid));
        return array($this->courseid, 'mootyper', 'gview', $url->out(), $this->objectid, $this->contextinstanceid);
    }
}
