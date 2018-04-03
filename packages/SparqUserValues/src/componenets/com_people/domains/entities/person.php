<?php

/**
 * Person object. It's the main actor node that represents the social network users. A person can added
 * applications to their profile.
 *
 * Here's how to get a person object, set a property and save
 * <code>
 * //fetches a peron with $id
 * $person = KService::get('repos:people.person')->fetch($id);
 * $person->name = 'Doctor Who';
 * $person->save();
 * </code>
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
final class ComSparqUserValuesDomainEntityPerson extends ComPeopleDomainEntityPerson
{
    /*
    * Allowed user types array
    */
    protected $_allowed_academic_types;
    protected $_allowed_corporate_types;

    /*
     * Sparq: Phase 4
     * UserValues----------------- William
     */
    const ACADEMICTYPE_NONE="none";
    const ACADEMICTYPE_STUDENT="student";
    const ACADEMICTYPE_TUTOR="tutor";
	const ACADEMICTYPE_INSTRUCTOR="instructor";
    const ACADEMICTYPE_ADMIN="admin";
    
	const CORPORATETYPE_NONE="none";
    const CORPORATETYPE_RECRUITER="recruiter";
    const CORPORATETYPE_MANAGER="manager"; 
    const CORPORATETYPE_COMPANY="Company"; 

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
            'resources' => array('people_people'),
            'attributes' => array(
                'administratingIds' => array(
                    'type' => 'set',
                    'default' => 'set'
                ),
                'alias' => array(
                    'key' => true,
                    'format' => 'username'
                ),
                'givenName',
                'familyName',
                'username' => array(
                    'key' => true,
                    'format' => 'username'
                ),
                'email',
                'password' => array(
                    'format' => 'password'
                ),
                'usertype',
                'gender',
                'lastVisitDate' => array(
                    'default' => 'date'
                ),
                'activationCode',
                'academictype',                 /* Added uservalue type ------- William */
				'corporatetype'
            ),
            'aliases' => array(
                'registrationDate' => 'creationTime'
            ),
            'behaviors' => to_hash(array(
                //@todo if viewer is admin, then make email searchable too
                'describable' => array(
                    'searchable_properties' => array(
                        'givenName',
                        'familyName',
                        'username',
                        'email'
                    )
                ),
                'administrator',
                'notifiable',
                'leadable'
            )),
        ));

        $config->behaviors->append(array(
            'followable' => array('subscribe_after_follow' => false)
        ));

        parent::_initialize($config);

        AnHelperArray::unsetValues($config->behaviors, array('administrable'));
    }

    /** 
    * Checks for sparq UserValue account types
    * return true if the user is [blah]
    *  @return bool
    **/
    // ------ Academic Types ------
    public function academicCheck()
    {
        return $this->academictype !== self::ACADEMICTYPE_NONE;
    }

    public function student()
    {
        return $this->academictype === self::ACADEMICTYPE_STUENT;
    }

    public function tutor()
    {
        return $this->academictype === self::ACADEMICTYPE_TUTOR;
    }

    public function instructor()
    {
        return $this->academictype === self::ACADEMICTYPE_INSTRUCTOR;
    }

    public function academicadmin()
    {
        return $this->academictype === self::ACADEMICTYPE_ADMIN;
    }

    // ------ Corporate Accounts ------
    public function corporateCheck(){
        return $this->corporatetype !== self::CORPORATETYPE_NONE;
    }
    public function recruiter()
    {
        return $this->corporatetype === self::CORPORATETYPE_RECRUITER;
    }

    public function manager()
    {
        return $this->corporatetype === self::CORPORATETYPE_MANAGER;
    }

    public function company()
    {
        return $this->corporatetype === self::CORPORATETYPE_COMPANY;
    }
}
