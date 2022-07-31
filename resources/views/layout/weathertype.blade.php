@if($forecast->W == 'NA')
	Not available
@elseif($forecast->W == 0)
	Clear night
@elseif($forecast->W == 1)
	Sunny
@elseif($forecast->W == 2)
	Partly cloudy
@elseif($forecast->W == 3)
	Partly cloudy
@elseif($forecast->W == 4)
	Not used
@elseif($forecast->W == 5)
	Mist
@elseif($forecast->W == 6)
	Fog
@elseif($forecast->W == 7)
	Cloudy
@elseif($forecast->W == 8)
	Overcast
@elseif($forecast->W == 9)
	Light shower
@elseif($forecast->W == 10)
	Light shower
@elseif($forecast->W == 11)
	Drizzle
@elseif($forecast->W == 12)
	Light rain
@elseif($forecast->W == 13)
	Heavy shower
@elseif($forecast->W == 14)
	Heavy shower
@elseif($forecast->W == 15)
	Heavy rain
@elseif($forecast->W == 16)
	Sleet shower
@elseif($forecast->W == 17)
	Sleet shower
@elseif($forecast->W == 18)
	Sleet
@elseif($forecast->W == 19)
	Hail shower
@elseif($forecast->W == 20)
	Hail shower
@elseif($forecast->W == 21)
	Hail
@elseif($forecast->W == 22)
	Light snow shower
@elseif($forecast->W == 23)
	Light snow shower
@elseif($forecast->W == 24)
	Light snow
@elseif($forecast->W == 25)
	Heavy snow shower
@elseif($forecast->W == 26)
	Heavy snow shower
@elseif($forecast->W == 27)
	Heavy snow
@elseif($forecast->W == 28)
	Thunder shower
@elseif($forecast->W == 29)
	Thunder shower
@elseif($forecast->W == 30)
	Thunder
@endif