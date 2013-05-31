



	  	//MODAL STARTS
	  	
	  	var modal = (function(){
				var 
				method = {},
				$overlay,
				$modal,
				$content,
				$close;

				// Center the modal in the viewport
				method.center = function () {
					var top, left;

					top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
					left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

					$modal.css({
						top:top + $(window).scrollTop(), 
						left:left + $(window).scrollLeft()
					});
				};

				// Open the modal
				method.open = function (settings) {
					$content.empty().append(settings.content);

					$modal.css({
						width: settings.width || 'auto', 
						height: settings.height || 'auto'
					});

					method.center();
					$(window).bind('resize.modal', method.center);
					$modal.show();
					$overlay.show();
				};

				// Close the modal
				method.close = function () {
					$modal.hide();
					$overlay.hide();
					$content.empty();
					$(window).unbind('resize.modal');
				};

				// Generate the HTML and add it to the document
				$overlay = $('<div id="overlay"></div>');
				$modal = $('<div id="modal"></div>');
				$content = $('<div id="content"></div>');
				$close = $('<a id="close" href="#">close</a>');

				$modal.hide();
				$overlay.hide();
				$modal.append($content, $close);

				$(document).ready(function(){
					$('body').append($overlay, $modal);						
				});

				$close.click(function(e){
					e.preventDefault();
					method.close();
				});

				return method;
			}());
   
			//MODAL ENDS

$(document).ready(function() {
	
get_admin_boxes();


/*
 * The link for all the functions .. redirect from here to the function in the site controller
 * 
 */
//must introduce the find in a div function .... this can apply to al the functions in the application .. which is not good
$('[id^=func_]').live('click',function(){
	var substr = $(this).attr('id').split('_');
	window.location.href = "http://localhost/CodeIgniter_school1/index.php/site/load_func/"+substr[1];
	//alert("some text"+$(this).attr('id'));
});

/*
 * The end of the redirections
 */

});





function get_admin_boxes(){
	//all the initial boxes.. making up from the db
	
			serializedData = 'action=get_boxes';	
		
						//ajax post
						$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/get_admin_boxes",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						/*
						 * Have a condition in the members area page that will redirect it to the customer 
						 * based on he is the admin or not. check the session variable for that.
						 */
							$('#testingtesting').html(response);																
					
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
							alert("aaaaaaalogin failure .. some error");
							alert("inLOGINerror"+jqXHR+"vvv"+textStatus+"vvv"+errorThrown);
						// log the error to the console
						$("#login_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
					
}
