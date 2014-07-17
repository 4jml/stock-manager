stockManager.directive('morrisDonut', function(Restangular) {
	return {
		scope: {
			participant: '=',
		},
		link: function(scope, element, attrs) {
			var update = function () {

				$http.get(attrs.url).success(function(data){
					if (data.length > 0)
					{
						$(element).empty();
						new Morris.Donut(
						{
							element: attrs.id,
							data: data,
									// colors : [ '#428bca' , '#5cb85c' , '#5bc0de' , '#f0ad4e' , '#d9534f' ],
									formatter: function (y) { return y + " €" }
								});
					}
					else
					{
						$(element).html('<span class="updated">Aucune entrée.</span>');
					}
				});
			}
			update();
			// scope.$watch("participant.take", update);
		}
	};
}).
directive('morrisLine', function(Restangular) {
	return {
		link: function(scope, element, attrs) {
			$http.get('purchases-stats/label/' + attrs.labelId).success(function(data){
				if (data.length > 0)
				{
					$(element).empty();
					new Morris.Line(
					{
						element: attrs.id,
						data: data,
						lineColors : [ '#428bca' , '#5cb85c' , '#5bc0de' , '#f0ad4e' , '#d9534f' ],
						xkey: 'x',
						ykeys: ['y'],
						labels: ['Valeur'],
						xLabelAngle: 60
					});
				}
			});
		}
	};
});