var midas = midas || {};
midas.journal = midas.journal || {};
midas.journal.config = midas.journal.config || {};

midas.journal.config.validateConfig = function (formData, jqForm, options) {
}

midas.journal.config.successConfig = function (responseText, statusText, xhr, form) {
  try {
      var jsonResponse = jQuery.parseJSON(responseText);
  } catch (e) {
      midas.createNotice("An error occured. Please check the logs.", 4000, 'error');
      return false;
  }
  if(jsonResponse == null) {
      midas.createNotice('Error', 4000, 'error');
      return;
  }
  if(jsonResponse[0]) {
      midas.createNotice(jsonResponse[1], 4000);
  }
  else {
      midas.createNotice(jsonResponse[1], 4000, 'error');
  }
}

midas.journal.config.initSupportedFormats = function () {
    var inputSupportAll = $('input[name=supportAll]');
    var inputImageFormats = $('input[name=imageFormats]');
    var inputFormatsDiv = $('div#imageformatsDiv');

    if(inputSupportAll.filter(':checked').val() == 1) {
        inputImageFormats.attr('disabled', 'disabled');
        inputImageFormats.removeAttr('checked');
        inputImageFormats.filter('[value=0]').attr('checked', true);
        inputFormatsDiv.hide();
    }
    else {
        inputImageFormats.removeAttr('disabled');
        inputFormatsDiv.show();
    }
    inputSupportAll.change(function () {
        midas.journal.config.initSupportedFormats();
    });
}

midas.communitySelectionCallback = function(communityName, communityId)
  {
    if(communityName != '' && communityId != '')
      { 
      $.post(json.global.webroot+'/journal/config', { element: communityId, addJournal: true});
      var newRow = '';
      newRow += '<tr>';
      newRow += '  <td>';
      newRow += '<a href="'+json.global.webroot+'/community/'+communityId+'">'+communityName;
      newRow += '</a> </td>';
      newRow += '  <td><span style="float: left;">'+" "+'</span>';
      newRow +=  '<span class="manageJournal">';
      newRow +=  '<a href="javascript:;" element="'+communityId+'" class="journalDeleteLink"><img alt="" src="'+json.global.coreWebroot+'/public/images/icons/close.png" /></a>';
      newRow +=  '</span>';
      newRow +=  '  </td>';
      newRow +=  '</tr>';
      }
      
    if($("#journalTable > tbody > tr:last").length > 0) 
      {
      $(newRow).insertAfter("#journalTable > tbody > tr:last");
      } 
      else 
      {
      $(newRow).appendTo("#journalTable > tbody");
      }
    return;
};

$(document).ready(function() {
    midas.journal.config.initSupportedFormats();  
    $('#configForm').ajaxForm({
        beforeSubmit: midas.journal.config.validateConfig,
        success: midas.journal.config.successConfig
    });
    $('#imageformatsForm').ajaxForm({
        beforeSubmit: midas.journal.config.validateConfig,
        success: midas.journal.config.successConfig
    });
    
    
    $('a.journalDeleteLink img').fadeTo('fast', 0.4);
    $('a.journalDeleteLink img').hover(function() {
        $(this).fadeTo('fast', 1.0);
    },
    function() {
        $(this).fadeTo('fast', 0.4);
    });
    
    $('a.addJournalLink').click(function () {
        midas.loadDialog("selectjournal","/journal/config/selectjournal");
        midas.showDialog('Browse for adding a new journal to the journal list');
    });
    
        $('a.journalDeleteLink').click(function () {
        var journalCell = $(this).parents('tr');
        var communityId = $(this).attr('element');
        var html = '';
        html+=json.message['deleteJournalMessage'];
        html+='<br/>';
        html+='<br/>';
        html+='<br/>';
        html+='<input style="margin-left:140px;" class="globalButton deleteJournalYes" element="'+$(this).attr('element')+'" type="button" value="'+json.global.Yes+'"/>';
        html+='<input style="margin-left:50px;" class="globalButton deleteJournalNo" type="button" value="'+json.global.No+'"/>';
        midas.showDialogWithContent(json.message['delete'],html,false);

        $('input.deleteJournalYes').unbind('click').click(function () {
            $.post(json.global.webroot+'/journal/config', { element: communityId, deleteJournal: true});
            journalCell.remove();
            $( "div.MainDialog" ).dialog('close');
        });
        $('input.deleteJournalNo').unbind('click').click(function() {
            $( "div.MainDialog" ).dialog('close');
        });
    });

    
});
