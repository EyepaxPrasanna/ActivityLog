<?php

    namespace Eyepax;

    class ActivityLog
    {
        public static function log($data = [], $isAdmin = false)
        {
            try {
                $data['api_type'] = ($isAdmin == true) ? 1 : 2;
                $data['action_data'] = serialize($data['action_data']);
                $data['request_ip'] = \Request::ip();
                $data['request_user_agent'] = \Request::server('HTTP_USER_AGENT');

                $now = \Carbon\Carbon::now();
                $data['created_at'] = $data['updated_at'] = $now->toDateTimeString();

                return \DB::table('trn_activity_log')->insert($data);
            } catch(\Exception $ex) {
                return false;
            }
        }

        public static function logMultiples($logs, $isAdmin = false)
        {
            try {
                if (!empty($logs)) {
                    $logs = self::processMultipleLogs($logs, $isAdmin);

                    return \DB::table('trn_activity_log')->insert($logs);
                }

                return false;
            } catch(\Exception $ex) {
                return false;
            }
        }

        private static function processMultipleLogs($logs = [], $isAdmin = false)
        {
            try {
                if(!empty($logs)) {
                    foreach($logs as $key => $log) {
                        $log['api_type'] = ($isAdmin == true) ? 1 : 2;
                        $log['action_data'] = serialize($log['action_data']);
                        $log['request_ip'] = \Request::ip();
                        $log['request_user_agent'] = \Request::server('HTTP_USER_AGENT');

                        $now = \Carbon\Carbon::now();
                        $log['created_at'] = $log['updated_at'] = $now->toDateTimeString();

                        $logs[$key] = $log;
                    }
                }

                return $logs;
            } catch(\Exception $ex) {
                return [];
            }
        }

        public static function getLogs($params = [], $page = 1, $itemsPerPage = 20)
        {
            $offset = ($page - 1) * $itemsPerPage;
            $query = \DB::table('trn_activity_log');

            if($params) {
                foreach($params as $key => $value) {
                    if($key == 'after') {
                        $query = $query->where('created_at', '>=', $value);
                    } else if($key == 'before') {
                        $query = $query->where('created_at', '<=', $value);
                    } else {
                        $query = $query->where($key, $value);
                    }
                }
            }

            $results = $query->skip($offset)->take($itemsPerPage)->get();

            return $results;
        }

        public static function getLogDetails($logId = null)
        {
            $details = null;

            if($logId) {
                $details = \DB::table('trn_activity_log')->find($logId);
            }

            return $details;
        }
    }