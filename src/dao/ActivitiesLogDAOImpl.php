<?php

class ActivitiesLogDAOImpl implements ActivitiesLogDAO {
    private $database = '';
    private $table = 'Logs';

    function __construct()
    {
        $this->database = new medoo();
    }

    function getAllLogs()
    {
        $activitiesLogList = array();
        foreach ($this->database->select($this->table,'*') as $row) {
            $activitiesLogList[] = new ActivitiesLog($row['id'], $row['accounts_id'], $row['method'], $row['module'], $row['detail'], $row['date']);
        }
        return $activitiesLogList;
    }

    function addLog(ActivitiesLog $activitiesLog)
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $activitiesLog->setDate($now->format('Y-m-d H:i:s'));
        $data = [
            'accounts_id' => $activitiesLog->getAccountId(),
            'method' => $activitiesLog->getMethod(),
            'module' => $activitiesLog->getModule(),
            'detail' => $activitiesLog->getDetail(),
            'date' => $activitiesLog->getDate()
        ];
        return $this->database->insert($this->table, $data);
    }

    function getActivitiesLogByMethod($method)
    {
        $activitiesLogList = array();
        foreach ($this->database->select($this->table,'*',['AND'=>['method'=>$method]]) as $row) {
            $activitiesLogList[] = new ActivitiesLog($row['id'], $row['accounts_id'], $row['method'], $row['module'], $row['detail'], $row['date']);
        }
        return $activitiesLogList;
    }

    function getActivitiesLogByModule($module)
    {
        $activitiesLogList = array();
        foreach ($this->database->select($this->table,'*',['AND'=>['module'=>$module]]) as $row) {
            $activitiesLogList[] = new ActivitiesLog($row['id'], $row['accounts_id'], $row['method'], $row['module'], $row['detail'], $row['date']);
        }
        return $activitiesLogList;
    }


    function deleteLogByAccountId($accountId)
    {
        return $this->database->delete($this->table, ['AND'=>['accounts_id'=>$accountId]]);
    }
}