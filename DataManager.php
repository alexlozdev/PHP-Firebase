<?php
require_once __DIR__ . '/vendor/autoload.php';
include('includes/config.php');

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class DataManager {

    public $database;
    public $db_group = 'group'; 
    public $db_message = 'messages'; 
    public $db_user = 'users';    

    public function __construct()
    {        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/groupmsgapp-4507d-c26e80f7117a.json');
        $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
        $this->database = $firebase->getDatabase();		
    }
    
    public function get_groups($refresh=false) {
        $groups = json_decode($_COOKIE['group_info'], true);
        if (empty($groups) || $refresh) {
            $reference = $this->database->getReference($this->db_group);
            $snapshotGroup = $reference->getSnapshot();        
            $groups = $snapshotGroup->getValue();        

            // save cookie
            setcookie('group_info', json_encode($groups));
        } 
        
        return $groups;
    }

    public function send_messages($group, $title, $content) {
        $groups = json_decode($_COOKIE['group_info'], true);
        while($element = current($groups)) {
            if(strcmp($element['name'], $group) == 0) {
                $groupKey = key($groups);
                break;
            }

            next($groups);
        }
        
        if (empty($groupKey)) {
            return false;
        }

        $data = array();
        $data["title"] = $title;
        $data["content"] = $content;
        $data["select"] = false;


        $created = date('Y-m-d H:i:s');
        $data["created"] = $created;

        // push notification
        $path = $this->db_message.'/'.$groupKey;
        $reference = $this->database->getReference($path);
        $postKey= $reference->push($data);        
        return true;
    }

    public function add_group($group) {        
        $groups = json_decode($_COOKIE['group_info'], true);
        if (empty($groups)) {
            $groups = $this->get_groups();
        }

        while($element = current($groups)) {
            if(strcmp($element['name'], $group) == 0) {
                return false;
            }

            next($groups);
        }
        
        $data = array();
        $data["name"] = $group;
        
        // push notification
        $path = $this->db_group;
        $reference = $this->database->getReference($path);
        $postKey= $reference->push($data);  
        
        // set cookie
        if (empty($postKey)) {
            return false;
        }        
        
        return true;
    }

    public function remove_group($group) {
        $groups = json_decode($_COOKIE['group_info'], true);
        if (empty($groups)) {
            $groups = $this->get_groups();
        }

        while($element = current($groups)) {
            if(strcmp($element['name'], $group) == 0) {
                $groupKey = key($groups);
                
                // group                
                $path = $this->db_group.'/'.$groupKey;
                $reference = $this->database->getReference($path);
                $reference->remove();
                
                // users
                $path = $this->db_user.'/'.$groupKey;
                $reference = $this->database->getReference($path);
                $reference->remove();

                // messages
                $path = $this->db_message.'/'.$groupKey;
                $reference = $this->database->getReference($path);
                $reference->remove();                

                return true;
            }

            next($groups);
        }
                
        return false;
    }

    public function edit_group($old_group, $new_group) {
        $groups = json_decode($_COOKIE['group_info'], true);
        if (empty($groups)) {
            $groups = $this->get_groups();
        }

        while($element = current($groups)) {
            if(strcmp($element['name'], $old_group) == 0) {
                $groupKey = key($groups);

                $data = array();
                $data["name"] = $new_group;
                
                // group
                $path = $this->db_group.'/'.$groupKey;
                $reference = $this->database->getReference($path);
                $reference->set($data);

                return true;
            }

            next($groups);
        }
                
        return false;
    }



}
