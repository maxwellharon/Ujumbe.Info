<?php
class Processor {

    /**
     * method clearSessions
     * deletes from the session
     * */
	
    public static function clearSessions($db, $source) {
        $db->alter("INSERT INTO ussd_sessions_archive (sessionId, msisdn, ussdString, dateCreated) "
                . "SELECT sessionId, msisdn, ussdString, dateCreated "
                . "FROM ussd_sessions WHERE msisdn = ?", $source);
        $db->alter("DELETE FROM ussd_sessions WHERE msisdn = ?", $source);
    }
    /**
     * Method createSessions
     * creates a new session for the user
     * */
    public static function createSessions($db, $source, $session, $sessionString) {
       $params = array($session, $source, $sessionString);
       $db->alter("INSERT INTO ussd_sessions (sessionId, msisdn, ussdString, dateCreated) "
                . "VALUES (?, ?, ?, NOW())", $params);
    }
 
    /**
     * Method updateSessions 
     * Updates the session string on each request
     * */
    public static function updateSessions($db,$source,$ussdString) {
        $db->alter("UPDATE ussd_sessions SET ussdString = ?  WHERE msisdn = ?", 
                $ussdString, $source);
    }

    /**
     * Method getSessionString 
     * Updates the session string on each request
     * */
    public static function getSessionString($db, $source) {
        $sessionString = "";
        $res = $db->Select("SELECT ussdString FROM ussd_sessions WHERE msisdn = ?", 
                $source);
        if (count($res) > 0) {
                $sessionString = $res[0]['ussdString'];
        }
        return $sessionString;
    }

    /**
     * Method getMaxLevel
     * 
     * methods gets the maximum levels u can go to
     * */
    public static function getMaxLevel($db) {

        $maxLevel = 0;
        $res = $db->Select("SELECT MAX(level) AS maxLevel FROM ussdcontent");
       
        if (count($res) > 0) {
            foreach ($res as $rs) {
                $maxLevel = $rs['maxLevel'];
            }
        }
        return $maxLevel;
    }

    /**
     * method getMaxInput
     * returns input
     * */
    public static function getMaxInput($db, $prevInput) {
        $maxInput = 0;
        $res = $db->Select("SELECT max(input) AS maxInput FROM ussdcontent WHERE prevInput = ?", $prevInput);
        if (count($res) > 0) {
            $maxInput = $res[0]['maxInput'];
        }
        return $maxInput;
    }
    /**
     * method getMaxInput
     * returns input
     * */
    
    /**
     * method getMaxInput
     * returns input
     * */
    public static function getRegistrationStatus($db, $msisdn) {
        $reg = false;
        $res = $db->Select("SELECT msisdn FROM ujumbe_msisdn WHERE msisdn = ? and status = ?", $msisdn, "1");
        if (count($res) > 0) {
            $reg = true;
        }
        return $reg;
    }
	
	/*public static function checkFrequency($db, $msisdn) {
        $reg = true;
        $timestamp=date("Y-m-d H:m:s",time()-86400);
       
        $res = $db->Select("SELECT id FROM sambazalogs WHERE phoneNumber = ? and timestamp >= ?", $msisdn, $timestamp);
        if (count($res) > 0) {
            $reg = false;
        }
        return $reg;
    }*/
	
	
    
    /**
     * method getMaxInput
     * returns input
     * */
     public static function getCustomerMSISDN($db, $mobile) {
        $msisdn = false;
        $res = $db->Select("SELECT msisdn FROM ujumbe_msisdn WHERE msisdn = ?", $mobile);
        if (count($res) > 0) {
            $msisdn = true;
        }
        return $msisdn;
    }
    
    /**
     * Method updateSessions 
     * Updates the session string on each request
     * */
    public static function deactivateCustomer($db, $source) {
        $db->alter("UPDATE ujumbe_users SET status = ?  WHERE msisdn = ?", "2", 
                $source);
    }
     public static function activateCustomer($db, $source) {
     $mobile = Processor::getCustomerMSISDN($db, $source);
     if ($mobile) {
        $db->alter("UPDATE ujumbe_users SET status = ?  WHERE msisdn = ?", "1", 
                $source);
                return true;
                }
                return false;
    }
    
    /**
     * Method delete from getPreviousInput
     * Return string previousInput
     */
    public static function getInput($sessionString) {
        $arr = explode("*", $sessionString);
        $input = "";
        if (count($arr) > 0) {
            $revArr = array_reverse($arr);
            $input = $revArr[0];
        }
        return $input;
    }
    
    /**
     * Method delete from getPreviousInput
     * Return string previousInput
     */
    public static function getPrevString($sessionString) {
        $arr = explode("*", $sessionString);
        $output = $sessionString;
        if (count($arr) > 1) {
            $revArr = array_reverse($arr);
            unset($revArr[0]);
            if (count($revArr) >= 1) {
               $output =  implode("*", array_reverse($revArr));
            } else {
                $output = $revArr[0];
            }
            
        }
        return $output;
    }
    

