<?php
/*=========================================================================
 MIDAS Server
 Copyright (c) Kitware SAS. 26 rue Louis Guérin. 69100 Villeurbanne, FRANCE
 All rights reserved.
 More information http://www.kitware.com

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

         http://www.apache.org/licenses/LICENSE-2.0.txt

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
=========================================================================*/

/**
 * Journal module configuration
 */
class Journal_ConfigController extends Journal_AppController
{
  public $_models = array('Community');
  public $_daos = array('Community');
  public $_moduleModels = array('Journal');
  public $_moduleDaos = array('Journal');

  /** index action*/
  function indexAction()
    {
    $this->requireAdminPrivileges();

    if($this->_request->isPost())
      {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender();

      $deleteJournal = $this->_getParam('deleteJournal');
      if(isset($deleteJournal) && !empty($deleteJournal)) //delete a journal from list
        {
        $communityId = $this->_getParam('element');
        $journalDao = $this->Journal_Journal->getByCommunityId($communityId);
        if($journalDao === false)
          {
          throw new Zend_Exception("This journal has been deleted or does not exist.");
          }
        $this->Journal_Journal->delete($journalDao);
        }

      $addJournal = $this->_getParam('addJournal');
      if(isset($addJournal) && !empty($addJournal)) //add a journal to list
        {
        $communityId = $this->_getParam('element');
        $journalDao = new Journal_JournalDao();
        $journalDao->setCommunityId($communityId);
        $this->Journal_Journal->save($journalDao);
        echo JsonComponent::encode(array(true, 'Changes saved'));
        }
      }

    $communities = array();
    $journalDaos = $this->Journal_Journal->getAll();
    foreach($journalDaos as $journalDao)
      {
      array_push($communities, $this->Community->load($journalDao->getCommunityId() ) );
      }
    $this->view->communities = $communities;
    $this->view->json['message']['delete'] = $this->t('Delete');
    $this->view->json['message']['deleteJournalMessage'] = $this->t('Do you really want to delete this journal from the journal list? It cannot be undone.');
    }

  /** Ajax element used to select a journal*/
  public function selectjournalAction()
    {
    $this->requireAjaxRequest();
    $this->disableLayout();
    $allCommunities = $this->Community->getAll();
    $journalDaos = $this->Journal_Journal->getAll();
    $journalCommunityIDs = array();
    foreach($journalDaos as $journalDao)
      {
      array_push($journalCommunityIDs, $journalDao->getCommunityId());
      }
    $communities = array();
    foreach($allCommunities as $community)
      {
      if(!in_array($community->getKey(), $journalCommunityIDs))
        {
        array_push($communities, $community);
        }
      }
    $this->view->communities = $communities;
    }

}//end class