<!DOCTYPE html>
<html>
<head>
	<title>Where Was The ISS at?</title>
	 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

</head>


   <style type="text/css">
   	
   	#issMap { height: 300px;
   				width: 600px; }
   </style>
<body>


	<p>
		Set Date : <input id="date" type="date"></br></br>
		Set Time :<input id="time" type="time"></br></br>
		<button id="submit" type="submit" onclick="getISS()">Submit</button></br></br>


		


		<span id="minutesplus6"></span> :<span id="locationplus6"></span></br>
		<span id="minutesplus5"></span> :<span id="locationplus5"></span></br>
		<span id="minutesplus4"></span> :<span id="locationplus4"></span></br>
		<span id="minutesplus3"></span> :<span id="locationplus3"></span></br>
		<span id="minutesplus2"></span> :<span id="locationplus2"></span></br>
		<span id="minutesplus1"></span> :<span id="locationplus1"></span></br>
		<span id="timeselected"></span> : <span id="locationselected"></span></br>
		<span id="minutesminus1"></span> :<span id="locationminus1"></span></br>
		<span id="minutesminus2"></span> :<span id="locationminus2"></span></br>
		<span id="minutesminus3"></span> :<span id="locationminus3"></span></br>
		<span id="minutesminus4"></span> :<span id="locationminus4"></span></br>
		<span id="minutesminus5"></span> :<span id="locationminus5"></span></br>
		<span id="minutesminus6"></span> :<span id="locationminus6"></span></br>


	</p>
	<div id="issMap"></div>

	<p>
		<h3>Current astronaut who are at the ISS right now:</h3></br></br>
		<span id="astros"></span>  
	</p>
	<ul>
		<script >
		astros_url = "http://api.open-notify.org/astros.json" 

		async function getAstros(){

		const astrosresponse = await fetch(astros_url)
		const astrosdata = await astrosresponse.json()

		people = astrosdata.people
		console.log(people)


		for(i=0;i<astrosdata.people.length;i++){

			if(astrosdata.people[i].craft == 'ISS'){

			console.log(astrosdata.people[i].name)

			}

		}
		
			}
			getAstros();
		</script>
	</ul>


	<script>


		const mymap = L.map('issMap').setView([0, 0], 1); 

		const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		const tile_url ='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
		const tiles = L.tileLayer(tile_url,{attribution});
		tiles.addTo(mymap);

		//MAIN API URL TO GET JSON DATA
		const api_url ='https://api.wheretheiss.at/v1/';

		async function getISS(){

		var datesubmit = document.getElementById("date").value;
		var timesubmit = document.getElementById("time").value;
		var position ='positions?timestamps=' ;
		var coordinates= 'coordinates';
		var satellite = 'satellites';
		var units = '&units=miles';
		var id='25544'

		datetime = datesubmit + " " + timesubmit;

		//GET TIME 1 HOUR BEFORE AND 1 HOUR AFTER
		var myDate = new Date(datetime);
		var minutesToAdd=10;
		var minutesplus1 = new Date(myDate.getTime() + (minutesToAdd*60000));
		var minutesplus2 = new Date(minutesplus1.getTime() + (minutesToAdd*60000));
		var minutesplus3 = new Date(minutesplus2.getTime() + (minutesToAdd*60000));
		var minutesplus4 = new Date(minutesplus3.getTime() + (minutesToAdd*60000));
		var minutesplus5 = new Date(minutesplus4.getTime() + (minutesToAdd*60000));
		var minutesplus6 = new Date(minutesplus5.getTime() + (minutesToAdd*60000));


		var minutesToMinus = -10;
		var minutesminus1 = new Date(myDate.getTime() + (minutesToMinus*60000));
		var minutesminus2 = new Date(minutesminus1.getTime() + (minutesToMinus*60000));
		var minutesminus3 = new Date(minutesminus2.getTime() + (minutesToMinus*60000));
		var minutesminus4 = new Date(minutesminus3.getTime() + (minutesToMinus*60000));
		var minutesminus5 = new Date(minutesminus4.getTime() + (minutesToMinus*60000));
		var minutesminus6 = new Date(minutesminus5.getTime() + (minutesToMinus*60000));

		document.getElementById('timeselected').textContent=myDate;
		document.getElementById('minutesplus1').textContent=minutesplus1;
		document.getElementById('minutesplus2').textContent=minutesplus2;
		document.getElementById('minutesplus3').textContent=minutesplus3;
		document.getElementById('minutesplus4').textContent=minutesplus4;
		document.getElementById('minutesplus5').textContent=minutesplus5;
		document.getElementById('minutesplus6').textContent=minutesplus6;

		document.getElementById('minutesminus1').textContent=minutesminus1;
		document.getElementById('minutesminus2').textContent=minutesminus2;
		document.getElementById('minutesminus3').textContent=minutesminus3;
		document.getElementById('minutesminus4').textContent=minutesminus4;
		document.getElementById('minutesminus5').textContent=minutesminus5;
		document.getElementById('minutesminus6').textContent=minutesminus6;



		//CONVERT NORMAL  TIME TO TIMESTAMP
		chosenTime = myDate / 1000;

		timePlus1 = minutesplus1 /1000;
		timePlus2 = minutesplus2 /1000;
		timePlus3 = minutesplus3 /1000;
		timePlus4 = minutesplus4 /1000;
		timePlus5 = minutesplus5 /1000;
		timePlus6 = minutesplus6 /1000;

		timeMinus1 = minutesminus1 /1000;
		timeMinus2 = minutesminus2 /1000;
		timeMinus3 = minutesminus3 /1000;
		timeMinus4 = minutesminus4 /1000;
		timeMinus5 = minutesminus5 /1000;
		timeMinus6 = minutesminus6 /1000;

		//GET API_URL FOR POSITION FOR EACH TIMESTAMPS 
		var position_url = api_url +satellite+'/'+id+'/'+ position + chosenTime + ","+timePlus1 + "," + timePlus2 + "," + timePlus3 + "," + timePlus4 + "," + timePlus5 + "," + timePlus6 + "," + timeMinus1+ "," + timeMinus2+ "," + timeMinus3+ "," + timeMinus4+ "," + timeMinus5+ "," + timeMinus6+ units;


		console.log(position_url);

		const response = await fetch(position_url);
		const data = await response.json();


		//GET LATITUDE AND LONGITUDE OF EACH POSITIONS
		var TimeNormalLat=data[0].latitude;
		var TimeNormalLong=data[0].longitude;

		var TimeNormal = TimeNormalLat + ','+ TimeNormalLong;
		L.marker([TimeNormalLat,TimeNormalLong]).addTo(mymap);


		var TimeAdd1Lat=data[1].latitude;
		var TimeAdd1Long=data[1].longitude;

		var TimeAdd1 = TimeAdd1Lat + ','+ TimeAdd1Long;
		L.marker([TimeAdd1Lat,TimeAdd1Long]).addTo(mymap);


		var TimeAdd2Lat=data[2].latitude;
		var TimeAdd2Long=data[2].longitude;

		var TimeAdd2 = TimeAdd2Lat + ','+ TimeAdd2Long;
		L.marker([TimeAdd2Lat,TimeAdd2Long]).addTo(mymap);


		var TimeAdd3Lat=data[3].latitude;
		var TimeAdd3Long=data[3].longitude;

		var TimeAdd3 = TimeAdd3Lat + ','+ TimeAdd3Long;
		L.marker([TimeAdd3Lat,TimeAdd3Long]).addTo(mymap);


		var TimeAdd4Lat=data[4].latitude;
		var TimeAdd4Long=data[4].longitude;

		var TimeAdd4 = TimeAdd4Lat + ','+ TimeAdd4Long;
		L.marker([TimeAdd4Lat,TimeAdd4Lat]).addTo(mymap);

		var TimeAdd5Lat=data[5].latitude;
		var TimeAdd5Long=data[5].longitude;

		var TimeAdd5 = TimeAdd5Lat + ','+ TimeAdd5Long;
		L.marker([TimeAdd5Lat,TimeAdd5Long]).addTo(mymap);

		var TimeAdd6Lat=data[6].latitude;
		var TimeAdd6Long=data[6].longitude;

		var TimeAdd6 = TimeAdd6Lat + ','+ TimeAdd6Long;
		L.marker([TimeAdd6Lat,TimeAdd6Long]).addTo(mymap);

		var TimeMinus1Lat=data[7].latitude;
		var TimeMinus1Long=data[7].longitude;

		var TimeMinus1 = TimeMinus1Lat + ','+ TimeMinus1Long;
		L.marker([TimeMinus1Lat,TimeMinus1Long]).addTo(mymap);

		var TimeMinus2Lat=data[8].latitude;
		var TimeMinus2Long=data[8].longitude;

		var TimeMinus2 = TimeMinus2Lat + ','+ TimeMinus2Long;
		L.marker([TimeMinus2Lat,TimeMinus2Long]).addTo(mymap);

		var TimeMinus3Lat=data[9].latitude;
		var TimeMinus3Long=data[9].longitude;

		var TimeMinus3 = TimeMinus3Lat + ','+ TimeMinus3Long;
		L.marker([TimeMinus3Lat,TimeMinus3Long]).addTo(mymap);

		var TimeMinus4Lat=data[10].latitude;
		var TimeMinus4Long=data[10].longitude;

		var TimeMinus4 = TimeMinus4Lat + ','+ TimeMinus4Long;
		L.marker([TimeMinus4Lat,TimeMinus4Long]).addTo(mymap);

		var TimeMinus5Lat=data[11].latitude;
		var TimeMinus5Long=data[11].longitude;

		var TimeMinus5 = TimeMinus5Lat + ','+ TimeMinus5Long;
		L.marker([TimeMinus5Lat,TimeMinus5Long]).addTo(mymap);

		var TimeMinus6Lat=data[12].latitude;
		var TimeMinus6Long=data[12].longitude;

		var TimeMinus6 = TimeMinus6Lat + ','+ TimeMinus6Long;
		L.marker([TimeMinus6Lat,TimeMinus6Long]).addTo(mymap);


		//GET API_URL FOR EACH COORDINATE OF TIMESTAMPS
		var coordinate_NormalTime = api_url + coordinates +'/'+ TimeNormal;		
		var coordinate_Time1 = api_url + coordinates +'/'+ TimeAdd1;
		var coordinate_Time2 = api_url + coordinates +'/'+ TimeAdd2;
		var coordinate_Time3 = api_url + coordinates +'/'+ TimeAdd3 ;
		var coordinate_Time4 = api_url + coordinates +'/'+ TimeAdd4;
		var coordinate_Time5 = api_url + coordinates +'/'+ TimeAdd5 ;
		var coordinate_Time6 = api_url + coordinates +'/'+ TimeAdd6;
		var coordinate_TimeMinus1 = api_url + coordinates +'/'+ TimeMinus1 ;
		var coordinate_TimeMinus2 = api_url + coordinates +'/'+ TimeMinus2 ;
		var coordinate_TimeMinus3 = api_url + coordinates +'/'+ TimeMinus3 ;
		var coordinate_TimeMinus4 = api_url + coordinates +'/'+ TimeMinus4 ;
		var coordinate_TimeMinus5 = api_url + coordinates +'/'+ TimeMinus5 ;
		var coordinate_TimeMinus6 = api_url + coordinates +'/'+ TimeMinus6 ;

		//GET DATA FOR LOCATION OF EACH TIMESTAMPS

		//timestamp normal
		const response2 = await fetch(coordinate_NormalTime);
		const normaltimedata = await response2.json();
		var normaltimelocation = normaltimedata.timezone_id;
		console.log(normaltimelocation);
		document.getElementById('locationselected').textContent=normaltimelocation;


		//timestamp +1
		const response3 = await fetch(coordinate_Time1);
		const time1data = await response3.json();
		var timeplus1location = time1data.timezone_id;	
		console.log(timeplus1location);
		document.getElementById('locationplus1').textContent=timeplus1location;


		//timestamp +2
		const response4 = await fetch(coordinate_Time2);
		const time2data = await response4.json();
		var timeplus2location = time2data.timezone_id;	
		console.log(timeplus2location);
		document.getElementById('locationplus2').textContent=timeplus2location;


		//timestamp +3
		const response5 = await fetch(coordinate_Time3);
		const time3data = await response5.json();
		var timeplus3location = time3data.timezone_id;	
		console.log(timeplus3location);
		document.getElementById('locationplus3').textContent=timeplus3location;


		//timestamp +4
		const response6 = await fetch(coordinate_Time4);
		const time4data = await response6.json();
		var timeplus4location = time4data.timezone_id;	
		console.log(timeplus4location);
		document.getElementById('locationplus4').textContent=timeplus4location;


		//timestamp +5
		const response7 = await fetch(coordinate_Time5);
		const time5data = await response7.json();
		var timeplus5location = time5data.timezone_id;	
		console.log(timeplus5location);
		document.getElementById('locationplus5').textContent=timeplus5location;


		//timestamp +6
		const response8 = await fetch(coordinate_Time6);
		const time6data = await response8.json();
		var timeplus6location = time6data.timezone_id;	
		console.log(timeplus6location);
		document.getElementById('locationplus6').textContent=timeplus6location;


		//timestamp -1
		const response9 = await fetch(coordinate_TimeMinus1);
		const timeminus1data = await response9.json();
		var timeminus1location = timeminus1data.timezone_id;	
		console.log(timeminus1location);
		document.getElementById('locationminus1').textContent=timeminus1location;


		//timestamp -2
		const response10 = await fetch(coordinate_TimeMinus2);
		const timeminus2data = await response10.json();
		var timeminus2location = timeminus2data.timezone_id;	
		console.log(timeminus2location);
		document.getElementById('locationminus2').textContent=timeminus2location;


		//timestamp -1
		const response11 = await fetch(coordinate_TimeMinus3);
		const timeminus3data = await response11.json();
		var timeminus3location = timeminus3data.timezone_id;	
		console.log(timeminus3location);
		document.getElementById('locationminus3').textContent=timeminus3location;

		//timestamp -1
		const response12 = await fetch(coordinate_TimeMinus4);
		const timeminus4data = await response12.json();
		var timeminus4location = timeminus4data.timezone_id;	
		console.log(timeminus4location);
		document.getElementById('locationminus4').textContent=timeminus4location;

		//timestamp -1
		const response13 = await fetch(coordinate_TimeMinus5);
		const timeminus5data = await response13.json();
		var timeminus5location = timeminus5data.timezone_id;	
		console.log(timeminus5location);
		document.getElementById('locationminus5').textContent=timeminus5location;

		//timestamp -1
		const response14 = await fetch(coordinate_TimeMinus6);
		const timeminus6data = await response14.json();
		var timeminus6location = timeminus6data.timezone_id;	
		console.log(timeminus6location);
		document.getElementById('locationminus6').textContent=timeminus6location;

		


		


		}

	</script>

</body>
</html>