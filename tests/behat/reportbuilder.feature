@core @local_reportbuilderdemo @core_reportbuilder
Feature: View a report
  In order to view a report and use its filters
  As an admin
  I need to navigate to our demo report

  Background:
    Given the following "courses" exist:
      | fullname | shortname | format | visible |
      | Course 1 | C1        | topics | 1       |
      | Course 2 | C2        | topics | 0       |
      | Course 3 | C3        | topics | 1       |

  @javascript
  Scenario: View course report
    Given I log in as "admin"
    And I navigate to "Development > Report Builder - Course report demo" in site administration
    Then I should see "Report Builder - Course report demo"
    # Check that report contains all three courses.
    And the following should exist in the "reportbuilder-table" table:
      | Course full name with link  | Course short name | Format        | Course visibility |
      | Course 1                    | C1                | Topics format | Yes               |
      | Course 2                    | C2                | Topics format | No                |
      | Course 3                    | C3                | Topics format | Yes               |
    # Test report filters.
    Then I click on "Filters" "button"
    And I set the following fields in the "Course short name" "core_reportbuilder > Filter" to these values:
      | Course short name operator | Is equal to |
      | Course short name value    | C3       |
    And I click on "Apply" "button" in the "[data-region='report-filters']" "css_element"
    Then the following should exist in the "reportbuilder-table" table:
      | Course full name  | Course short name   | Format        | Course visibility |
      | Course 3          | C3                  | Topics format | Yes               |
    And the following should not exist in the "reportbuilder-table" table:
      | Course full name  | Course short name   | Format        | Course visibility |
      | Course 1          | C1                  | Topics format | Yes               |
      | Course 2          | C2                  | Topics format | No                |
    Then I click on "Reset all" "button"
    And the following should exist in the "reportbuilder-table" table:
      | Course full name  | Course short name   | Format        | Course visibility |
      | Course 1          | C1                  | Topics format | Yes               |
      | Course 2          | C2                  | Topics format | No                |
      | Course 3          | C3                  | Topics format | Yes               |
    # Test report can be downloaded.
    And I should see "Download table data as"
    And I set the field "download" to "Microsoft Excel (.xlsx)"
    And I press "Download"
    # Access course page using course full name link.
    Then I click on "Course 3" "link"
    And I should see "Course 3"
    And I should see "Participants"
    And I should not see "Course 2"
