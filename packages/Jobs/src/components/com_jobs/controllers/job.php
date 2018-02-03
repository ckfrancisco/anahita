<?php

/**
 * Job Controller.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComJobsControllerJob extends ComMediumControllerDefault
{
    /**
     * The max upload limit.
     *
     * @var int
     */
    protected $_max_upload_limit;

    /**
     * Constructor.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        $this->_max_upload_limit = $config->max_upload_limit;
    }

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
            'max_upload_limit' => get_config_value('jobs.uploadlimit', 2),
        ));

        parent::_initialize($config);
    }

    /**
     * Browse Jobs.
     *
     * @param KCommandContext $context
     */
    protected function _actionBrowse($context)
    {
        $this->getService('repos:jobs.set');
        $jobs = parent::_actionBrowse($context);
        $jobs->order('creationTime', 'DESC');

        if ($this->exclude_set != '') {
            $set = $this->actor->sets->fetch(array('id' => $this->exclude_set));

            if (!empty($set)) {
                $job_ids = array();

                foreach ($set->jobs as $job) {
                    $job_ids[] = $job->id;
                }

                if (count($job_ids)) {
                    $jobs->where('job.id', '<>', $job_ids);
                }
            }
        }

        return $jobs;
    }

    /**
     * Method to upload and Add a job.
     *
     * @param KCommandContext $context
     */
    protected function _actionAdd($context)
    {
        $data = $context->data;
        $file = KRequest::get('files.file', 'raw');
        $content = @file_get_contents($file['tmp_name']);
        $filesize = strlen($content);
        $uploadlimit = $this->_max_upload_limit * 1024 * 1024;

        $exif = (function_exists('exif_read_data')) ? @exif_read_data($file['tmp_name']) : array();

        if ($filesize == 0) {
            throw new LibBaseControllerExceptionBadRequest('File is missing');

            return;
        }

        if ($filesize > $uploadlimit) {
            throw new LibBaseControllerExceptionBadRequest('Exceed maximum size');

            return;
        }

        $orientation = 0;

        if (!empty($exif) && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
        }

        $data['portrait'] = array(
            'data' => $content,
            'rotation' => $orientation,
            'mimetype' => isset($file['type']) ? $file['type'] : null,
        );

        $job = $this->actor->jobs->addNew($data);
        $job->setExifData($exif);
        $job->save();
        $this->setItem($job);
        $this->getResponse()->status = KHttpResponse::CREATED;

        if ($job->body && preg_match('/\S/', $job->body)) {
            $context->append(array(
                'story' => array('body' => $job->body),
            ));
        }

        return $job;
    }
}
