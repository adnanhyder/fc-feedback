(function ($) {
	'use strict';
	$('.fc-vote').on('click', function() {
		$('.fc-loading-line').removeClass('fc-hide');
		var btn = $(this);
		btn.addClass('fc-active');
		var fcFrom = $('.fc-feedback-form');
		var voteType = btn.data('vote-type');
		var postId = btn.data('post-id')
		$.ajax({
			type: 'POST',
			url: fcFeedback.ajaxurl,
			data: {
				action: 'fc_submit_vote',
				vote_type: voteType,
				post_id: postId,
				security: fcFeedback.fc_nonce,
			},
			success: function(response) {
				$('.fc-loading-line').remove();
				fcFrom.find('.fc-hide').removeClass('fc-hide');
				fcFrom.find('.fc-vote').off('click'); //removing multiple votes and ajax calls
				fcFrom.find('.fc-vote').removeClass('fc-vote');
				if(response.data.result === 1){
					$('#fc-yes').text(response.data.yes);
					$('#fc-no').text(response.data.no);
					if(response.data.user_answer === 1){
						$('.fc-answer-yes').addClass('fc-active');
					}else{
						$('.fc-answer-no').addClass('fc-active');
					}

				};
			},
			error: function(xhr, status, error) {
				console.error('AJAX error:', status, error);
			}
		});


	});
})(jQuery);
