(function($) 
{
    $.fn.Jooria_Delete = function(name,message) {
            $(this).click(function() {         
            var id = $(this).attr("id");
            var dataString =  name +'='+ id ;
            var parent = $(this).parent();
            
            if(confirm(message)) {
                $.ajax({
                    type: 'POST',
                    data: dataString,                 
                    success: function() {
                        parent.fadeOut('slow', function() {$(this).remove();});
                    }
                });
            }
            return false;
        });
    };
})(jQuery);

