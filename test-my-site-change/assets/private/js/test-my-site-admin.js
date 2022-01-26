
jQuery(document).ready(function ($) {


  	 $( "#title" ).change(function() {
        if($(this).val() !== ""){
            var this_post_id;
            this_post_id = "";
            if($("#post_ID").val()){
                this_post_id = $("#post_ID").val();
            }
            var data = {
                'action': 'test_duplicate_guid',
                'post_title': $(this).val(),
                'post_type': 'testmysite',
                'post_ID' : this_post_id
            };
            // We can also pass the url value separately from ajaxurl for front end AJAX implementations
            jQuery.post("admin-ajax.php?action=test_duplicate_guid", data, function(response) {
                if(response > 0){
                    $("#title").val("");

                    $.ajax({
					    type:'GET',
					    url:"admin-ajax.php?action=generate_new_guid",
					    data : {
					        action : 'generate_new_guid'
					    },
					    beforeSend:function(xhr){

					    },
					    success:function(data){
					   
					      $("#title").val($.trim(data)); // insert data
					    }
					});

                    $("#post").submit();
                   
                    
                    // I do the form#post submission because I could not find the trigger to use the autosave - would be better with the auto save
                    // This is needed to avoid save post drafts with the unwanted title
                }
            });
        }
    });
});