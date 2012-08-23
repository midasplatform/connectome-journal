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
require_once BASE_PATH . '/modules/journal/models/base/JournalModelBase.php';


/** Journal_JournalModel */
class Journal_JournalModel extends Journal_JournalModelBase {

  /**
   * Returns journal_JournalDao by a communityId
   * @param type $communityId
   * @return type
   */

  function getByCommunityId($communityId)
    {
    $row = $this->database->fetchrow($this->database->select()->where('community_id=?', $communityId));
    $return = false;
    if(!empty($row))
      {
      $return = $this->initDao('Journal', $row, 'journal');
      }
    return $return;
    }

  /**
   * Returns journal_journal
   * @return type
   */
  function getAll()
    {
    $rows = $this->database->fetchall($this->database->select());
    $return = array();
    foreach($rows as $row)
      {
      $return[] = $this->initDao('Journal', $row, 'journal');
      }
    return $return;
    }
  
  /**
   * Returns journal_journal
   * @return type
   */
  function getAllEnabled()
    {
    $rows = $this->database->fetchall($this->database->select()->where('enabled=?', TRUE));
    $return = array();
    foreach($rows as $row)
      {
      $return[] = $this->initDao('Journal', $row, 'journal');
      }
    return $return;
    }
}
