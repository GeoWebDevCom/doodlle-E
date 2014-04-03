jQuery( document ).ready( function () {
  jQuery('.def').append('<span class="ui-icon ui-icon-info"/>');
 
jQuery('.def').click(function(){
 
      var request = {
         'option':'com_sobipro',
         'task':'definition.word',
         'format':'raw',
         'sid': SobiProSection,
         'word':jQuery(this).text()
      }
 
      jQuery.ajax( {
          
         'type': 'post',
         'url': 'index.php',
         'data': request,
         'dataType': 'text',
            success: function(data){
               jQuery.fx.speeds._default = 200;
               jQuery(function() {
                  jQuery( data ).dialog({
                     autoOpen: true,
                     show: "blind",
                     hide: "explode",
                     minWidth: 460
                  });
                  return false;
               });
  
            }
      } );
});
 
jQuery('.ui-dialog .def').live('click', function(){
 
      var request = {
         'option':'com_sobipro',
         'task':'definition.word',
         'format':'raw',
         'sid': SobiProSection,
         'word':jQuery(this).text()
      }
 
      jQuery.ajax( {
          
         'type': 'post',
         'url': 'index.php',
         'data': request,
         'dataType': 'text',
            success: function(data){
               jQuery.fx.speeds._default = 200;
               jQuery(function() {
                  jQuery( data ).dialog({
                     autoOpen: true,
                     show: "blind",
                     hide: "explode",
                     minWidth: 460,
                     position:['middle',20]
                  });
                  return false;
               });
  
            }
      } );
});
} );