<?php


  
     function authenticate($user, $password) {
        if (empty($user) || empty($password)) return false; 
        
        
        //active directory server
        $ldap_host = "jjei.com"; 
        
//        //actice directory port 
//        $ldap_port = "389"; 
        //active directory DN (base location of ldap search)
        $ldap_dn = "OU=Users,OU=jj,DC=jjei,DC=com";
        
        //active directory user group 
        $ldap_user_group = "Domain Users";
                 
        //active directory manager group name 
        $ldap_manager_group = "IT-All";
                
        
        //domain, for purposes of constructing $user 
        $ldap_user_dom = "@jjei.com";
        
        //connect to actibe directory 
        $ldap = ldap_connect($ldap_host);
        
        ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION, 3); 
        ldap_set_option($ldap, LDAP_OPT_REFERRALS,0); 
        
        
        //verigy user and password 
        if($bind = @ldap_bind($ldap, $user.$ldap_user_dom, $password)) { 
            
            //valid 
            //check presence in group
            $filter = "(sAMAccountName=".$user.")"; 
            $attr = array("memberof"); 
            $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
            $entries = ldap_get_entries($ldap, $result);
            ldap_unbind($ldap);
            
            
            //check groups 
            $access = 0; 
            foreach ($entries[0]['memberof'] as $grps){
              
                //is manager break loop 
                if(strpos($grps, $ldap_manager_group)) {$access = 2; break; }
                
                //is user 
                if(strpos($grps, $ldap_user_group )) $access = 1; 
            }
            
            if($access !=0) {
                //establish session variables 
                $_SESSION['user'] = $user; 
                $_SESSION['access'] = $access ;
                    return true;
                       
            }else {
                return false; 
            }
            
          }
       }
   
            
