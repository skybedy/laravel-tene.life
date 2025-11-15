import Chart from 'chart.js/auto';
import axios from 'axios';

// Chart instances
let temperatureChart = null;
let pressureChart = null;
let humidityChart = null;
let monthlyTemperatureChart = null;
let monthlyPressureChart = null;
let monthlyHumidityChart = null;
let monthlySeaTemperatureChart = null;

// Current settings
let currentDate = new Date().toISOString().split('T')[0];
let currentYear = new Date().getFullYear();
let currentMonthNum = new Date().getMonth() + 1; // 1-12

// Chart configuration
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false,
        },
        tooltip: {
            mode: 'index',
            intersect: false,
        },
    },
    scales: {
        x: {
            grid: {
                display: true,
                color: 'rgba(0, 0, 0, 0.05)',
            },
        },
        y: {
            grid: {
                display: true,
                color: 'rgba(0, 0, 0, 0.05)',
            },
        },
    },
};

// Initialize charts
function initCharts() {
    const tempCtx = document.getElementById('temperatureChart');
    const pressureCtx = document.getElementById('pressureChart');
    const humidityCtx = document.getElementById('humidityChart');

    if (tempCtx) {
        temperatureChart = new Chart(tempCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                    },
                },
            },
        });
    }

    if (pressureCtx) {
        pressureChart = new Chart(pressureCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                    },
                },
            },
        });
    }

    if (humidityCtx) {
        humidityChart = new Chart(humidityCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(168, 85, 247)',
                        backgroundColor: 'rgba(168, 85, 247, 0.1)',
                        tension: 0.4,
                        fill: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                        min: 0,
                        max: 100,
                    },
                },
            },
        });
    }

    // Monthly charts
    const monthlyTempCtx = document.getElementById('monthlyTemperatureChart');
    const monthlyPressureCtx = document.getElementById('monthlyPressureChart');
    const monthlyHumidityCtx = document.getElementById('monthlyHumidityChart');
    const monthlySeaTempCtx = document.getElementById('monthlySeaTemperatureChart');

    if (monthlyTempCtx) {
        monthlyTemperatureChart = new Chart(monthlyTempCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4,
                        fill: true,
                        spanGaps: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                    },
                },
            },
        });
    }

    if (monthlyPressureCtx) {
        monthlyPressureChart = new Chart(monthlyPressureCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true,
                        spanGaps: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                    },
                },
            },
        });
    }

    if (monthlyHumidityCtx) {
        monthlyHumidityChart = new Chart(monthlyHumidityCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(168, 85, 247)',
                        backgroundColor: 'rgba(168, 85, 247, 0.1)',
                        tension: 0.4,
                        fill: true,
                        spanGaps: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                        min: 0,
                        max: 100,
                    },
                },
            },
        });
    }

    if (monthlySeaTempCtx) {
        monthlySeaTemperatureChart = new Chart(monthlySeaTempCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: '',
                        data: [],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        spanGaps: true,
                    },
                ],
            },
            options: {
                ...chartOptions,
                scales: {
                    ...chartOptions.scales,
                    y: {
                        ...chartOptions.scales.y,
                    },
                },
            },
        });
    }
}

// Calculate statistics from data array
function calculateStats(data) {
    if (data.length === 0) {
        return { avg: 0, min: 0, max: 0 };
    }
    
    const sum = data.reduce((a, b) => a + b, 0);
    const avg = sum / data.length;
    const min = Math.min(...data);
    const max = Math.max(...data);
    
    return {
        avg: Math.round(avg * 10) / 10,
        min: Math.round(min * 10) / 10,
        max: Math.round(max * 10) / 10
    };
}

