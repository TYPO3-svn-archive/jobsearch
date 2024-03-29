$(function() {

	var jobsearchForm = $('.tx-jobsearch-pi1').find('.jobsearchfields');
	var jobOfferList = $('.tx-jobsearch-pi1').find('.jobofferlist');
	var noJobsMessage = $('.tx-jobsearch-pi1').find('.message-nojobs');
	var jobsearchAjaxSelectors = jobsearchForm.find('select');
	
	var url = jobsearchForm.attr('action');
	if(url.indexOf("?") == '-1') {
		var firstChar = '?';
	} else {
		var firstChar = '&';
	}
	
	function showAjaxWaitingMode() {
		jobOfferList.addClass('ajax-waiting');
	}
	
	function hideAjaxWaitingMode() {
		jobOfferList.removeClass('ajax-waiting');
	}
	
	noJobsMessage.hide();
	
	jobsearchForm.show();
	jobsearchAjaxSelectors.each(function(){
		$(this).change(function(){
			var ajaxUrl = url + firstChar;
			jobsearchAjaxSelectors.each(function(){
				var selector = $(this);
				ajaxUrl = ajaxUrl + selector.attr('name') + '=' + selector.val() + '&';
			});
			showAjaxWaitingMode();
			$.get(ajaxUrl, function(data){
					
					// Hide all
				jobOfferList.find('li').hide();
				
					// Show results
				var resultIds = $.trim(data).split(',');
				$(resultIds).each(function(){
					jobOfferList.find('li#joboffer-' + this).show();
				});
				//console.log($(resultIds)[0]);
				if($(resultIds)[0] == '') {
					noJobsMessage.show();
				} else {
					noJobsMessage.hide();
				}
				
				hideAjaxWaitingMode();
			});
		});
	});
});