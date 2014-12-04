jQuery(function(){

    //jQuery('.wrap').addClass('wpeden-theme-options');
    //jQuery('.wpeden-theme-options h3').each();
     
     jQuery('select').chosen();
          





    // Uploading files
    var file_frame;


    jQuery('.btn-media-upload').live('click', function( event ){

        event.preventDefault();
        var dfield = jQuery(jQuery(this).attr('rel'));
        //alert(dfield.attr('id'));
        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery( this ).data( 'uploader_title' ),
            button: {
                text: jQuery( this ).data( 'uploader_button_text' )
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            dfield.val(attachment.url);

        });

        // Finally, open the modal
        file_frame.open();
    });


    jQuery('select').chosen();
     

     
     
     jQuery('.typocb').click(function(){
          var cbid = '#'+this.id+"-x";
          if(!jQuery(this).hasClass('active')) jQuery(cbid).val(1);
          else jQuery(cbid).val(0); 
     });
     

     
     jQuery('a[data-toggle="tab"]').on('shown', function (e) {
        //save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', jQuery(e.target).attr('id'));
      });

     //go to the latest tab, if it exists:
     var lastTab = localStorage.getItem('lastTab');
     if (lastTab) {
          jQuery('#'+lastTab).tab('show');
      }
    
    
    });

function mediaupload(id){
      var id = '#'+id;
      tb_show('Upload Image','media-upload.php?TB_iframe=1&width=640&height=624');
      window.send_to_editor = function(html) {           
              var imgurl = jQuery('img',"<p>"+html+"</p>").attr('src');                                    
              jQuery(id).val(imgurl);
              tb_remove();
              }
      
  }