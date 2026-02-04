# Weather App - Web Interface

A beautiful, responsive web interface for the PHP Weather Application.

## 🚀 Quick Start

### Option 1: Demo Mode (Works Immediately)
```bash
php -S localhost:8000 -t public
```
Then visit: http://localhost:8000/demo.php

### Option 2: Live API Mode (Requires Valid API Key)
```bash
php -S localhost:8000 -t public
```
Then visit: http://localhost:8000/

## 📁 Project Structure

```
WeatherApp/
├── public/
│   ├── index.php      # Main web interface (requires API key)
│   └── demo.php       # Demo version with mock data
├── src/
│   └── WeatherService.php  # Weather API service
├── weather.php        # CLI version
└── server.php         # Development server router
```

## 🎨 Features

- **Responsive Design** - Works on desktop, tablet, and mobile
- **Modern UI** - Clean, gradient-based design with animations
- **Error Handling** - User-friendly error messages
- **Quick Examples** - Click-to-try popular cities
- **Real-time Data** - Uses OpenWeatherMap API
- **Demo Mode** - Test the interface without API key

## 🔧 API Key Setup

1. Get a free API key from [OpenWeatherMap](https://openweathermap.org/api)
2. Replace the API key in `src/WeatherService.php`:
   ```php
   private string $apiKey = 'YOUR_API_KEY_HERE';
   ```
3. Wait 10-60 minutes for the key to activate
4. Use the main interface at http://localhost:8000/

## 🌐 URLs

- **Main App**: http://localhost:8000/ (requires API key)
- **Demo Mode**: http://localhost:8000/demo.php (works immediately)

## 📱 Mobile Responsive

The interface automatically adapts to different screen sizes:
- Desktop: Side-by-side layout
- Mobile: Stacked layout with touch-friendly buttons

## 🎯 Usage

1. Enter any city name in the search box
2. Click "Search" or press Enter
3. View current weather information including:
   - Temperature
   - Weather description
   - Humidity
   - City name

## 🛠️ Development

To modify the interface:
- Edit `public/index.php` for the main app
- Edit `public/demo.php` for the demo version
- CSS is embedded in the HTML files for simplicity

## 🔄 From CLI to Web

Your existing CLI application (`weather.php`) and the new web interface both use the same `WeatherService` class, demonstrating good code reusability!