    /**
     * Method delete from getPreviousInput
     * Return string previousInput
     */
    public static function getOutputString($db, $level, $status, $input = null) {
        $messageTemplate = "";
		$type = "";
		$productId = "";
		$serviceId = "";
		$keyword = "";
	if ($status)
            $reg = "REG";
        else
            $reg = "NON_REG";
        if ($status) {
            $params = array($level, $input, $reg);
            $res = $db->Select("SELECT messageTemplate  FROM ussdcontent WHERE "
                    . "level = ? AND input = ? AND prevInput = ?", $params);
            
        } else {
            $params = array($level, $reg);
            $res = $db->Select("SELECT messageTemplate  FROM ussdcontent WHERE "
                    . "level = ? AND prevInput = ?", $params);
            
        }
        if (count($res) > 0) {
            $messageTemplate = $res[0]['messageTemplate'];
        }	
        return $messageTemplate;
    }
    
    public static function ussdLogs($db, $msisdn, $sessionId, $serviceCode, 
            $ussdString, $ussdResp, $requestDate, $responseDate) {
        $params = array($msisdn, $sessionId, $serviceCode, 
            $ussdString, $ussdResp);
        $db->alter("INSERT INTO ussdlogs (msisdn, sessionId, serviceCode, "
                . "ussdString, ussdResponse) VALUES (?, ?, ?, ?, ?)", 
                $params);
    }
 public static function smsLogs($db, $msisdn,$status,$message,$cost) {
        $params = array($msisdn,$message,$cost,$status);
		$db->alter("INSERT INTO `smslogs`(`recipient`, `MessageId`, `cost`, `date`, `status`) VALUES (?,?,?,NOW(),?)",$params);
    }
  
  
  public static function registerUser($db,$fname,$lname,$gender,$age,$county,$phone) {
        $mobile = Processor::getCustomerMSISDN($db, $phone);
        if ($mobile) {
		
			
            $params = array
($fname,$lname,$gender,$age,$county,$phone);

             $db->alter("UPDATE ujumbe_users SET  "
                    . "firstname = ?, "
                    . "secondName = ?, "
                    . "gender = ?, "
                    . "age = ?, "
                    . "counstituency= ? "
                    . " WHERE msisdn= ?", $params);
                    $extras=array("1",$phone);
					$db->alter("UPDATE ujumbe_msisdn SET status=? WHERE msisdn=?",$extras);
           
        } else {
            $params =array
($fname,$lname,$gender,$age,$county,$phone);
           $db->alter("INSERT INTO ujumbe_users "
                    . "(firstname, secondName, gender, age, constituency, msisdn)"
                    
                    . "VALUES (?, ?, ?, ?, ?, ?)", $params);
					
					$extras=array($phone,"1");
					$db->alter("INSERT INTO ujumbe_msisdn(msisdn,status) VALUES(?,?)",$extras);
        }
        return true;
    }
	
	public static function addRecord($db,$msisdn,$sessionId,$repId)
	{
	$params=array($msisdn,$sessionId,$repId);
	$db->alter("INSERT INTO `ujumbemessages`(`msisdn`,`sessionId` ,`repId`) VALUES (?,?,?)",$params);
	}
		
	public static function updateIssue($db,$issueId,$sessionId)
	{	
	$db->alter("UPDATE  ujumbemessages SET issueId = ? WHERE sessionId = ? ",$issueId,$sessionId);
	}
	
	public static function updateMessage($db,$message,$sessionId)
	{	
	$db->alter("UPDATE  ujumbemessages SET message = ? WHERE sessionId = ? ",$message,$sessionId);
	}
	/*
	
	public static function registerUser($db,$msisdn)
	{
		$params=array($msisdn);
		$db->alter("insert into ujumbe_users (msisdn) values (?) ",$params);
	}
	
	public static function addFName($db,$msisdn,$fname)
	{
		$db->alter("update ujumbe_users set firstname=? where msisdn=? ",$fname,$msisdn);
	}
	
	public static function addLName($db,$msisdn,$lname)
	{
		$db->alter("update ujumbe_users set secondName=? where msisdn=? ",$lname,$msisdn);
	}
	public static function addGender($db,$msisdn,$gender)
	{
		$db->alter("update ujumbe_users set gender=? where msisdn=? ",$fname,$gender);
	}
	
	public static function addAge($db,$msisdn,$age)
	{
		$db->alter("update ujumbe_users set age=? where msisdn=? ",$age,$msisdn);
	}
	
	public static function addConst($db,$msisdn,$const)
	{
		$db->alter("update ujumbe_users set constituency=? where msisdn=? ",$const,$msisdn);
	}*/
		
	
}
