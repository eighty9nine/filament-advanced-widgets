const preset = require('./vendor/filament/filament/tailwind.config.preset')

module.exports = {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './src/AdvancedStatsOverviewWidget/Concerns/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
