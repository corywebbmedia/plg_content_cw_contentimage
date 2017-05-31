<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Base helper for cw_contentimage
 */
class PlgCwContentImageBaseHelper
{

    /**
     * Module parameters
     */
    protected $params;

    /**
     * Content image item
     */
    protected $item;

    /**
     * ID
     */
    protected $id = 0;

    /**
     * Constructor
     *
     * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
     * @param   PlgCwContentImageItem
     */
    public function __construct(&$params)
    {
        $this->params = $params;
    }

    /**
     * Get the item
     *
     * @return   PlgCwContentImageItem
     */
    public function getItem()
    {
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

        $this->id = $app->input->getInt('id', 0);
    }

    /**
     * Set the ID
     *
     * @param   integer   $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}