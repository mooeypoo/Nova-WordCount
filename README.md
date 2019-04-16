# WordCount extension for Nova2
Display a word and character count next to mission posts, and warn the writers if the post is over a certain set limit.

# Installation
1. Download the extension files.
2. Place the extension files in `nova/application/extensions/WordCount`
3. If you're using ExtensionManager, go to your Control Panel, click on "Extension Management" and enable the WordCount extension.
4. If you're not using ExtensionManager, paste the following code into `nova/config/extensions.php`:
```
$config['extensions']['enabled'][] = 'WordCount';
```

# Usage
The extension will automatically display a word and character count in the mission post editor.

If you want to display a specific message to your writers, reminding them to split certain posts, you have to set the limit in your settings.

Go to your control panel, then "Settings". Choose "User-generated settings" tab, and find the two settings that start with "WordCount extension".

Set the two options as per your liking:
* `Word count limit` Set the word count limit, after which the message will display alongside the counts.
* `Message appearing when the word count is over the limit.` The text of the message that appears when the word count is above the limit.

## Bugs and feature requests
Please submit bugs or feature requests as issues to this repository.
