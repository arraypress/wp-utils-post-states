# WordPress Post States Manager Library

This powerful library streamlines the process of extending the default post information with additional, dynamic labels, providing a crystal-clear overview of your content's various statuses at a glance.

With the WordPress Post States Manager Library, you can effortlessly designate and display bespoke indicators next to your posts, such as "Landing Page", "Featured Article", or any custom state you define. This enhancement not only adds a layer of quick visual reference to your post list but also improves content management workflows, making it simpler and faster for administrators and editors to identify and sort content based on these states.

## Installation and set up

The extension in question needs to have a `composer.json` file, specifically with the following:

```json 
{
  "require": {
    "arraypress/wp-utils-post-states": "*"
  },
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/arraypress/wp-post-states-manager"
    }
  ]
}
```

Once set up, run `composer install --no-dev`. This should create a new `vendors/` folder
with `arraypress/wp-utils-post-states/` inside.

## Managing Custom Post States in WordPress

The `Post_States_Manager` class offers a streamlined way to manage and display custom post states within the WordPress admin area. It provides a simple interface for adding custom labels next to post titles in the admin posts list, allowing you to quickly identify specific properties of your posts such as "Landing Page" or "Featured Article."

### Example Usage

To utilize this functionality, you first define an associative array that maps option keys to labels for the post states. You can optionally specify a callable function responsible for retrieving option values, such as WordPress' built-in `get_option` function. Here's how you can set it up:

```php
require_once dirname(__FILE__) . '/vendor/autoload.php';

$options_map = [
    'landing_page' => __('Landing Page', 'text-domain'),
    'featured_post' => __('Featured Post', 'text-domain'),
    // Add other custom states as needed
];

register_post_states( $options_map, 'get_option', function( $exception ) {
    // Handle errors, e.g., log to a file or send an email
});
```

When the `Post_States_Manager` is initialized with the provided options, it hooks into WordPress' `'display_post_states'` filter. This integration allows it to append the custom state labels to the appropriate posts in the admin list view, based on the configuration provided.

### Error Handling

The `register_post_states` function also accepts a third parameter: an error callback function. This callback is invoked if an exception occurs during the initialization of the `Post_States_Manager`. This allows for graceful handling of initialization errors and ensures a smooth user experience.

```php
register_post_states($options_map, 'get_option', function($exception) {
    // Custom error handling logic goes here
});
```

By integrating `Post_States_Manager`, you can enhance the content management capabilities of your WordPress site, providing a more informative and efficient admin panel for your users.

## Contributions

Contributions to this library are highly appreciated. Raise issues on GitHub or submit pull requests for bug
fixes or new features. Share feedback and suggestions for improvements.

## License

This library is licensed under
the [GNU General Public License v2.0](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html).