define(
	['jquery'],
	function($) {
		$('#campaign').on('change', function () {
			$('#campaignList').submit();
		});
	}
);
