<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 5/25/15 AD
 * Time: 1:11 PM
 */

class ActivitiesLogController {

    static $activitiesLogDaoImpl;

    static function loadClass()
    {
        self::$activitiesLogDaoImpl = new ActivitiesLogDAOImpl();
    }

    static function addLog(ActivitiesLog $log){
        return self::$activitiesLogDaoImpl->addLog($log);
    }

    static function getAllLog(){
        return self::$activitiesLogDaoImpl->getAllLogs();
    }

    static function getLogByMethod($method){
        return self::$activitiesLogDaoImpl->getActivitiesLogByMethod($method);
    }

    static function getLogByModule($module){
        return self::$activitiesLogDaoImpl->getActivitiesLogByModule($module);
    }

    static function deleteLogByAccountId($accountId){
        return self::$activitiesLogDaoImpl->deleteLogByAccountId($accountId);
    }
}