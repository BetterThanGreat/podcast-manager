# podcast-manager
A WordPress Plugin for managing a podcast series

This plugin creates a new post type, "Podcast" that can be used to manage audio episodes and distribute via an iTunes compliant XML feed.

The feed is automatically registered at `yoursite.com/podcast` upon activating the plugin

## Contributing

This plugin is open-source. Feel free to fork and create pull requests for feature additions you'd like added. 

## Limitations

- The plugin currently only supports hosting one _"show"_ per website; ie. all _episodes_ are created under one show, and rendered in the same feed
- The feed currently resides at `/podcast` on the site; attempting to utilize that path otherwise will cause conflicts
- MP3 (`audio/mpeg`) is currently the only supported file format.
