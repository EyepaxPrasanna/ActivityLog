<?php

    namespace Eyepax\Facades;

    use Illuminate\Support\Facades\Facade;

    class ActivityLog extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return 'eyepax-activity-log';
        }
    }