// Load data and update charts
async function loadData() {
    try {
        const response = await axios.get('/api/weather/hourly', {
            params: {
                date: currentDate,
            },
        });

        const data = response.data;

        // Calculate statistics
        const tempStats = calculateStats(data.datasets.temperature);
        const pressureStats = calculateStats(data.datasets.pressure);
        const humidityStats = calculateStats(data.datasets.humidity);

        // Update temperature chart and stats
        if (temperatureChart) {
            temperatureChart.data.labels = data.labels;
            temperatureChart.data.datasets[0].data = data.datasets.temperature;
            temperatureChart.update();
        }
        document.getElementById('stat-temp-avg').textContent = tempStats.avg + ' °C';
        document.getElementById('stat-temp-min').textContent = tempStats.min + ' °C';
        document.getElementById('stat-temp-max').textContent = tempStats.max + ' °C';

        // Update pressure chart and stats
        if (pressureChart) {
            pressureChart.data.labels = data.labels;
            pressureChart.data.datasets[0].data = data.datasets.pressure;
            pressureChart.update();
        }
        document.getElementById('stat-pressure-avg').textContent = pressureStats.avg + ' hPa';
        document.getElementById('stat-pressure-min').textContent = pressureStats.min + ' hPa';
        document.getElementById('stat-pressure-max').textContent = pressureStats.max + ' hPa';

        // Update humidity chart and stats
        if (humidityChart) {
            humidityChart.data.labels = data.labels;
            humidityChart.data.datasets[0].data = data.datasets.humidity;
            humidityChart.update();
        }
        document.getElementById('stat-humidity-avg').textContent = Math.round(humidityStats.avg) + ' %';
        document.getElementById('stat-humidity-min').textContent = Math.round(humidityStats.min) + ' %';
        document.getElementById('stat-humidity-max').textContent = Math.round(humidityStats.max) + ' %';
        
    } catch (error) {
        console.error('Error loading data:', error);
    }
}

// Load monthly data and update charts
async function loadMonthlyData() {
    try {
        const response = await axios.get('/api/weather/monthly-daily', {
            params: {
                year: currentYear,
                month: currentMonthNum,
            },
        });

        const data = response.data;

        // Update monthly temperature chart
        if (monthlyTemperatureChart) {
            monthlyTemperatureChart.data.labels = data.labels;
            monthlyTemperatureChart.data.datasets[0].data = data.datasets.avg_temperature;
            monthlyTemperatureChart.update();
        }

        // Update monthly pressure chart
        if (monthlyPressureChart) {
            monthlyPressureChart.data.labels = data.labels;
            monthlyPressureChart.data.datasets[0].data = data.datasets.avg_pressure;
            monthlyPressureChart.update();
        }

        // Update monthly humidity chart
        if (monthlyHumidityChart) {
            monthlyHumidityChart.data.labels = data.labels;
            monthlyHumidityChart.data.datasets[0].data = data.datasets.avg_humidity;
            monthlyHumidityChart.update();
        }

        // Update monthly sea temperature chart
        if (monthlySeaTemperatureChart) {
            monthlySeaTemperatureChart.data.labels = data.labels;
            monthlySeaTemperatureChart.data.datasets[0].data = data.datasets.sea_temperature;
            monthlySeaTemperatureChart.update();
        }

    } catch (error) {
        console.error('Error loading monthly data:', error);
    }
}

// Setup event listeners
function setupEventListeners() {
    // Date picker for hourly data
    const dateInput = document.getElementById('selectedDate');
    if (dateInput) {
        dateInput.addEventListener('change', (e) => {
            currentDate = e.target.value;
            loadData();
        });
    }

    // Month and year pickers for monthly data
    const monthNumInput = document.getElementById('selectedMonthNum');
    const yearInput = document.getElementById('selectedYear');

    if (monthNumInput) {
        monthNumInput.addEventListener('change', (e) => {
            currentMonthNum = parseInt(e.target.value);
            // Check if this month/year combination is valid (not in the future, not before Nov 2025)
            const selectedDate = new Date(currentYear, currentMonthNum - 1, 1);
            const minDate = new Date(2025, 10, 1); // Nov 2025
            const today = new Date();

            if (selectedDate >= minDate && selectedDate <= today) {
                loadMonthlyData();
            }
        });
    }

    if (yearInput) {
        yearInput.addEventListener('change', (e) => {
            currentYear = parseInt(e.target.value);
            // Check if this month/year combination is valid
            const selectedDate = new Date(currentYear, currentMonthNum - 1, 1);
            const minDate = new Date(2025, 10, 1); // Nov 2025
            const today = new Date();

            if (selectedDate >= minDate && selectedDate <= today) {
                loadMonthlyData();
            }
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initCharts();
    setupEventListeners();
    loadData();
    loadMonthlyData();
});
