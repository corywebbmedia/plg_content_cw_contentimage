<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/base.php');

/**
 * Tags helper for cw_contentimage
 */
class PlgCwContentImageTagHelper extends PlgCwContentImageBaseHelper
{

    /**
     * Get the item
     *
     * @return   PlgCwContentImageItem
     */
    public function getItem()
    {
        $this->getId();

        $tag = JTable::getInstance('Tag', 'TagsTable');
        $tag->load($this->id);

        $this->item = new PlgCwContentImageItem($this->params);

        $images = json_decode($tag->images);

        $this->item->setTitle($tag->title);

        if($images)
        {
            // Set image and title variables only if this article has a fulltext image.
            if ($images->image_fulltext)
            {
                $this->item->setImage($images->image_fulltext);
            }
            if ($images->image_fulltext_alt)
            {
                $this->item->setAlt($images->image_fulltext_alt);
            }
        }

        if($this->params->get('tag_image') == 'default') {
            $this->item->setImage($this->item->getDefaultImage())
                       ->setAlt($this->item->getDefaultAlt());
        }

        if(!$this->item->getImage())
        {
            if($this->params->get('tag_no_image') == 'default')
            {
                $this->item->setImage($this->item->getDefaultImage())
                           ->setAlt($this->item->getDefaultAlt());
            }
        }

        return $this->item;

    }

    /**
     * Get the ID
     *
     * @return  integer
     */
    public function getId()
    {
        if($this->id !== 0)
            return $this->id;

        $app = JFactory::getApplication();

        if($app->input->get('view') == 'tags')
        {
            $this->id = $app->input->get('parent_id', 0);
        }
        else
        {
            $ids = $app->input->get('id');
            if(count($ids))
            {
                $this->id = $ids[0];
            }
            else
            {
                $this->id = 0;
            }
        }
    }

}