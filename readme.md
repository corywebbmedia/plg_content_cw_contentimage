# CW Content Image Plugin for Joomla

CW Content Image is a module and plugin that display the image associated with the current page, whether the page is an article or category page, or if it is a tag page, separating the display of the page's content from the page's image.

By separating the display of the page's content from the page's image, CW Content Image enables you to more easily customize the layout of your site.

* Standard Joomla MVC structure
* Display an article's full text image anywhere on the article page separate from the component output
* Display a category's image anywhere on the category page separate from the component output
* Display a tag's image anywhere on the tag page separate from the component output
* Complete control over which image gets displayed through module parameters
* Set a default image to display if no article, category, or tag image is available
* Set which image displays on pages that are not an article, category, or tag page
* GPL License

## Documentation

### [CW Content Image Module](https://github.com/corywebbmedia/mod_cw_contentimage)

**Add a CW Content Image module to any page(s) on your site**

1. In the Joomla administrator, go to Extensions > Modules and click "New" to add a new module.
2. Select the CW Content Image module type.

**Parameters Explained**

* **Default Image:** Select or upload an image that will be displayed if no category or article image is available to be displayed.
* **Default Image Alt Text:** Enter text to be included in the img alt attribute if the default image is used.
* **Category Page Options:** Set the options for this module when renedered on a com_content category page view.
* **Category Page Image:** Select which image, if any, to display on the category page.
    * _No Image:_ Do not display an image.
    * _Category Image:_ Display the category image.
    * _Default image:_ Display the default image set above in the module parameters.
* **Category Page No Image:** Select which image, if any, to display on the category page if there is no category image.
    * _No Image:_ Do not display an image.
    * _Default image:_ Display the default image set above in the module parameters.
* **Article Page Options:** Set the options for this module when renedered on a com_content article page view.
* **Article Page Image:** Select which image, if any, to display on the article page.
    * _No Image:_ Do not display an image.
    * _Article Image_ Display the full article image.
    * _Category Image:_ Display the category image. If no category image exists, the default image will be displayed.
    * _Default image:_ Display the default image set above in the module parameters.
* **Article Page No Image:** Select which image, if any, to display on the article page if there is no full article image.
    * _No Image:_ Do not display an image.
    * _Category Image:_ Display the category image. If no category image exists, the default image will be displayed.
    * _Default image:_ Display the default image set above in the module parameters.
* **Tag Page Options:** Set the options for this module when renedered on a com_tags tag page view.
* **Tag Page Image:** Select which image, if any, to display on the tag page.
    * _No Image:_ Do not display an image.
    * _Tag Image:_ Display the tag full image.
    * _Default image:_ Display the default image set above in the module parameters.
* **Tag Page No Image:** Select which image, if any, to display on the tag page if there is no tag full image.
    * _No Image:_ Do not display an image.
    * _Default image:_ Display the default image set above in the module parameters.
* **Other Page Options:** Set the options for this module when renedered on all other pages.
* **Other Pages Image:** Select which image, if any, to display on all other pages.
    * _No Image:_ Do not display an image.
    * _Default image:_ Display the default image set above in the module parameters.

**Creating a Template Override**

If you want to override the standard layout, you have to create a template override as follows:

1. Copy `/modules/mod_cw_contentimage/default.php` to `/templates/{YOUR_TEMPLATE}/html/mod_cw_contentimage/default.php`
2. Modify as needed

_Note: If you want to have multiple template overrides, you can create multiple copies of `default.php`, but give it different names. Each new override will be available in as an option in the Alternate Layout parameter in the Advanced parameter tab in the module._
