<?php

/**
 * Plugins Settings Controller.
 *
 * @category   Anahita
 *
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008-2016 rmd Studio Inc.
 * @license    GNU GPLv3
 *
 * @link       http://www.GetAnahita.com
 */

class ComSettingsControllerPlugin extends ComBaseControllerService
{
    /**
     * Initializes the default configuration for the object.
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
             'behaviors' => array('serviceable' => array('read_only' => true)),
             'request' => array(
                'sort' => 'name',
             ),
        ));

        parent::_initialize($config);
    }

    protected function _actionGet(KCommandContext $context)
    {
        $title = JText::_('COM-SETTINGS-HEADER-PLUGINS');

        $this->getToolbar('menubar')->setTitle($title);

        return parent::_actionGet($context);
    }

    /**
    *   browse service
    *
    *  @param KCommandContext $context Context Parameter
    *  @return void
    */
    protected function _actionBrowse(KCommandContext $context)
    {
        $entities = parent::_actionBrowse($context);

        $entities->order($this->sort);

        return $entities;
    }

    protected function _actionOrder(KCommandContext $context)
    {
        $plugins = $this->getRepository()->fetchSet(array(
          'id' => KConfig::unbox($this->id)
        ));

        $plugins->setData(KConfig::unbox($context->data));
        $plugins->save();
    }
}
