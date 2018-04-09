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
        $jobs = parent::_actionBrowse($context);
        $jobs->order('creationTime', 'DESC');

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

        if(empty($data->link))
        {
            unset($data->link);
        }

        if(empty($data->startDate))
        {
            unset($data->startDate);
        }

        if(empty($data->location))
        {
            unset($data->location);
        }

        if(empty($data->majors))
        {
            unset($data->majors);
        }

        if(empty(trim(strip_tags($data->body), " \t\n\r\0\x0B\xc2\xa0")))
        {
            unset($data->body);
        }

        if(empty($data->employment))
        {
            unset($data->employment);
        }

        if(empty($data->visa))
        {
            unset($data->visa);
        }

        $exif = (function_exists('exif_read_data')) ? @exif_read_data($file['tmp_name']) : array();

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

        return $job;
    }

    protected function _actionEdit($context)
    {
        $data = $context->data;
        $file = KRequest::get('files.file', 'raw');
        $content = @file_get_contents($file['tmp_name']);
        $filesize = strlen($content);
        $uploadlimit = $this->_max_upload_limit * 1024 * 1024;

        if(empty($data->link))
        {
            unset($data->link);
        }

        if(empty($data->startDate))
        {
            unset($data->startDate);
        }

        if(empty($data->location))
        {
            unset($data->location);
        }

        if(empty($data->majors))
        {
            unset($data->majors);
        }

        if(empty(trim(strip_tags($data->body), " \t\n\r\0\x0B\xc2\xa0")))
        {
            unset($data->body);
        }

        if(empty($data->employment))
        {
            unset($data->employment);
        }

        if(empty($data->visa))
        {
            unset($data->visa);
        }

        $exif = (function_exists('exif_read_data')) ? @exif_read_data($file['tmp_name']) : array();

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

        return parent::_actionEdit($context);

        return $job;
    }
}
