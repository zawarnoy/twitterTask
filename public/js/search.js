$(document).ready(function () {

	tweets = null;

	$("form button").on("click", function () {

		query = $("#search_field").val();

		$('.content').empty();


		$.get("/find_tweets?query=" + query, function (data) {

			$('.content').append('<ul>');
			tweets = data.statuses;
			data.statuses.forEach(function (tweet) {
				$('.content').append(
					'<li>' +
					tweet.full_text +
					'<p class="text-right">' +
					'<a class="tweet_adding" href="#">Add tweet</a>' +
					'</p>' +
					'</li>');
			});
			$('.content').append('</ul>');
		});
		return false;
	});

	$(document).on('click', '.tweet_adding', function () {

		tweet_index = $(this).index(".tweet_adding");

		$.post(
			'/tweets',
			{
				'twitter_id' : tweets[tweet_index].id,
				'text' : tweets[tweet_index].full_text
			}
		);

		alert('Added');

		return false;
	})
});