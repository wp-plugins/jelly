=== Jelly: A Simple Responsive Slideshow ===
Contributors: Lumne, bigbrother87
Tags: gallery, image, images, javascript, jquery, photo, responsive, slide show, slider, slideshow
Requires at least: 3.0.1
Tested up to: 4.2.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Jelly is a simple, responsive, WordPress slideshow.


== Description ==
Jelly is a simple, *responsive*, WordPress slideshow. It is minimalistic in style, lightweight, and easy to use. Jelly fills the horizontal space available and sets the height based on the first image displayed.

== Features ==
Jelly comes equipped with several practical features that make it easy-to-use, flexible, and the right choice for your WordPress website.

*	Image slides
*	Responsive
*	Minimalistic and light weight
*	Easy installation
*	Intuitive user interface
*	Multiple display methods (shortcode in a post, or hard-coded in your template)
*	Adjustable slide pause and transition speed
*	No limit to how many images your Jelly slideshow can hold

==Installation==

**Method 1 (recommended):**

1.	Click Plugins -> Add New. The Search page will automatically appear.
1.	Search for “Jelly”.
1.	Click “Install Now” beneath the plugin title.
1.	In the popup, select “OK” to the question “Are you sure?”.
1.	After the plugin installs correctly, click “Activate Plugin”.

**Method 2:**

1.	Download the ZIP file manually from WordPress.org or directly from our site, Lumne.net.
1.	Click Plugins -> Add New. The search page will automatically appear.
1.	Click “Upload”.
1.	Click “Browse” or “Choose File” and navigate to where you’ve saved the ZIP file.
1.	Click on the ZIP file and click OK.
1.	Click “Install Now”.
1.	After the plugin installs correctly, click “Activate Plugin”.

**Method 3:**

1.	Download the ZIP file manually from WordPress.org or directly from our site, Lumne.net.
1.	Unzip the files to a location on your local hard drive.
1.	Login to your site through an FTP client, such as FileZilla.
1.	Navigate to /wp-content/plugins/.
1.	Upload the jelly folder from the local location to the plugins folder.
1.	Navigate to Plugins -> Installed Plugins.
1.	Find the Jelly plugin in the list of installed plugins.
1.	Click “Activate” below the title.

### Setting up Jelly:

*	Click Settings -> Jelly Settings.
*	Choose the length of time to display each slide and the speed of the transition between slides in milliseconds (1000 = 1 second).
*	Click “New Image”.
*	Use the WordPress Media Library to choose and/or upload a new image.
*	Select the desired image and click “Choose Image”.
*	If you would like the image to be clickable, insert a link in the box beside the thumbnail.
*	To remove an image, click the black ‘X’ next to the link box.

### Displaying Jelly on a page/post:
To display ony the first image, insert the shortcode [jelly]. To display multiple images with a sliding transition, include the “active” keyword: [jelly active].

### Inserting Jelly in a template:
Use the function do_shortcode() in your PHP with the argument ‘[jelly]‘ for a static image, or ‘[jelly active]‘ for multiple images with a sliding transition.

== Screenshots ==

1.	Images move fluidly from left to right.
2.	See all your settings on one easy-to-use page.

== Frequently Asked Questions ==

= Why is my Jelly Slideshow loading slow? =
You may experience slowness in Jelly for a few reasons:

*	Too many images? - While Jelly Slideshow doesn't limit the number of images in a slideshow, you should be respectful of your visitors' internet connections. You may think you need to display 50 images, but your visitors may not wait until all those images load. This applies to the entire page, not just your Lumne Slideshow. More images means more time a visitor has to wait before being able to view your web site.
*	Slow internet connection? - Like the previous point, please be cognizant of your users' internet connections. If your site is primarily viewed by users on desert islands, in rural areas, or using dial-up connections, you need to keep that in mind when adding dozens of images on a single page.
*	Old computer? - Our plugin, as with many other plugins, relies on Javascript. Older computers may have speed issues when processing everything needed to make Jelly Slideshow work. If you run into speed issues, try temporarily disabling one plugin at a time until the issue goes away. If it turns out to be Jelly Slideshow causing the issue, please let us know. We strive to make Jelly Slideshow work on a wide variety of devices, but we haven't tested it on your web site! Who knows, you may discover a bug and get your name in the next release!

#### What questions do you have?

== Upgrade Notice ==

How did you upgrade? This is the first release!

== Changelog ==

= 1.0 =
* Initial release.
