<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WeatherApp\WeatherService;

$weather = null;
$error = null;
$city = '';

if ($_POST['city'] ?? false) {
    $city = trim($_POST['city']);
    
    if (!empty($city)) {
        try {
            $weatherService = new WeatherService();
            $weather = $weatherService->getWeather($city);
        } catch (Exception $e) {
            $error = "Could not get weather data for '{$city}'. Please check the city name and try again.";
        }
    } else {
        $error = "Please enter a city name.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2d3436;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #636e72;
            font-size: 1.1rem;
        }

        .search-form {
            margin-bottom: 30px;
        }

        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .city-input {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .city-input:focus {
            border-color: #74b9ff;
        }

        .search-btn {
            padding: 15px 30px;
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .search-btn:hover {
            transform: translateY(-2px);
        }

        .weather-card {
            background: linear-gradient(135deg, #00b894, #00a085);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .weather-city {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .weather-temp {
            font-size: 3rem;
            font-weight: bold;
            margin: 20px 0;
        }

        .weather-desc {
            font-size: 1.2rem;
            text-transform: capitalize;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .weather-details {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        .weather-detail {
            text-align: center;
        }

        .weather-detail-label {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 5px;
        }

        .weather-detail-value {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .error {
            background: #ff7675;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .examples {
            text-align: center;
            margin-top: 20px;
            color: #636e72;
            font-size: 0.9rem;
        }

        .examples span {
            display: inline-block;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 15px;
            margin: 2px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .examples span:hover {
            background: #e9ecef;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .input-group {
                flex-direction: column;
            }
            
            .weather-details {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌤️ Weather App</h1>
            <p>Get current weather information for any city</p>
        </div>

        <form method="POST" class="search-form">
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="input-group">
                <input 
                    type="text" 
                    name="city" 
                    class="city-input" 
                    placeholder="Enter city name..." 
                    value="<?= htmlspecialchars($city) ?>"
                    required
                >
                <button type="submit" class="search-btn">Search</button>
            </div>
        </form>

        <?php if ($weather): ?>
            <div class="weather-card">
                <div class="weather-city"><?= htmlspecialchars($weather['city']) ?></div>
                <div class="weather-temp"><?= round($weather['temperature']) ?>°C</div>
                <div class="weather-desc"><?= htmlspecialchars($weather['description']) ?></div>
                
                <div class="weather-details">
                    <div class="weather-detail">
                        <div class="weather-detail-label">Humidity</div>
                        <div class="weather-detail-value"><?= $weather['humidity'] ?>%</div>
                    </div>
                    <div class="weather-detail">
                        <div class="weather-detail-label">Feels Like</div>
                        <div class="weather-detail-value"><?= round($weather['temperature']) ?>°C</div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="examples">
            <p>Try: 
                <span onclick="document.querySelector('.city-input').value='London'; document.querySelector('.search-form').submit();">London</span>
                <span onclick="document.querySelector('.city-input').value='Paris'; document.querySelector('.search-form').submit();">Paris</span>
                <span onclick="document.querySelector('.city-input').value='New York'; document.querySelector('.search-form').submit();">New York</span>
                <span onclick="document.querySelector('.city-input').value='Tokyo'; document.querySelector('.search-form').submit();">Tokyo</span>
            </p>
        </div>
    </div>
</body>
</html>