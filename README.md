# NPS Dashboard for Moodle Feedback

Local Moodle plugin for generating NPS indicators from the native **Feedback** activity (`mod_feedback`).

## Requirements

- Moodle 4.0.5 or later within the Moodle 4.x series;
- PHP 7.4.33 or a PHP version supported by the installed Moodle version;
- native **Feedback** activity enabled.

## Compatibility

- Moodle 4.0.5;
- Moodle 4.4.x and 4.5.x;
- PHP 7.4.33 is supported for Moodle 4.0.5.

The plugin uses APIs available in Moodle 4.0.5, including the legacy local-plugin
navigation callback and the core PDF library. It does not require Moodle's newer
Hooks API.

## Installation

The plugin directory must be exactly:

```text
local/feedbackdashboard
```

When installing through the administration interface, upload the ZIP file containing the root folder `feedbackdashboard/`.
Then navigate to **Site administration → Notifications** and complete the upgrade process.

## Available Access Points

### Within a Feedback Activity

Authorized users can access the **Open NPS Dashboard** button in the activity header actions area.
The access option is available across the native Feedback pages
(Feedback, Settings, Templates, Analysis, and Responses), without relying on the **More** menu.

### Site-wide Dashboard

Administrators and managers can access the dashboard at:

```text
Site administration → Reports → NPS Dashboard
```

The central dashboard compares Feedback activities across the site, displaying the number of responses,
NPS score, promoters, passives, detractors, and shortcuts to the detailed report.

## Permissions

- `local/feedbackdashboard:view`: view the dashboard for a Feedback activity;
- `local/feedbackdashboard:viewall`: view the site-wide dashboard.

By default, these capabilities are granted to the **Manager** role archetype. Administrators
have all permissions. If editing teachers should also have access to the reports,
grant the capability manually in the role definition.

## NPS Identification Rule

The plugin identifies the first single-choice question that represents the complete
**0 to 10** scale. Scores are classified as follows:

- 9–10: promoters;
- 7–8: passives;
- 0–6: detractors.

## Privacy

The plugin does not create database tables or store its own personal data. It reads the responses
already stored in Moodle Feedback and presents them only to authorized users.
