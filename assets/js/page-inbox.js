(function($){
  'use strict';

  /*
    Showing inbox list, inbox message view and inbox reply view with jQuery ajax.
      inbox list = inbox-list.html
      inbox message = inbox-message.html
      inbox reply = inbox-reply.html
    
    Attributes required for script functionality
      data-id
      data-content
      data-action
      
      data-id
      Each <tr> in inbox-list.html has `data-id` attribute which value should match to `div.panel-message-view` `data-id` attribute value in inbox-message.html to identify message title with message text.
      
      data-content
      This attribute is responsible for getting the email subject, message and recipient data and putting them in appropiate fields in inbox-reply.html.

      data-action
      This attribute is added to buttons with action behaviour(inbox list refresh, compose new mail etc.).
    
  */

  var inbox = {
    inboxContent: $("#inbox-content"),
    pageTitle: $(".page-title"),
    fileInboxList: "page-inbox-list.html",
    fileInboxMessage: "page-inbox-message.html",
    fileInboxReply: "page-inbox-reply.html",
    fileInboxListSent: "page-inbox-list-sent.html",
    fileInboxListSpam: "page-inbox-list-spam.html",
    fileInboxListTrash: "page-inbox-list-trash.html",
    fileInboxListStarred: "page-inbox-list-starred.html",

    cc: '<div class="form-group">'+
              '<div class="input-group">'+
                '<span class="input-group-addon">CC: </span>'+
                '<input type="text" class="form-control" name="cc">'+
                '<span class="input-group-addon"><i class="icon-close" data-action="cc-close"></i></span>'+
              '</div>'+
            '</div>',
    bcc:'<div class="form-group">'+
              '<div class="input-group">'+
                '<span class="input-group-addon">BCC: </span>'+
                '<input type="text" class="form-control" name="bcc">'+
                '<span class="input-group-addon"><i class="icon-close" data-action="bcc-close"></i></span>'+
              '</div>'+
            '</div>',

    init: function(){
      $.ajax({
        url: inbox.fileInboxList,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.inboxContent.append(data);
          inbox.icheckInit();
          inbox.paginationInit();

          $(document)
          .on("click", ".nav-inbox [data-action]", inbox.navInbox)
          .on("click", ".table-inbox-list tr", inbox.message)
          .on("click", "#inbox-content .star", inbox.starIconClick)
          .on("ifChanged", ".inbox-list-heading .icheck", inbox.icheckClick)
          .on("click", ".inbox-list-heading [data-action]", inbox.tableRefresh);
        },
        error: function(){
          alert("Unable to load inbox list");
        }
      })
    },
    tableRefresh: function(e){
      var btn = $(e.target).attr("data-action");
      var urlPathName;
      var fileName;

      urlPathName = window.location.pathname;
      urlPathName = urlPathName.split('/');
      fileName = urlPathName[urlPathName.length -1];
      
      file = fileName.indexOf(".");
      file = fileName.slice(0, file);     

      if(btn == "btn-refresh"){
        inbox.blockuiInit();
        setTimeout(function(){
          inbox.navInboxActivePage(file);
        }, 2000);
      }
    },
    blockuiInit: function(){
      // Blockui default settings
      $.blockUI.defaults.timeout = 2000;
      $.blockUI.defaults.overlayCSS.zIndex = 1060;
      $.blockUI.defaults.overlayCSS.backgroundColor = 'transparent';
      $.blockUI.defaults.css.width = 'auto';
      $.blockUI.defaults.css.left = 0;
      $.blockUI.defaults.css.right = 0;
      $.blockUI.defaults.css.margin = 'auto';
      $.blockUI.defaults.css.border = 'none';
      $.blockUI.defaults.css.backgroundColor = 'transparent';

      $(".table-inbox-list").block({ 
        message: '<i class="fa fa-spinner fa-spin" style="font-size: 30px"></i>',
        overlayCSS: {
          'background-color': '#eee'
        }
      });
    },
    icheckInit: function(){
      $('input.icheck').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
      });
    },
    icheckClick: function(){
      $(this).on("ifChecked ifUnchecked", function(e){
        if( e.type == "ifChecked" ){
          $(".table-inbox-list .icheck").iCheck("check");
        }else{
          $(".table-inbox-list .icheck").iCheck("uncheck");
        }
      });
    },
    paginationInit: function(){
      // Pagination
      $(".content-wrapper").jplist({       
        itemsBox: ".table-inbox-list",
        itemPath: "tr[data-id]",
        panelPath: ".inbox-list-pagination"
      });
    },
    attachmentInit: function(){
      // Image popup preview
      $(".attachment-img").magnificPopup({
        delegate: "a:not(.attachment-item-file)", // child items selector, by clicking on it popup will open
        type: "image",
        gallery:{
          enabled: true
        }
      });

      // popup preview video
      $(".attachment-file").magnificPopup({
        delegate: ".attachment-item-file", // child items selector, by clicking on it popup will open
        type: "iframe"
      });
    },
    summernoteInit: function(){
      // Summernote editor
      $("[data-content='message-editor']").summernote();
    },
    starIconClick: function(e){
      var star = $(this).find(".fa");

      if(star.closest("tr")){
        e.stopPropagation();
        
        if(star.hasClass("fa-star-o")){
          star.removeClass("fa-star-o").addClass("fa-star");
        }else{
          star.removeClass("fa-star").addClass("fa-star-o");
        }
      }
    },
    message: function(){
      var id = $(this).attr("data-id");
      $.ajax({
        url: inbox.fileInboxMessage,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.inboxContent.empty();

          // Identifying message
          var curMsg = $($.parseHTML(data)).find(".panel[data-id='"+id+"']");
          inbox.inboxContent.append(curMsg);

          // Attachemnt preview
          inbox.attachmentInit();

          inbox.inboxContent.find("[data-action='btn-reply']").on("click", inbox.reply);
        },
        error: function(){
          alert("Unable to load the current message");
        }
      });
    },
    reply: function(){
      $.ajax({
        url: inbox.fileInboxReply,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          // Getting data of recipient, subject, msg and setting that values in reply page.
          var recipient = inbox.inboxContent.find("[data-content='recipient']").text();
          var subject = inbox.inboxContent.find("[data-content='subject']").text();
          var msg = inbox.inboxContent.find("[data-content='message']").html();

          inbox.inboxContent.empty();

          inbox.inboxContent.append(data);
          inbox.inboxContent.find(".panel-title > h4").text("Reply");
          inbox.inboxContent.find("input[type='text'][data-content='recipient']").val(recipient);
          inbox.inboxContent.find("input[type='text'][data-content='subject']").val(subject);
          inbox.inboxContent.find("div[data-content='message-editor']").html(msg);
          inbox.summernoteInit();

          // File upload
          inbox.fileUpload();

          $(document).on("click", ".message-reply-heading [data-action]", inbox.ccbcc);
        },
        error: function(){
          alert("Unable to load the reply form");
        }
      })
    },
    ccbcc: function(){
      var container = $(this).closest(".message-reply-heading");
      var attr = $(this).attr("data-action");

      // Adds cc
      if(attr == "cc" && !container.hasClass("has-cc")){
        container.append(inbox.cc).addClass("has-cc");
      }
      // Adds bcc
      if(attr == "bcc" && !container.hasClass("has-bcc")){
        container.append(inbox.bcc).addClass("has-bcc");
      }
      // Removes css or bcc
      if(attr == "cc-close" || attr == "bcc-close"){
        var ccBcc = attr.indexOf("-");
        ccBcc = attr.slice(0,ccBcc);
        $(this).closest(".form-group").remove();
        container.removeClass("has-"+ccBcc);
      }
    },
    navInbox: function(e){
      $(e.target).closest("li").addClass("active").siblings().removeClass("active");
      inbox.navItem = $(e.target).attr("data-action") || $(e.target).closest("[data-action]").attr("data-action");
      inbox.navInboxActivePage(inbox.navItem);
    },
    navInboxActivePage: function(page){
      switch(page){
        case "compose" : inbox.compose(); break;
        case "inbox" : inbox.inbox(); break;
        case "sent" : inbox.sent(); break;
        case "spam" :inbox.spam(); break;
        case "trash" : inbox.trash(); break;
        case "starred" : inbox.starred(); break;
      }
    },
    compose: function(){
      $.ajax({
        url: inbox.fileInboxReply,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.pageTitle.text("Compose");
          inbox.inboxContent.empty().append(data);
          inbox.inboxContent.find(".panel-title > h4").text("New message");
          inbox.summernoteInit();

          // File upload
          inbox.fileUpload();

          $(document).on("click", ".message-reply-heading [data-action]", inbox.ccbcc);
        },
        error: function(){
          alert("Unable to compose a message");
        }
      })
    },
    inbox: function(){
      $.ajax({
        url: inbox.fileInboxList,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.pageTitle.text("Inbox");
          inbox.inboxContent.empty().append(data);
          inbox.icheckInit();
          inbox.paginationInit();
        },
        error: function(){
          alert("Unable to load sent messages");
        }
      })
    },
    sent: function(){
      $.ajax({
        url: inbox.fileInboxListSent,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.pageTitle.text("Sent");
          inbox.inboxContent.empty().append(data);
          inbox.icheckInit();
          inbox.paginationInit();
        },
        error: function(){
          alert("Unable to load sent messages");
        }
      })
    },
    spam: function(){
      $.ajax({
        url: inbox.fileInboxListSpam,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.pageTitle.text("Spam");
          inbox.inboxContent.empty().append(data);
          inbox.icheckInit();
          inbox.paginationInit();
        },
        error: function(){
          alert("Unable to load messages");
        }
      })
    },
    trash: function(){
      $.ajax({
        url: inbox.fileInboxListTrash,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.pageTitle.text("Trash");
          inbox.inboxContent.empty().append(data);
          inbox.icheckInit();
          inbox.paginationInit();
        },
        error: function(){
          alert("Unable to load messages");
        }
      })
    },
    starred: function(){
      $.ajax({
        url: inbox.fileInboxListStarred,
        datatype: "html",
        cache: false,
        success: function(data, textStatus, jqXHR){
          inbox.pageTitle.text("Starred");
          inbox.inboxContent.empty().append(data);
          inbox.icheckInit();
          inbox.paginationInit();
        },
        error: function(){
          alert("Unable to load messages");
        }
      })
    },
    fileUpload: function(){
      // Dropzone file upload bootstrap theme example
      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      var previewNode = document.querySelector("#template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);

      var myDropzone = new Dropzone(document.querySelector("#actions"), { // Make the whole body a dropzone
        url: "page-inbox.html", // Set the url
        thumbnailWidth: 150,
        thumbnailHeight: 100,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
      });

      myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
      });

      // Setup the buttons for all transfers
      // The "add files" button doesn't need to be setup because the config
      // `clickable` has already been specified.
      document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
      };
      document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
      };
    }
  };
  
  inbox.init();
})(jQuery);