<?php

/**
 * Album Controller.
 *
 * @category   Sparq
 *
 * @author     Peter Qafoku
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComDocumentsControllerSet extends ComMediumControllerDefault
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
            'before.adddocument',
            'before.removedocument',
            'before.updatedocument',
        ),
        array($this, 'fetchDocument'));

        $this->registerCallback(array(
          'after.adddocument',
          'after.removedocument',
          'after.updatedocument',
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

        if ($this->document_id && $this->getRequest()->get('layout') != 'selector') {
            $sets->where('document.id', '=', $this->document_id);
        }

        return $sets;
    }

    protected function _actionUpdatedocuments($context)
    /**
     * Updates the documents in a set given an array of ids.
     *
     * @param object POST data
     *
     * @return object ComDocumentsDomainEntitySet
     */
    {
        $this->execute('adddocument', $context);
        $document_ids = (array) KConfig::unbox($context->data->document_id);

        foreach ($this->getItem()->documents as $document) {
            if (!in_array($document->id, $document_ids)) {
                $this->getItem()->removeDocument($document);
            }
        }

        return $this->getItem();
    }

    /**
     * Reorders the documents in a set in respect with the order of ids.
     *
     * @param object POST data
     *
     * @return object ComDocumentsDomainEntitySet
     */
    protected function _actionReorder($context)
    {
        $document_ids = (array) KConfig::unbox($context->data->document_id);
        $this->getItem()->reorder($document_ids);

        return $this->getItem();
    }

    /**
     * Adds a documents to an set.
     *
     * @return object ComDocumentsDomainEntitySet
     *
     * @param object POST data
     */
    protected function _actionAdddocument($context)
    {
        $this->getItem()->addDocument($this->document);
        $context->response->setRedirect(route($this->getItem()->getURL()));

        return $this->getItem();
    }

    /**
     * Removes a list of documents from an set.
     *
     * @return object ComDocumentsDomainEntitySet
     *
     * @param object POST data
     */
    protected function _actionRemovedocument($context)
    {
        $lastDocument = ($this->getItem()->document->getTotal() > 1) ? false : true;
        $this->getItem()->removeDocument($this->document);

        if ($lastDocument) {
            $this->getResponse()->status = 204;

            return;
        } else {
            return $this->getItem();
        }
    }

    /**
     * Fetches a document object given document_id as a GET request.
     *
     * @param object POST data
     */
    public function fetchDocument(KCommandContext $context)
    {
        $data = $context->data;

        $data->append(array(
            'document_id' => $this->document_id,
        ));

        $document_id = (array) KConfig::unbox($data->document_id);

        if (!empty($document_id)) {
            $document = $this->actor->document->fetchSet(array('id' => $document_id));

            if (count($document) === 0) {
                $document = null;
            }

            $this->documents = $this->document = $document;
        }

        return $this->document;
    }

    /**
     * Fetches an entity.
     *
     * @param object POST data
     */
    public function fetchEntity(KCommandContext $context)
    {
        if ($context->action == 'adddocument') {
            if ($context->data->id) {
                $this->id = $context->data->id;
            }

            //clone the context so it's not touched
            $set = $this->__call('fetchEntity', array($context));

            if (!$set) {
                $context->setError(null);
                //if the action is addphoto and there are no sets then create an set
                $set = $this->add($context);
            }

            return $set;
        } else {
            return $this->__call('fetchEntity', array($context));
        }
    }
}
