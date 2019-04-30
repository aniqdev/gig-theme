(function() {
	HTMLElement.prototype.aqs_slider = function(opts){

		var $this = this,
			elems = this.children;
		// this содержит список слайдов
		// по нажатию на кнопки prev и next елементы мписка сдвигаются
		try {

			opts.prev.addEventListener("click", function() {
				$this.prepend(elems[elems.length-1]);
			});

			opts.next.addEventListener("click", function() {
				$this.appendChild(elems[0]);
			});

		} catch(e) {

		  console.error(e.stack);

		}
		return this;
	}
})();



jQuery(function($) {

	if(!document.all.aqs_search_input) return;
	
	$( "#aqs_search_input" ).autocomplete({
	  	source: function( request, response ) {
			// console.log(request)
			var data = { action: 'aqs_search',
						 search: request.term };
			$.post(myajax.url, data, function(data) {
				// console.log(results_html)
	        	response(data.list);
			},'json');
	    },
	    appendTo: "#aqs_search_results",
	    // position: { of: '#aqs_search_results', at: 'top left' },
	    open: function( event, ui ) { $('.get-more').css('display','block') },
	    close: function( event, ui ) { $('.get-more').css('display','none') }
	});

	$("#aqs_search_input").on( "autocompleteselect", function( event, ui ) {
		console.log(event.target)
		location.href = ui.item.href
	});

	$('body').on( "click", '.get-more', function( event ) {
		console.log(event.target)
	});

	// $('#aqs_search_results2').html($('.ui-autocomplete'));

});


jQuery(function($) {
	return; // пока отключим свой autocomplete
	var search_form = document.all.aqs_search_form;
	var search_input = document.all.aqs_search_input;
	var search_results = document.all.aqs_search_results;
	if (!search_input || !search_results || !search_form) return;


	search_input.addEventListener("keyup", function(e) {
		if(e.which === 38 || e.which === 40){
			$(search_results).find('li a').eq(0).focus();
			console.log()
			return;
		}
		var value = this.value.trim();
		if (value.length > 2) {
			var data = {
				action: 'aqs_search',
				search: value
			};
			$.post(myajax.url, data, function(data) {
				console.log(data.list);
				var results_html = data.list.map(function(val, i) { 
				    return '<li><a href="'+myajax.home_url+'/game" tabindex="4">'+val.title+'</a></li>';
				}).join('');
				$(search_results).html(results_html);
			},'json');
			search_results.classList.remove('hidden');
		}else{
			search_results.classList.add('hidden');
		}
		console.log()
	})

	search_results.addEventListener("keydown", function(e) {
		// console.log(e.which)
    	e.preventDefault()
    	e.stopPropagation()

	    var $items = $(this).find('li a')

	    if (!$items.length) return

	    var index = $items.index(e.target)

	    if (e.which == 38 && index > 0)                 index--         // up
	    if (e.which == 40 && index < $items.length - 1) index++         // down
	    if (!~index)                                    index = 0

	    $items.eq(index).focus()
	})

});

