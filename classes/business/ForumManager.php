<?php
namespace classes\business;

use classes\entity\Forum;
use classes\data\ForumManagerDB;

class ForumManager
{
//    public static function getAllForum(){
//        return ForumManagerDB::getAllForum();
//    }
//    public function getForumByEmail($email){
//        return ForumManagerDB::getForumByEmail($email);
//    }
//    public function deleteForum($id){
//        return ForumManagerDB::deleteForum($id);
//    }
//    public function insertForum(Forum $Forum){
//        ForumManagerDB::insertForum($Forum);
//    }
//
//    public function deleteAccount($id){
//        ForumManagerDB::deleteAccount($id);
//    }

    public function getReceiveById($to_id){
        return ForumManagerDB::getReceiveById($to_id);
    }

    public function insertForum(Forum $forum){
        ForumManagerDB::insertForum($forum);
    }
    public function getForumById($Forum_id){
        return ForumManagerDB::getForumById($Forum_id);
    }
}

?>