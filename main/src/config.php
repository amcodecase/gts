<?php

namespace MyLibrary;

class Config
{
    private $settings = [
        'SITE_NAME' => 'Greentech SES',
        'SITE_URL' => 'https://gtsengineeringzm.net',
        'INDUSTRY' => 'Engineering & Contruction Services',
        'FOCUS' => 'Electrical, Mechanical, Civil Engineering, Renewable Energy Solutions',
        'LOCATION' => 'Plot 3020, Luapula House, Old Woodlands Shopping Complex, 1st Floor, Eastern Wing - Mosi-O-Tunya Road, Woodlands, Lusaka, Zambia',
        'CONTACT_EMAIL' => 'info@gtsengineeringzm.net',
        'SUPPORT_EMAIL' => 'support@gtsengineeringzm.net',
    ];

    // Method to fetch a particular setting by key
    public function get($key)
    {
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }
}
