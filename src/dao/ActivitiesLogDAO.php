<?php

interface ActivitiesLogDAO {
    function getAllLogs();
    function addLog(ActivitiesLog $activitiesLog);
    function getActivitiesLogByMethod($method);
    function getActivitiesLogByModule($module);
    function deleteLogByAccountId($accountId);

}