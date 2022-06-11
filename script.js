let startlok = prompt('Gdzie się teraz znajdujesz?')
let center;

let weather = {
    "APIkey": "779e41a38c792049c418bb78903ce053",

    fetchWeather: function(city) {
    fetch(
    "https://api.openweathermap.org/data/2.5/weather?q="
    +city
    +"&units=metric&appid="
    +this.APIkey
    )
    .then((response) => {
        if (!response.ok) {
          alert("No weather found.");
          throw new Error("No weather found.");
        }
        return response.json();
      })
    .then((data) => {
      this.DisplayWeather(data)
      center = {lat: data.coord.lat, lng: data.coord.lon};
    })
    },

    fetchWeatherCoords: function(coords) {
      let crds = JSON.parse(coords)
      fetch(
      `https://api.openweathermap.org/data/2.5/weather?lat=${crds.lat}&lon=${crds.lng}&appid=${this.APIkey}&units=metric`)
      .then((response) => {
          if (!response.ok) {
            alert("No weather found.");
            throw new Error("No weather found.");
          }
          return response.json();
        })
      .then((data) => this.DisplayWeather(data))
      },

    DisplayWeather: function(data){
      const { name } = data;
      const { icon, description } = data.weather[0];
      const { temp, humidity, pressure } = data.main;
      const { speed } = data.wind;
      document.querySelector(".city").innerText = "Weather in " + name;
      document.querySelector(".icon").src="https://openweathermap.org/img/wn/" + icon + ".png";
      document.querySelector(".description"). innerText = description;
      document.querySelector(".temp").innerText = temp + "°C";
      document.querySelector(".humidity").innerText = "Humidity: " + humidity + "%";
      document.querySelector(".pressure").innerText = "Pressure: " +pressure +" hPa";
      document.querySelector(".wind").innerText = "Wind speed: " +speed + " km/h";
      //document.querySelector(".weather").classList.remove("loading");
      document.body.style.backgroundImage =
        "url('https://source.unsplash.com/1920x1080/?" + name + "')";
      center = {lat: data.coord.lat, lng: data.coord.lon};
    },

    search:function(name)
    {
        this.fetchWeather(name);
    },
    searchCoords: function(coords){
        this.fetchWeatherCoords(coords)
    }
}

const toggle = document.querySelector("#toggle");
let makeMarkers;
toggle.addEventListener("change", () => {
  if (toggle.checked){
    makeMarkers = true
  } else {
    makeMarkers = false
  }
})

weather.fetchWeather(startlok);

markers = []

function initMap(){

  let config = {
    zoom: 8,
    center: {lat: 52.2230334, lng: 18.2510729}
  }

  let map = new google.maps.Map(document.getElementById('map'), config);
  
  let mrkr;
  google.maps.event.addListener(map, 'click', function(event){
    weather.searchCoords(JSON.stringify(event.latLng.toJSON(), null, 2))
    if(makeMarkers){
      mrkr = event.latLng
      if(toggle.checked) {
        makeMarkers = true
      } else {
        makeMarkers = false
      }
      document.querySelector("#fcont").style.display = "flex"
      //addMarker({coords:event.latLng})
    }
  })

  function addMarker(props){
    let marker = new google.maps.Marker({
      position: props.coords,
      map: map
    })
  }

  document.querySelector(".search button").addEventListener("mousedown", function(){
      weather.search(document.querySelector(".search-bar").value);
    }
  )
  document.querySelector(".search button").addEventListener("mouseup", function(){
    map.setCenter(center)
  }
  )

  document.querySelector("#submitbtn").addEventListener("click", function(){
    addMarker({coords:mrkr});
    document.querySelector("#fcont").style.display = "none"
  }
)
}