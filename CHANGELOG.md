# Sunset to Sunset Changelog

## 1.4.2 - 2019-03-06
### Fixed
* Plugin was not redirecting during the week causing some users to continue seeing the sabbath template during the week. This has now been fixed.

## 1.4.1 - 2018-10-19
### Fixed
* `showBannerOnSpecificUrls` setting will now be disabled when set via the config file.

## 1.4.0 - 2018-10-19
### Added
* Banner can be set to only show on urls set in the `specificRedirectUrls`. This way it only gives the message to those visiting the pages that will be closed on the Sabbath.

### Improved
* Plugin now has it’s own section in the control panel.
* Updated the display of several of the input fields in the settings.
* Template redirect settings now has it’s own settings page.

## 1.3.0 - 2018-10-12
### Added
* Plugin now has the option to only redirect when the requested url starts with one of the user-specified redirect urls. Before it would redirect everything. This is still possible if no specific redirect urls are added.

## 1.2.2 - 2018-10-12
### Improved
* Banner is now set to `width: 100%;` when `position` is `fixed`.

### Changed
* Banner message now uses a text field instead of textarea field to encourage a short message. Full message can be added in the **Full Message** settings input.

## 1.2.1 - 2018-10-07
### Fixed
* Render service was sending the wrong variable name. This has been corrected.

## 1.2.0 - 2018-10-07
### Added
* Ability to set `position` and `background-color` for banner.
* An additional message can now be set that can be used on the `templateRedirect` page.
* The **Simulate Time** setting allows you to simulate how the plugin would function before, during, and after the Sabbath.
* Breadcrumb navigation to the settings pages.

### Improved
* Clarified setting instructions for the banner message.
* All settings tabs have been updated to use the `fullPageForm`. The **Save** button is now in the top right of each page.

## 1.1.0 - 2018-09-12
### Added
* More timezones to choose from. Only US timezones listed at the moment.

### Improved
* Set default timezone
* Plugin settings can now be set via a config file in `craft/config/sunsettosunset.php`.

### Fixed
* Replaced utility first classes on front-end templates with component classes.

### Changed
* The `latitude` and `longitude` fields are now required.

## 1.0.2 - 2018-09-04
* Corrected all misspellings of `guard`

## 1.0.1 - 2018-09-04
### Fixed
* Typo in the `defineSettings` function."

### Improved
* More succinct handling of public functions"
* Updated the README.md"

## 1.0.0 - 2017-08-09
* Initial release

Brought to you by [Cavell L. Blood](https://cavellblood.com)
