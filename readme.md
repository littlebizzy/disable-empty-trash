# Disable Empty Trash

Stops WordPress emptying trash

## Changelog

### 2.2.0
- removed speculative `empty_trash_days` option filters because WordPress core never queries those options; they could only affect arbitrary third-party code and were not based on a real compatibility requirement
- kept removal of WordPress core's `wp_scheduled_delete` callback, which disables automatic trash cleanup regardless of the `EMPTY_TRASH_DAYS` value
- kept the early `init` hook that runs `disable_empty_trash_scheduler()`
- cleaned up inline code comments for clarity
- `Tested up to:` bumped to 7.0

### 2.1.0
- added speculative `empty_trash_days` option filters as an attempted retention fallback
- retained scheduler unhooking for automatic cleanup prevention
- refactored functions for clearer separation of policy vs. scheduler logic
- `Tested up to:` bumped to 6.9

### 2.0.3
- added `Tested up to` header
- added `Update URI` header
- added `Text Domain` header
- minor code optimization

### 2.0.2
- added `Requires PHP` header
- added "prevent direct access" snippet
- improved `gu_override_dot_org` snippet

### 2.0.1
- fix `gu_override_dot_org` snippet

### 2.0.0
- code totally refactored to WordPress standards
- supports PHP 7.0 to PHP 8.3
- works fine in Multisite

### 1.1.0
- Git Updater support
- disable wordpress.org updates

### 1.0.0
- initial release