<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT . '/modules/mod_cw_contentimage/helpers/item.php');
require_once(JPATH_ROOT . '/modules/mod_cw_contentimage/helpers/article.php');
require_once(JPATH_ROOT . '/modules/mod_cw_contentimage/helpers/category.php');
require_once(JPATH_ROOT . '/modules/mod_cw_contentimage/helpers/contact.php');
require_once(JPATH_ROOT . '/modules/mod_cw_contentimage/helpers/tag.php');

/**
 * Helper for mod_cw_contentimage
 */
class ModCwContentImageHelper
{
	/**
	 * Get the item to be displayed: image, title, alt
	 *
	 * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
	 *
	 * @return  ModCwContentImageItem
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
					$category_helper = new ModCwContentImageCategoryHelper($params);
					$item = $category_helper->getItem();
				}
				elseif($view == 'article')
				{
					$article_helper = new ModCwContentImageArticleHelper($params);
					$item = $article_helper->getItem();
				}
				else
				{
					$item = ModCwContentImageHelper::getOtherPageItem($params);
				}
				break;

			case 'com_contact':
				if($view == 'categories' || $view == 'category')
				{
					$category_helper = new ModCwContentImageCategoryHelper($params);
					$item = $category_helper->getItem();
				}
				elseif($view == 'contact')
				{
					$contact_helper = new ModCwContentImageContactHelper($params);
					$item = $contact_helper->getItem();
				}
				else
				{
					$item = ModCwContentImageHelper::getOtherPageItem($params);
				}
				break;

			case 'com_tags':
				if($view == 'tags' || $view == 'tag')
				{
					$tag_helper = new ModCwContentImageTagHelper($params);
					$item = $tag_helper->getItem();
				}
				else
				{
					$item = ModCwContentImageHelper::getOtherPageItem($params);
				}
				break;
			default:
				$item = ModCwContentImageHelper::getOtherPageItem($params);
				break;
		}

		return $item;

	}

	/**
	 * Get the item for a page other than the ones pre-defined
	 *
	 * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
	 *
	 * @return  ModCwContentImageItem
	 *
	 */
	private static function getOtherPageItem(&$params)
	{
		$item = new ModCwContentImageItem($params);

		if($params->get('other_image') == 'default')
		{
			$item->setToDefault();
		}

		return $item;
	}

}
