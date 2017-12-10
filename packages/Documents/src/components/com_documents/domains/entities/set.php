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
class ComDocumentsDomainEntitySet extends ComMediumDomainEntityMedium
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
            'relationships' => array(   //todo i think relationships needs to be updated
                'documents' => array('through' => 'edge'),
            ),
        ));

        parent::_initialize($config);
    }

    /**
     * Obtains the image file source.
     *
     * @return string path to image source
     *
     * @param $size photo size. One of the constan sizes in the ComPhotosDomainEntityPhoto class
     */


     //todo dont think we need this

    // public function getCoverSource($size = ComPhotosDomainEntityPhoto::SIZE_SQUARE)
    // {
    //     $cover = $this->photos->order('photoSets.ordering')->fetch();
    //     $filename = $cover->filename;
    //
    //     //get file extension
    //     $extension = explode('.', $filename);
    //     $extension = array_pop($extension);
    //
    //     //remove file extension
    //     $name = preg_replace('#\.[^.]*$#', '', $filename);
    //     $filename = $name.'_'.$size.'.'.$extension;
    //
    //     return $this->owner->getPathURL('com_photos/'.$filename);
    // }

    /**
     * Adds a document to a set.
     *
     * @return true on success
     *
     * @param $document a ComDocumentsDomainEntityDocument object
     */
    public function addDocment($document)
    {
        $documents = AnHelperArray::getIterator($document);

        foreach ($documents as $document) {
            if (!$this->documents->find($document)) {
                $this->documents->insert($document, array(
                     'author' => $document->author,
                ));
            }
        }
    }

    /**
     * Removes a document or list of documents from the set.
     *
     * @param $photo a ComDocumentDomainEntityDocument object
     */
    public function removeDocument($document)
    {
        $documents = AnHelperArray::getIterator($document);

        foreach ($documents as $document) {
            if ($edge = $this->documents->find($document)) {
                $edge->delete();
            }
        }
    }

    /**
     * Orders the documents in this set.
     *
     * @param array $document_ids
     */
    public function reorder($document_ids)
    {
        if (count($document_ids) == 1) {
            if ($edge = $this->getService('repos:document.edge')
                              ->fetch(array(
                                        'set' => $this,
                                        'document.id' => $document_ids[0],
                                      ))
            ) {
                $edge->ordering = $this->documents->getTotal();
            }

            return;
        }

        foreach ($document_ids as $index => $document_id) {
            if ($edge = $this->getService('repos:document.edge')
                             ->fetch(array(
                                      'set' => $this,
                                      'document.id' => $document_id, ))
            ) {
                $edge->ordering = $index + 1;
            }
        }
    }

    /**
     * Gets number of documents in this set.
     *
     * @return int value
     */
    public function getDocumentCount()
    {
        return $this->getValue('document_count', 0);
    }
}
