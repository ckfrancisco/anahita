<?php

/**
 * Album Controller.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComJobsControllerSet extends ComMediumControllerDefault
{
    /**
     * Constructor.
     *
     * @param 	object 	An optional KConfig object with configuration options
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->registerCallback(array(
            'before.browse',
            'before.read',
            'before.add',
            'before.addjob',
            'before.removejob',
            'before.updatejobs',
            'before.updatecover',
        ),
        array($this, 'fetchJob'));

        $this->registerCallback(array(
          'after.addjob',
          'after.removejob',
          'after.updatejobs',
        ),
        array($this, 'reorder'));
    }

    /**
     * Browse Albums.
     */
    protected function _actionBrowse($context)
    {
        $sets = parent::_actionBrowse($context);
        $sets->order('updateTime', 'DESC');

        if ($this->job_id && $this->getRequest()->get('layout') != 'selector') {
            $sets->where('jobs.id', '=', $this->job_id);
        }

        return $sets;
    }

    /**
     * Updates the jobs in a set given an array of ids.
     *
     * @param object POST data
     *
     * @return object ComJobsDomainEntitySet
     */
    protected function _actionUpdatejobs($context)
    {
        $this->execute('addjob', $context);
        $job_ids = (array) KConfig::unbox($context->data->job_id);

        foreach ($this->getItem()->jobs as $job) {
            if (!in_array($job->id, $job_ids)) {
                $this->getItem()->removeJob($job);
            }
        }

        return $this->getItem();
    }

    /**
     * Reorders the jobs in a set in respect with the order of ids.
     *
     * @param object POST data
     *
     * @return object ComJobsDomainEntitySet
     */
    protected function _actionReorder($context)
    {
        $job_ids = (array) KConfig::unbox($context->data->job_id);
        $this->getItem()->reorder($job_ids);

        return $this->getItem();
    }

    /**
     * Adds a jobs to an set.
     *
     * @return object ComJobsDomainEntitySet
     *
     * @param object POST data
     */
    protected function _actionAddjob($context)
    {
        $this->getItem()->addJob($this->job);
        $context->response->setRedirect(route($this->getItem()->getURL()));

        return $this->getItem();
    }

    /**
     * Removes a list of jobs from an set.
     *
     * @return object ComJobsDomainEntitySet
     *
     * @param object POST data
     */
    protected function _actionRemovejob($context)
    {
        $lastJob = ($this->getItem()->jobs->getTotal() > 1) ? false : true;
        $this->getItem()->removeJob($this->job);

        if ($lastJob) {
            $this->getResponse()->status = 204;

            return;
        } else {
            return $this->getItem();
        }
    }

    /**
     * Fetches a job object given job_id as a GET request.
     *
     * @param object POST data
     */
    public function fetchJob(KCommandContext $context)
    {
        $data = $context->data;

        $data->append(array(
            'job_id' => $this->job_id,
        ));

        $job_id = (array) KConfig::unbox($data->job_id);

        if (!empty($job_id)) {
            $job = $this->actor->jobs->fetchSet(array('id' => $job_id));

            if (count($job) === 0) {
                $job = null;
            }

            $this->jobs = $this->job = $job;
        }

        return $this->job;
    }

    /**
     * Fetches an entity.
     *
     * @param object POST data
     */
    public function fetchEntity(KCommandContext $context)
    {
        if ($context->action == 'addjob') {
            if ($context->data->id) {
                $this->id = $context->data->id;
            }

            //clone the context so it's not touched
            $set = $this->__call('fetchEntity', array($context));

            if (!$set) {
                $context->setError(null);
                //if the action is addjob and there are no sets then create an set
                $set = $this->add($context);
            }

            return $set;
        } else {
            return $this->__call('fetchEntity', array($context));
        }
    }
}
