@if($forecast->W == 'NA')
	<img src="/weather/unknown.png">
@elseif($forecast->W == 0)
	<img src="/weather/clearnight.png">
@elseif($forecast->W == 1)
	<img src="/weather/clear.png">
@elseif($forecast->W == 2)
	<img src="/weather/cloudynight.png">
@elseif($forecast->W == 3)
	<img src="/weather/partlycloudy.png">
@elseif($forecast->W == 4)
	<img src="/weather/unknown.png">
@elseif($forecast->W == 5)
	<img src="/weather/hazy.png">
@elseif($forecast->W == 6)
	<img src="/weather/fog.png">
@elseif($forecast->W == 7)
	<img src="/weather/cloudy.png">
@elseif($forecast->W == 8)
	<img src="/weather/cloudy.png">
@elseif($forecast->W == 9)
	<img src="/weather/flurries.png">
@elseif($forecast->W == 10)
	<img src="/weather/flurries.png">
@elseif($forecast->W == 11)
	<img src="/weather/flurries.png">
@elseif($forecast->W == 12)
	<img src="/weather/flurries.png">
@elseif($forecast->W == 13)
	<img src="/weather/rain03.png">
@elseif($forecast->W == 14)
	<img src="/weather/rain03.png">
@elseif($forecast->W == 15)
	<img src="/weather/rain03.png">
@elseif($forecast->W == 16)
	<img src="/weather/sleet.png">
@elseif($forecast->W == 17)
	<img src="/weather/sleet.png">
@elseif($forecast->W == 18)
	<img src="/weather/sleet.png">
@elseif($forecast->W == 19)
	<img src="/weather/freezingrain.png">
@elseif($forecast->W == 20)
	<img src="/weather/freezingrain.png">
@elseif($forecast->W == 21)
	<img src="/weather/freezingrain.png">
@elseif($forecast->W == 22)
	<img src="/weather/snow.png">
@elseif($forecast->W == 23)
	<img src="/weather/snow.png">
@elseif($forecast->W == 24)
	<img src="/weather/snow.png">
@elseif($forecast->W == 25)
	<img src="/weather/freezingsnow.png">
@elseif($forecast->W == 26)
	<img src="/weather/freezingsnow.png">
@elseif($forecast->W == 27)
	<img src="/weather/freezingsnow.png">
@elseif($forecast->W == 28)
	<img src="/weather/storm.png" width="80px">
@elseif($forecast->W == 29)
	<img src="/weather/storm.png" width="80px">
@elseif($forecast->W == 30)
	<img src="/weather/thunder.png">
@endif