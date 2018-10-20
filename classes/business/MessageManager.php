<?php
namespace classes\business;

use classes\entity\Message;
use classes\data\MessageManagerDB;

class MessageManager
{
//    public static function getAllMessage(){
//        return MessageManagerDB::getAllMessage();
//    }
//    public function getMessageByEmail($email){
//        return MessageManagerDB::getMessageByEmail($email);
//    }
//    public function deleteMessage($id){
//        return MessageManagerDB::deleteMessage($id);
//    }
//    public function insertMessage(Message $Message){
//        MessageManagerDB::insertMessage($Message);
//    }
//
//    public function deleteAccount($id){
//        MessageManagerDB::deleteAccount($id);
//    }

    public function getReceiveById($to_id){
        return MessageManagerDB::getReceiveById($to_id);
    }

    public function insertMessage(Message $message){
        MessageManagerDB::insertMessage($message);
    }
    public function getMessageById($message_id){
        return MessageManagerDB::getMessageById($message_id);
    }
}

?>