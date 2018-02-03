<?php

/**
 * Set Entity.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComJobsDomainEntitySet extends ComMediumDomainEntityMedium
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
            'attributes' => array(
                'name' => array('required' => true),
            ),
            'behaviors' => array(
                'hittable',
            ),
            'relationships' => array(
                'jobs' => array('through' => 'edge'),
            ),
        ));

        parent::_initialize($config);
    }

    /**
     * Obtains the image file source.
     *
     * @return string path to image source
     *
     * @param $size job size. One of the constan sizes in the ComJobsDomainEntityJob class
     */
    public function getCoverSource($size = ComJobsDomainEntityJob::SIZE_SQUARE)
    {
        $cover = $this->jobs->order('jobSets.ordering')->fetch();
        $filename = $cover->filename;

        //get file extension
        $extension = explode('.', $filename);
        $extension = array_pop($extension);

        //remove file extension
        $name = preg_replace('#\.[^.]*$#', '', $filename);
        $filename = $name.'_'.$size.'.'.$extension;

        return $this->owner->getPathURL('com_jobs/'.$filename);
    }

    /**
     * Adds a job to a set.
     *
     * @return true on success
     *
     * @param $job a ComJobsDomainEntityJob object
     */
    public function addJob($job)
    {
        $jobs = AnHelperArray::getIterator($job);

        foreach ($jobs as $job) {
            if (!$this->jobs->find($job)) {
                $this->jobs->insert($job, array(
                     'author' => $job->author,
                ));
            }
        }
    }

    /**
     * Removes a job or list of jobs from the set.
     *
     * @param $job a ComJobsDomainEntityJob object
     */
    public function removeJob($job)
    {
        $jobs = AnHelperArray::getIterator($job);

        foreach ($jobs as $job) {
            if ($edge = $this->jobs->find($job)) {
                $edge->delete();
            }
        }
    }

    /**
     * Orders the jobs in this set.
     *
     * @param array $job_ids
     */
    public function reorder($job_ids)
    {
        if (count($job_ids) == 1) {
            if ($edge = $this->getService('repos:jobs.edge')
                              ->fetch(array(
                                        'set' => $this,
                                        'job.id' => $job_ids[0],
                                      ))
            ) {
                $edge->ordering = $this->jobs->getTotal();
            }

            return;
        }

        foreach ($job_ids as $index => $job_id) {
            if ($edge = $this->getService('repos:jobs.edge')
                             ->fetch(array(
                                      'set' => $this,
                                      'job.id' => $job_id, ))
            ) {
                $edge->ordering = $index + 1;
            }
        }
    }

    /**
     * Gets number of jobs in this set.
     *
     * @return int value
     */
    public function getJobCount()
    {
        return $this->getValue('job_count', 0);
    }
}
