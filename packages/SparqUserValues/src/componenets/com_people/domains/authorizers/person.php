<?php

/**
 * Person Entity Authorizer.
 *
 * @category   Anahita
 *
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComSparqUserValuesDomainAuthorizerPerson extends ComActorsDomainAuthorizerDefault
{
    /**
     * Check to see if viewer has permission to change usertype.
     */
    protected function _authorizeChangeAcademic(KCommandContext $context)
    {
        if ($this->_entity->eql($this->_viewer)) {
            return false;
        }

        if ($this->_viewer->superadmin()) {
            return true;
        }

        if ($this->_viewer->admin() && !$this->_entity->superadmin()) {
            return true;
        }

        return false;
    }

    protected function _authorizeChangeCorporate(KCommandContext $context)
    {
        if ($this->_entity->eql($this->_viewer)) {
            return false;
        }

        if ($this->_viewer->superadmin()) {
            return true;
        }

        if ($this->_viewer->admin() && !$this->_entity->superadmin()) {
            return true;
        }

        return false;
    }
}
