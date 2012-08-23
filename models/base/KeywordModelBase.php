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
abstract class Journal_KeywordModelBase extends Journal_AppModel {

  /**
   * constructor
   */
  public function __construct()
    {
    parent::__construct();
    $this->_name = 'journal_keyword';
    $this->_key = 'keyword_id';
    $this->_daoName = 'KeywordDao';

    $this->_mainData = array(
      'keyword_id' => array('type' => MIDAS_DATA),
      'paper_id' => array('type' => MIDAS_DATA),
      'keyword' => array('type' => MIDAS_DATA),
      'keyword_order' => array('type' => MIDAS_DATA),
      'paper' =>  array('type' => MIDAS_ONE_TO_ONE,
                        'model' => 'journal_paper',
                        'parent_column' => 'paper_id',
                        'child_column' => 'paper_id')

       );
    $this->initialize(); // required
    }

}  // end class Journal_JournalModelBase