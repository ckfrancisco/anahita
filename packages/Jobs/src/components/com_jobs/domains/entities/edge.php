<?php

/**
 * Set Job Edge.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComJobsDomainEntityEdge extends ComBaseDomainEntityEdge
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
            'aliases' => array(
                'job' => 'nodeA',
                'set' => 'nodeB',
            ),
            'attributes' => array(
                'ordering',
            ),
        ));

        parent::_initialize($config);
    }

    /**
     * After adding a relationship, set the job count for the set;.
     *
     * KCommandContext $context Context
     */
    protected function _afterEntityInsert(KCommandContext $context)
    {
        $this->set->setValue('job_count', $this->set->jobs->reset()->getTotal());
    }

    /**
     * After deleting a relationship, set the job count for the set;.
     *
     * KCommandContext $context Context
     */
    protected function _afterEntityDelete(KCommandContext $context)
    {
        $total = $this->set->jobs->reset()->getTotal();

        if ($total > 0) {
            $this->set->setValue('job_count', $this->set->jobs->reset()->getTotal());
        } else {
            $this->set->delete();
        }
    }

//end class
}
