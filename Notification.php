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

require_once BASE_PATH . '/modules/api/library/APIEnabledNotification.php';

class Journal_Notification extends ApiEnabled_Notification
  {
  public $_models = array('Community');
  public $moduleName = 'journal';
  //public $_moduleComponents = array('Api');
  public $_moduleModels = array('Journal');
  public $_moduleDaos = array('Journal');

  /** init notification process*/
  public function init()
    {
    $this->enableWebAPI($this->moduleName);
    $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
    $this->moduleWebroot = $baseUrl.'/modules/'.$this->moduleName;
    $this->coreWebroot = $baseUrl.'/core';
    $this->webroot = $baseUrl;

    $this->addCallBack('CALLBACK_CORE_GET_LEFT_LINKS', 'getLeftLinks');

    }//end init
    
  /**
   * Add the link to this module to the left side list
   */
  public function getLeftLinks()
    {
    $enabledJournals = $this->Journal_Journal->getAllEnabled();

    $list = array();
    foreach($enabledJournals as $journal)
      {
      $community = $this->Community->load($journal->getCommunityId());
      $list[$community->getName()] =
        array($this->webroot.'/community/'.$journal->getCommunityId(),
        $this->webroot.'/modules/'.$this->moduleName.'/public/images/journal.png');
      }
    return $list;
    }

} //end class
  
?>
