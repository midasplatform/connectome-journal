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
abstract class Journal_IssueModelBase extends Journal_AppModel {

  /**
   * constructor
   */
  public function __construct()
    {
    parent::__construct();
    $this->_name = 'journal_issue';
    $this->_key = 'issue_id';
    $this->_daoName = 'IssueDao';

    $this->_mainData = array(
      'issue_id' => array('type' => MIDAS_DATA),
      'journal_id' => array('type' => MIDAS_DATA),
      'folder_id' => array('type' => MIDAS_DATA),
      'journal' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'journal_journal',
                        'parent_column' => 'journal_id',
                        'child_column' => 'journal_id'),
      'folder' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'folder',
                        'parent_column' => 'folder_id',
                        'child_column' => 'folder_id')
       );
    $this->initialize(); // required
    }

}  // end class Journal_JournalModelBase