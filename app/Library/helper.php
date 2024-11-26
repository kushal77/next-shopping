<?php

require 'functions.php';

if (!function_exists('pluckRegionNames')) {
    function pluckRegionNames()
    {
        return [
            'Mechi' => 'Mechi',
            'Koshi' => 'Koshi',
            'Sagarmatha' => 'Sagarmatha',
            'Janakpur' => 'Janakpur',
            'Bagmati' => 'Bagmati',
            'Narayani' => 'Narayani',
            'Gandaki' => 'Gandaki',
            'Lumbini' => 'Lumbini',
            'Dhawalagiri' => 'Dhawalagiri',
            'Rapti' => 'Rapti',
            'Karnali' => 'Karnali',
            'Bheri' => 'Bheri',
            'Seti' => 'Seti',
            'Mahakali' => 'Mahakali'
        ];
    }
}

if (!function_exists('pluckCityNames')) {
    function pluckCityNames()
    {
        return [
            'Baneshwor' => 'Baneshwor',
            'Bhaktapur' => 'Bhaktapur',
            'Kathmandu' => 'Kathmandu',
            'Koteshwor' => 'Koteshwor',
            'Lalitpur' => 'Lalitpur',
            'Maitighar' => 'Maitighar',
            'Satdobato' => 'Satdobato'
        ];
    }
}

if (!function_exists('apiPluckRegionNames')) {
    function apiPluckRegionNames()
    {
        return [
            'Mechi',
            'Koshi',
            'Sagarmatha',
            'Janakpur',
            'Bagmati',
            'Narayani',
            'Gandaki',
            'Lumbini',
            'Dhawalagiri',
            'Rapti',
            'Karnali',
            'Bheri',
            'Seti',
            'Mahakali'
        ];
    }
}

if (!function_exists('apiPluckCityNames')) {
    function apiPluckCityNames()
    {
        return [
            'Baneshwor',
            'Bhaktapur',
            'Kathmandu',
            'Koteshwor',
            'Lalitpur',
            'Maitighar',
            'Satdobato'
        ];
    }
}