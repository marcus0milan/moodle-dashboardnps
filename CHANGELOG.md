# Changelog

## 1.1.6-beta - 2026-11-10

- Implemented a button to download a report of the NPS indicators for all lessons in a course in an Excel spreadsheet.

## 1.1.5-beta - 2026-09-14

- Adjusts the documentation and navigation integration for Moodle 4.0.5.
- Removes the declarative dependency on the Hooks API, which is not required in this version.
- Keeps the dashboard button in the header through the compatible local callback.

## 1.1.4-beta - 2026-08-19

- Maintains the **Manager** archetype's full access to all plugin-specific functions.
- Organizes PDF grades and comments in descending order by grade.
- Keeps responses without a valid grade at the end of the table.
- Highlights grades 9–10 in green, 7–8 in yellow, and 0–6 in red.
- Adds a visual classification legend to the PDF.
- Replaces the test logo with the provided **COLAB-ON** visual identity.
- Slightly increases the logo area in the PDF header.
- Does not change the NPS calculation, stored data, web dashboard, or compatibility with Moodle 4.4 and 4.5.

## 1.1.3-beta - 2026-08-19

- Removes the attempt to insert access into the **More** menu, which is not consistently displayed by some themes in Moodle 4.4.
- Adds **Open NPS Dashboard** as a native action in the header of the Feedback activity.
- The button is available in Feedback, Settings, Templates, Analysis, and Responses, only for authorized users.
- Removes the JavaScript used to reposition the button on the Analysis page.
- Does not change the NPS calculation, general dashboard, PDF, permissions, or data.
- Maintains compatibility with Moodle 4.4 and 4.5.

## 1.1.2-beta - 2026-08-19

- Fixes contextual access in Moodle 4.4.
- The **Open NPS Dashboard** item is now added directly to the Feedback activity settings navigation, allowing Moodle to position it in the **More** menu.
- Maintains compatibility with Moodle 4.4 and 4.5.

## 1.1.1-beta — 2026-08-19

- Adds declared compatibility with Moodle 4.4 and Moodle 4.5.
- Lowers the minimum requirement to Moodle 4.4.0 (build 2024042200).
- Maintains access through the More menu, general dashboard, and PDF generation in both versions.

## 1.1.0-beta — 2026-08-19

- Fixes the capabilities component to `local/feedbackdashboard`.
- Fixes the language file names.
- Restricts default access to managers and administrators.
- Adds contextual access to the **More** menu of the Feedback activity.
- Adds a general dashboard under **Site administration → Reports**.
- Adds a privacy provider without its own data storage.
- Requires a complete NPS scale from 0 to 10.
- Fixes the installation package structure.