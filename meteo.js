const iconElement = document.querySelector('.weather-icon');
const tempElement = document.querySelector('.temperature-value p');
/*const descElement = document.querySelector('.temperature-description p');*/
const locationElement = document.querySelector('.location p');

// App data
const weather = {};

weather.temperature = {
  unit: 'celsius',
};

// APP CONSTS AND VARS
const KELVIN = 273;
// API KEY
const key = 'e579eb14195b507d00639fe38dcb21a8';

// GET WEATHER FROM API PROVIDER
function getWeather() {
  let api = `http://api.openweathermap.org/data/2.5/weather?q=Bourges,fr&APPID=e579eb14195b507d00639fe38dcb21a8`;

  fetch(api)
    .then(function (response) {
      let data = response.json();
      return data;
    })
    .then(function (data) {
      weather.temperature.value = Math.floor(data.main.temp - KELVIN);
      weather.description = data.weather[0].description;
      weather.iconId = data.weather[0].icon;
      weather.city = data.name;
      weather.country = data.sys.country;
      displayWeather(weather);
    });
}

// DISPLAY WEATHER TO UI
function displayWeather(weather) {
  iconElement.innerHTML = `<img src="public/icons/${weather.iconId}.png"/>`;
  tempElement.innerHTML = `${weather.temperature.value}°<span>C</span>`;
  /*descElement.innerHTML = weather.description;*/
  locationElement.innerHTML = `${weather.city}, ${weather.country}`;
  console.log('displayWeather' + weather);
}

// C to F conversion
function celsiusToFahrenheit(temperature) {
  return (temperature * 9) / 5 + 32;
}

// WHEN THE USER CLICKS ON THE TEMPERATURE ELEMENET
tempElement.addEventListener('click', function () {
  if (weather.temperature.value === undefined) return;

  if (weather.temperature.unit == 'celsius') {
    let fahrenheit = celsiusToFahrenheit(weather.temperature.value);
    fahrenheit = Math.floor(fahrenheit);

    tempElement.innerHTML = `${fahrenheit}°<span>F</span>`;
    weather.temperature.unit = 'fahrenheit';
  } else {
    tempElement.innerHTML = `${weather.temperature.value}°<span>C</span>`;
    weather.temperature.unit = 'celsius';
  }
});

document.getElementById('btn_meteo').addEventListener('click', function () {
  console.log('click_btn');
  getWeather();
});
