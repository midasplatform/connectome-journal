<?php
/*=========================================================================
MIDAS Server
Copyright (c) Kitware SAS. 20 rue de la Villette. All rights reserved.
69328 Lyon, FRANCE.

See Copyright.txt for details.
This software is distributed WITHOUT ANY WARRANTY; without even
the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
PURPOSE.  See the above copyright notices for more information.
=========================================================================*/
/** JournalModel Base class */
abstract class Journal_JournalModelBase extends Journal_AppModel {

  /**
   * constructor
   */
  public function __construct()
    {
    parent::__construct();
    $this->_name = 'journal_journal';
    $this->_key = 'journal_id';
    $this->_daoName = 'JournalDao';

    $this->_mainData = array(
      'journal_id' => array('type' => MIDAS_DATA),
      'community_id' => array('type' => MIDAS_DATA),
      'enabled' => array('type' => MIDAS_DATA),
      'community' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'community',
                        'parent_column' => 'journal_id',
                        'child_column' => 'journal_id'),
       );
    $this->initialize(); // required
    }
    
 abstract public function getByCommunityId($communityId);
 abstract public function getAll();
 abstract public function getAllEnabled();
 
}  // end class Journal_JournalModelBase