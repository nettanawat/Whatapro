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
    public function approveRequest($id);
    public function deleteRequest($id);
    public function getRequestByStatus($status);
}

