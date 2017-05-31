<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Item for cw_contentimage
 */
class PlgCwContentImageItem
{

    /**
     * Module parameters
     */
    protected $params;

    /**
     * Item title
     */
    protected $title = '';

    /**
     * Item image
     */
    protected $image = '';

    /**
     * Item alt
     */
    protected $alt = '';

    /**
     * Default title, image, and alt
     */
    protected $default = array();

    /**
     * Constructor for CW Content Image item
     *
     * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
     */
    public function __construct(&$params)
    {
        $this->params = $params;

        $this->defaults['image'] = $this->params->get('defaultimage');
        $this->defaults['alt'] = $this->params->get('defaultimage_alt');
        $this->defaults['title'] = $this->defaults['alt'];
    }

    /**
     * Set the title
     *
     * @param   string   $title    The item title
     *
     * @return  PlgCwContentImageItem
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set the image
     *
     * @param   string   $image    The item image
     *
     * @return  PlgCwContentImageItem
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Set the alt
     *
     * @param   string   $alt    The item alt
     *
     * @return  PlgCwContentImageItem
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * Set item to the default values
     *
     * @return   PlgCwContentImageItem
     */
    public function setToDefault()
    {
        $this->setTitle($this->defaults['title'])
             ->setImage($this->defaults['image'])
             ->setAlt($this->defaults['alt']);

        return $this;
    }

    /**
     * Get the title
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the image
     *
     * @return  string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the alt
     *
     * @return  string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Get default title
     *
     * @return   string
     */
    public function getDefaultTitle()
    {
        return $this->defaults['title'];
    }

    /**
     * Get default image
     *
     * @return   string
     */
    public function getDefaultImage()
    {
        return $this->defaults['image'];
    }

    /**
     * Get default alt
     *
     * @return   string
     */
    public function getDefaultAlt()
    {
        return $this->defaults['alt'];
    }

    /**
     * Return the item as an array
     *
     * @return   array
     */
    public function toArray()
    {
        $item_array = array();
        $item_array['title'] = $this->title;
        $item_array['image'] = $this->image;
        $item_array['alt'] = $this->alt;

        return $item_array;
    }

}