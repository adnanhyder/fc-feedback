(function ($) {
	'use strict';
	$('.fc-vote').on('click', function() {
		var voteType = $(this).data('vote-type');
		var postId = $(this).data('post-id')
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
				console.log(response)
			},
			error: function(xhr, status, error) {
				console.error('AJAX error:', status, error);
			}
		});


	});
})(jQuery);
