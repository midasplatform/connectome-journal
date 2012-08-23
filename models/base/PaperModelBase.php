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
abstract class Journal_PaperModelBase extends Journal_AppModel {

  /**
   * constructor
   */
  public function __construct()
    {
    parent::__construct();
    $this->_name = 'journal_paper';
    $this->_key = 'paper_id';
    $this->_daoName = 'PaperDao';

    $this->_mainData = array(
      'paper_id' => array('type' => MIDAS_DATA),
      'issue_id' => array('type' => MIDAS_DATA),
      'folder_id' => array('type' => MIDAS_DATA),
      'title' => array('type' => MIDAS_DATA),
      'abstract' => array('type' => MIDAS_DATA),
      'paper_item_id' => array('type' => MIDAS_DATA),
      'status' => array('type' => MIDAS_DATA),
      'script_item_id' => array('type' => MIDAS_DATA),
      'issue' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'journal_issue',
                        'parent_column' => 'issue_id',
                        'child_column' => 'issue_id'),
      'folder' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'folder',
                        'parent_column' => 'folder_id',
                        'child_column' => 'folder_id'),
      'paper_item' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'item',
                        'parent_column' => 'paper_item_id',
                        'child_column' => 'item_id'),
      'script_item' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'item',
                        'parent_column' => 'script_item_id',
                        'child_column' => 'item_id')
       );
    $this->initialize(); // required
    }

}  // end class Journal_JournalModelBase