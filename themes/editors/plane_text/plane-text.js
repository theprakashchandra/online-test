/*-------------------------------------------------------------\
    plane text editor for comments and mobile site
    THIS editor will ensure for a plane text input
    @author : prakash joshi
    @module :
\-------------------------------------------------------------*/
(function( $ ){
  $.fn.planeTextEditer = function( options ){
    var defaults = {
      wrapperAttrs :{
        class : "editor-wrapper-plane"
      },
      wrapperCss : {
        minHeight : "150px",
        maxHeight : "300px",
        width : "100%",
        backgroundColor : "rgb(250,250,230)"
      },
      toolbarAttrs : {
        class : "editor-tools-plane"
      },
      toolbarCss : {
         height : "content",
         float : "right",
         // backgroundColor : "rgb(250,250,250)",
         display : "none",
         // width : "25%"
      },
      mediaIframeAttrs : {
        src : "media_gallery/media_counter", //change the url of your media file according to base url
        height: "100%",
        width : "100%"
      },
      placeholder : "start writing...."//avoid comma errors
    }

      var settings = $.extend( true, {
        stylesheet : $("<link />").attr({"rel":"stylesheet","href":"themes/editors/plane_text/plane-text.css"}).appendTo('head')
      }, defaults, options );

      var editorPlane = { // editor class as object
      editor_wrapper : $( "<div />" ).attr( settings.wrapperAttrs ).css( settings.wrapperCss ),

      toolbar : $( "<div />" ).attr( settings.toolbarAttrs ).css( settings.toolbarCss ),

      tools : [
        $("<a class='btn btn-light img-button' title='insert media' />")
        .append("<i class='fa fa-paperclip text-primary' />"),

        $("<a data-command='addLink' class='btn st-ed-dropdown-opener' data-target='#drpDwnInsertLink' title='insert link' />").append("<i class='fas fa-link' />")
      ],

      editor_body : $( "<div class='editor-body' contenteditable='true' />" ).css( settings.wrapperCss ),

      placeholder_div : $("<span class='placeholder' style='background:transparent;opacity:0.5;'/>").append(" write a breif summary...")
    }
    return this.each(function(){
      $(this).before( editorPlane.editor_wrapper );
      $(this).hide();

       editorPlane.editor_wrapper.append(editorPlane.editor_body);
       editorPlane.editor_wrapper.append(editorPlane.toolbar);
       var i;
       for (i = 0; i < editorPlane.tools.length; i++) {
         editorPlane.toolbar.append(editorPlane.tools[i]);
       }
       if ($(this).val()!='' || !$(this).empty()){
          editorPlane.editor_body.empty().append($(this).val());
       }
       else {
         editorPlane.placeholder_div.appendTo(editorPlane.editor_body).empty().append($(this).attr('placeholder'));
       }

      // editor.media_wrapper( editor.editor_wrapper,settings.mediaIframeAttrs );
    });
  }
})( jQuery );

$(function(){
  $('.plane-text').planeTextEditer({
    //options
  });
  $(document).on('blur','.editor-body',function(e){
    $(this).children('.placeholder').remove();
    $(this).parents('.editor-wrapper-plane').next('textarea').val($(this).html());
  });
  var placeholder = $("<span class='placeholder' style='background:transparent;'/>").append("write something here...");

  $(document).on('keydown','.editor-body',function(e){

    /*----------------------------------\
     * check the actual text length
     *
     *
    \ ----------------------------------*/
      $(this).children('.placeholder').remove();
      if (e.keyCode === 13) {
        document.execCommand('insertHTML',false,'<br><br>');
        return false;
      }
      $(this).parents('.editor-wrapper-plane').next('textarea').val($(this).html());
  })
  $(document).on('mousedown click','.placeholder',function(e){
    e.preventDefault();
    $(this).parents('.editor-body').focus();
    document.setSelectionRange(0,0);
      // $(this).remove();
  })
  $(document).on('focus','.editor-body',function(e){
    document.setSelectionRange(0,0);
    var plhLen = $(this).children('.placeholder').text().toString().length;
    var bodyLen = $(this).text().replace(/ /g,"").toString().length;
    if (bodyLen - plhLen >0) {
      $(this).children('.placeholder').remove();
        // document.setSelectionRange(0,0);
    }
    else {
      // alert(bodyLen - plhLen)
      // $(this).append(placeholder.empty().append($(this).parents('.editor-wrapper-plane').next('textarea').attr('placeholder')));
    }
  })
  $(document).on('keyup','.editor-body',function(e){
    // document.setSelectionRange(0,0);
    var plhLen = $(this).children('.placeholder').text().toString().length;
    var bodyLen = $(this).text().replace(/ /g,"").toString().length;
    if (bodyLen - plhLen > 0) {
      $(this).children('.placeholder').remove();
    }
    else {
      // alert(bodyLen - plhLen)
      $(this).append(placeholder.empty().append($(this).parents('.editor-wrapper-plane').next('textarea').attr('placeholder')));
    }
  })
})
