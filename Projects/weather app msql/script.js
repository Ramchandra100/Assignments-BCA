async function getWeather() {
    const location = document.getElementById('location').value;
    const apiKey = '53f567eca4d14026999153850251203'; // Provided API key
    const apiUrl = `http://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${location}&aqi=yes`;

    if (!location) {
        alert('Please enter a location!');
        return;
    }

    try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        if (data.error) {
            document.getElementById('weather-info').innerHTML = `<div class="error">City not found. Please try again.</div>`;
            return;
        }

        const weatherInfo = `
            <div class="weather-detail"><strong>Location:</strong> ${data.location.name}, ${data.location.country}</div>
            <div class="weather-detail"><strong>Temperature:</strong> ${data.current.temp_c}°C</div>
            <div class="weather-detail"><strong>Condition:</strong> ${data.current.condition.text}</div>
            <div class="weather-detail"><strong>Humidity:</strong> ${data.current.humidity}%</div>
            <div class="weather-detail"><strong>Wind Speed:</strong> ${data.current.wind_kph} km/h</div>
            <div class="weather-detail"><strong>Air Quality:</strong> ${data.current.air_quality.pm10} µg/m³ (PM10)</div>
            <div class="weather-detail"><strong>UV Index:</strong> ${data.current.uv}</div>
        `;

        document.getElementById('weather-info').innerHTML = weatherInfo;
    } catch (error) {
        console.error('Error fetching weather data:', error);
        document.getElementById('weather-info').innerHTML = `<div class="error">There was an issue retrieving weather data. Please try again.</div>`;
    }
}
