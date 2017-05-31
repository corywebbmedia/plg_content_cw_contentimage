<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/base.php');
require_once(JPATH_ROOT . '/plugins/content/cw_contentimage/helpers/category.php');

/**
 * Content helper for cw_contentimage
 */
class PlgCwContentImageArticleHelper extends PlgCwContentImageBaseHelper
{

    /**
     * Get the item
     *
     * @return   PlgCwContentImageItem
     */
    public function getItem()
    {
        $article = $this->getArticle();
        
        $category_helper = new PlgCwContentImageCategoryHelper($this->params, $this->item);
        $category_helper->setId($article->catid);
        $categoryitem = $category_helper->getItem();

        $this->item = $this->getArticleItem($article);

        switch ($this->params->get('article_image')) {
            case 'category':
                if($categoryitem->getImage())
                {
                    $this->item->setImage($categoryitem->getImage())
                               ->setAlt($categoryitem->getAlt());
                }
                break;

            case 'default':
                $this->item->setImage($this->item->getDefaultImage())
                           ->setAlt($this->item->getDefaultAlt());
                break;
        }

        if(!$this->item->getImage())
        {
            if($this->params->get('article_no_image') == 'category')
            {
                if($categoryitem->getImage())
                {
                    $this->item->setImage($categoryitem->getImage())
                               ->setAlt($categoryitem->getAlt());
                }
            }
            elseif($this->params->get('article_no_image') == 'default')
            {
                $this->item->setImage($this->item->getDefaultImage())
                           ->setAlt($this->item->getDefaultAlt());
            }
        }

        return $this->item;
    }

    private function getArticle()
    {
        $this->getId();

        $article = JTable::getInstance("content");
        $article->load($this->id);

        return $article;
    }

    private function getArticleItem($article)
    {

        $articleitem = new PlgCwContentImageItem($this->params);

        $articleitem->setTitle($article->title);

        $images = json_decode($article->images);

        // Set image and title variables only if this article has a fulltext image.
        if($this->params->get('article_image') == 'article')
        {
            if ($images->image_fulltext)
            {
                $articleitem->setImage($images->image_fulltext);
            }
            if ($images->image_fulltext_alt)
            {
                $articleitem->setAlt($images->image_fulltext_alt);
            }
        }
        elseif($this->params->get('article_image') == 'article_intro')
        {
            if ($images->image_intro)
            {
                $articleitem->setImage($images->image_intro);
            }
            if ($images->image_intro_alt)
            {
                $articleitem->setAlt($images->image_intro_alt);
            }
        }

        return $articleitem;

    }

}