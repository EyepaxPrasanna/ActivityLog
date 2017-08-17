<?php
    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;
    use Eyepax\ActivityLog;

    class ActivityLogTest extends TestCase {
        private $request;
        private $carbon;
        private $db;

        public function setUp()
        {
            $this->request = Mockery::mock('alias:Request');
            $this->carbon = Mockery::mock('alias:Carbon\Carbon');
            $this->db = Mockery::mock('alias:DB');

            $this->request->shouldReceive('ip')
                ->andReturn('127.0.0.1')
                ->shouldReceive('server')
                ->andReturn('Chrome');

            $this->carbon->shouldReceive("now")
                ->andReturn($this->carbon)
                ->shouldReceive('toDateTimeString')
                ->andReturn('2017-08-16 12:51:00');
        }

        public function tearDown()
        {
            Mockery::close();
        }

        public function testSingleLogAddSuccess()
        {
            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('insert')
                ->andReturn(true);

            $data = [
                'action_data' => []
            ];

            $activityLog = ActivityLog::log($data);

            $this->assertTrue($activityLog);
        }

        public function testSingleLogAddFailure()
        {
            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('insert')
                ->andReturn(false);

            $data = [
                'action_data' => []
            ];

            $activityLog = ActivityLog::log($data);

            $this->assertFalse($activityLog);
        }

        public function testMultipleLogSuccess()
        {
            $data = [
                ['action_data' => []]
            ];
            Mockery::mock('ActivityLog')
                ->makePartial()
                ->shouldReceive('processMultipleLogs')
                ->passthru();

            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('insert')
                ->andReturn(true);

            $activityLog = ActivityLog::logMultiples($data);

            $this->assertTrue($activityLog);
        }

        public function testMultipleLogFailure()
        {
            $data = [
                ['action_data' => []]
            ];
            Mockery::mock('ActivityLog')
                ->makePartial()
                ->shouldReceive('processMultipleLogs')
                ->passthru();

            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('insert')
                ->andReturn(false);

            $activityLog = ActivityLog::logMultiples($data);

            $this->assertFalse($activityLog);
        }

        public function testGetLogsSuccess()
        {
            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('skip')
                ->andReturn($this->db)
                ->shouldReceive('take')
                ->andReturn($this->db)
                ->shouldReceive('get')
                ->andReturn([]);

            $logs = ActivityLog::getLogs();

            $this->assertInternalType('array', $logs);
        }

        public function testGetLogsCountSuccess()
        {
            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('skip')
                ->andReturn($this->db)
                ->shouldReceive('take')
                ->andReturn($this->db)
                ->shouldReceive('get')
                ->andReturn([1, 2]);

            $logs = ActivityLog::getLogs();

            $this->assertEquals(2, count($logs));
        }

        public function testGetLogDetailsSuccess()
        {
            $this->db->shouldReceive('table')
                ->andReturn($this->db)
                ->shouldReceive('find')
                ->andReturn(null);

            $details = ActivityLog::getLogDetails();

            $this->assertEquals(null, $details);
        }
    }
