<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequestSignupInfoDAO
 *
 * @author NetSmith
 */
interface RequestSignupInfoDAO {

    public function getAllRequest();
    public function addNewRequest(RequestSignupInfo $requestingSingup);
    public function getRequestByStatus($status);
    public function updateRequest($id,$status, $accountId);
}

