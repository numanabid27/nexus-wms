<?php

class StatusHelper
{
    public static function billing_model($value)
    {
        
        switch ($value) {
            case 1: return __('contract');
            case 2: return __('per_lift');
            default: return 'Unknown';
        }
    }

    public static function schedules($value)
    {
        
        switch ($value) {
            case 1: return __('daily_7');
            case 2: return __('daily_6');
            case 3: return __('3_days_week');
            case 4: return __('2_days_week');
            case 5: return __('twice_daily');
            case 6: return __('on_call');
            default: return 'Unknown';
        }
    }
    public static function waste_type($value)
    {
        
        switch ($value) {
            case 1: return __('general');
            case 2: return __('construction');
            case 3: return __('hazardous');
            case 4: return __('msw');
            default: return 'Unknown';
        }
    }
    
    public static function vehicle_type($value)
    {
        
        switch ($value) {
            case 1: return __('compactor');
            case 2: return __('hook_loader');
            case 3: return __('chain_loader');
            default: return 'Unknown';
        }
    }
    
    public static function vehicle_contract($value)
    {
        
        switch ($value) {
            case 1: return __('contract');
            case 2: return __('rented_lease');
            default: return 'Unknown';
        }
    }
    
    public static function working_shift($value)
    {
        
        switch ($value) {
            case 1: return __('morning');
            case 2: return __('evening');
            case 3: return __('night');
            default: return 'Unknown';
        }
    }
}
