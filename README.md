# Inpsyde Test task
WordPress plugin which allows you to display information about users received from `https://jsonplaceholder.typicode.com/users` through the AJAX request
## Requirements
- PHP >= 7.4
## Installation
Download the release archive and unpack it in the plugins folder. Also you can just clone this repo into plugins folder. Then go to the admin panel in the `Plugins` tab and activate the plugin.
## Usage
When plugin is activated just visit `yourdomain.com/users-table` page. You will see a table with data, under the table there is more detailed information about the user. When you click on a value in the table, the detailed information is replaced with the information of the user that was clicked, which is loaded without reloading the page.
#### Change template
If you want change template. You can copy `templates/userstable.php` into `inpsyde-askerweb` folder in your theme.
### Filters
The plugin supports the following filters:
- `inpsydeaskerweb_page_link` - filter to change the endpoint
- `inpsydeaskerweb_empty_data` - filter to text when response data is empty
- `inpsydeaskerweb_response_error` - filter to text on error receiving data 