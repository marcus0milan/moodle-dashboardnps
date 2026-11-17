# NPS Dashboard for Moodle Feedback

A local Moodle plugin that generates NPS reports from responses collected through the native **Feedback** activity (`mod_feedback`).

## Requirements

- Moodle 4.4.x or 4.5.x;
- Compatible PHP version;
- Native Feedback activity enabled.

## Installation

1. Place the plugin in the following directory:

   ```text
   local/feedbackdashboard
   ```

2. If installing via ZIP, make sure the archive contains the `feedbackdashboard/` folder at its root.
3. Go to **Site administration → Notifications** and complete the installation.

## Access

The dashboard is available in two ways:

**Feedback Activity**

Users with the required permission can access the dashboard through the **Open NPS Dashboard** button in the activity header. It is available on all Feedback pages, including Feedback, Settings, Templates, Analysis, and Responses.

**Site-wide Dashboard**

Administrators and managers can access the central dashboard through:

```text
Site administration → Reports → NPS Dashboard
```

It provides an overview of all Feedback activities, including response counts, NPS scores, promoters, passives, detractors, and links to detailed reports.

## Permissions

The plugin defines two capabilities:

- `local/feedbackdashboard:view`: access reports for individual Feedback activities;
- `local/feedbackdashboard:viewall`: access the site-wide dashboard.

By default, both capabilities are granted to the **Manager** role archetype. Administrators have full access.

To allow editing teachers to view reports, grant the appropriate capability through the role permissions settings.

## NPS Calculation

The plugin automatically identifies the first single-choice question containing the complete **0–10** scale.

Responses are classified as follows:

- **9–10:** Promoters
- **7–8:** Passives
- **0–6:** Detractors

The NPS score is calculated based on the percentage of promoters minus the percentage of detractors.

## Privacy

The plugin does not create additional database tables or store personal data.

It reads existing responses from Moodle Feedback and displays the results only to users with the required permissions.
