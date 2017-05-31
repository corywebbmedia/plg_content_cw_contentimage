<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/base.php');

/**
 * Categories helper for cw_contentimage
 */
class PlgCwContentImageCategoryHelper extends PlgCwContentImageBaseHelper
{

    /**
     * Get the item
     *
     * @return   PlgCwContentImageItem
     */
    public function getItem()
    {

        // Get the category ID
        $this->getId();

        // Load the category table
        $category = JTable::getInstance("category");
        $category->load($this->id);

        $catparams         = new JRegistry($category->params);

        $this->item = new PlgCwContentImageItem($this->params);

        $this->item->setTitle($category->title)
                   ->setImage($catparams->get('image'))
                   ->setAlt($catparams->get('image_alt'));

        if($this->params->get('category_image') == 'default')
        {
            $this->item->setImage($this->item->getDefaultImage())
                       ->setAlt($this->item->getDefaultAlt());
        }

        if(!$this->item->getImage())
        {
            if($this->params->get('category_no_image') == 'default')
            {
                $this->item->setImage($this->item->getDefaultImage())
                           ->setAlt($this->item->getDefaultAlt());
            }
        }

        return $this->item;
    }

}