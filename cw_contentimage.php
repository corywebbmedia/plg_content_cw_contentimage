<?php
/**
 * @copyright   Copyright (C) 2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/item.php');
require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/article.php');
require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/category.php');
require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/contact.php');
require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/tag.php');

/**
 * Joomla! SEF Plugin.
 *
 * @since  1.5
 */
class PlgContentCw_contentimage extends JPlugin
{
    /**
     * Plugin that replaces the {show_image} shortcode with the current article's image
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   object   &$row     The article object.  Note $article->text is also available
     * @param   mixed    &$params  The article params
     * @param   integer  $page     The 'page' number
     *
     * @return  mixed  Always returns void or true
     *
     * @since   1.6
     */
    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();

        $shortcode = '{show_image}';
        $title_shortcode = '{show_title}';

        // Do not run in the administrator
        if ($app->getName() != 'site')
        {
            return;
        }

        if (empty($row->text))
        {
            return;
        }

        if (!strstr($row->text, $shortcode))
        {
            return;
        }

        $layout = $this->params->get('layout', 'default');

        $item = $this->getItem($this->params);

        $image = $item->getImage();
        $alt   = htmlspecialchars($item->getAlt());
        $title = $item->getTitle();

        $path = JPluginHelper::getLayoutPath('content', 'cw_contentimage', $layout);

        $show_image = '';

        ob_start();
        include $path;
        $show_image = ob_get_clean();

        $row->text = str_replace($shortcode, $show_image, $row->text);
        $row->text = str_replace($title_shortcode, $title, $row->text);

    }

    /**
     * Build up an array of meta data that can be json_encoded and output
     * directly to the page
     *
     * @param $data
     * @return array
     */
    public function onWbampGetJsonldData($context, &$rawJsonLd, $request, $data)
    {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();

        if ('com_content' != $context)
        {
            return true;
        }

        // Do not run in the administrator
        if ($app->getName() != 'site')
        {
            return true;
        }

        // start with current
        $jsonld = $rawJsonLd;

        try
        {
            // find article data
            $view = $request->getCmd('view');
            $task = $request->getCmd('task');
            $id = $request->getInt('id');
            if ($view == 'article' && !empty($id) && empty($task))
            {
                if (empty($jsonld['image']))
                {
                    $item = $this->getItem($this->params);

                    $image = $item->getImage();

                    if (!empty($image))
                    {
                        $dimensions = ShlHtmlContent_Image::getImageSize($image);
                        $jsonld['image'] = array(
                            '@type' => 'ImageObject',
                            'url' => ShlSystem_Route::absolutify($image, true),
                            'width' => $dimensions['width'],
                            'height' => $dimensions['height']

                        );
                    }
                }
            }

            //update with our changes
            $rawJsonLd = $jsonld;
        }
        catch (Exception $e)
        {
            ShlSystem_Log::error('wbamp', __METHOD__ . ' ' . $e->getMessage());
        }

        return true;
    }


    /**
     * Get the item to be displayed: image, title, alt
     *
     * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
     *
     * @return  PlgCwContentImageItem
     *
     */
    public static function getItem(&$params)
    {
        $app       = JFactory::getApplication();
        $option    = $app->input->get('option');
        $view      = $app->input->get('view');

        switch ($option) {
            case 'com_content':
                if($view == 'categories' || $view == 'category')
                {
                    $category_helper = new PlgCwContentImageCategoryHelper($params);
                    $item = $category_helper->getItem();
                }
                elseif($view == 'article')
                {
                    $article_helper = new PlgCwContentImageArticleHelper($params);
                    $item = $article_helper->getItem();
                }
                else
                {
                    $item = $this->getOtherPageItem($params);
                }
                break;

            case 'com_contact':
                if($view == 'categories' || $view == 'category')
                {
                    $category_helper = new PlgCwContentImageCategoryHelper($params);
                    $item = $category_helper->getItem();
                }
                elseif($view == 'contact')
                {
                    $contact_helper = new PlgCwContentImageContactHelper($params);
                    $item = $contact_helper->getItem();
                }
                else
                {
                    $item = $this->getOtherPageItem($params);
                }
                break;

            case 'com_tags':
                if($view == 'tags' || $view == 'tag')
                {
                    $tag_helper = new PlgCwContentImageTagHelper($params);
                    $item = $tag_helper->getItem();
                }
                else
                {
                    $item = $this->getOtherPageItem($params);
                }
                break;
            default:
                $item = $this->getOtherPageItem($params);
                break;
        }

        return $item;

    }

    /**
     * Get the item for a page other than the ones pre-defined
     *
     * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
     *
     * @return  PlgCwContentImageItem
     *
     */
    private static function getOtherPageItem(&$params)
    {
        $item = new PlgCwContentImageItem($params);

        if($params->get('other_image') == 'default')
        {
            $item->setToDefault();
        }

        return $item;
    }

}
