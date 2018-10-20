<?php
namespace classes\data;

use classes\entity\Message;
use classes\util\DBUtil;

class MessageManagerDB
{
    public static function fillMessage($row)
    {
        $message = new Message();
        $message->message_id = $row["message_id"];
        $message->from_id = $row["from_id"];
        $message->to_id = $row["to_id"];
        $message->topic = $row["topic"];
        $message->content = $row["content"];
        $message->time_sent = $row["time_sent"];
        return $message;
    }

//
//    public static function deletemessage($id){
//        $conn=DBUtil::getConnection();
//        $sql="DELETE from tb_message WHERE id='$id';";
//        $stmt = $conn->prepare($sql);
//        if ($conn->query($sql) === TRUE) {
//            echo "<script>alert(Record deleted successfully)</script>";
//        } else {
//            echo "Error updating record: " . $conn->error;
//        }
//        $conn->close();
//
//    }

    public static function getReceiveById($to_id)
    { //Display receive messages based on to id so current user viewing inbox
        $message[] = array();
        $messages[] = array();
        $conn = DBUtil::getConnection();
        $sql = "select * from tb_message where to_id='$to_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = self::fillMessage($row);
                $messages[] = $message;
            }
        } else {
            echo "No results";
        } //added

        $conn->close();
        return $messages;
    }


    public static function getAllMessage()
    {
        $users[] = array();
        $conn = DBUtil::getConnection();
        $sql = "select * from tb_message";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $message = self::fillMessage($row);
                $messages[] = $message;
            }
        }
        $conn->close();
        return $messages;
    }

    public static function insertMessage(Message $message)
    {
        $conn = DBUtil::getConnection();
        $sql = "INSERT INTO TB_message (from_id, to_id, topic, content,time_sent) VALUES (?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $message->from_id, $message->to_id, $message->topic, $message->content, $message->time_sent);
        $stmt->execute();
        if ($stmt->errno != 0) {
            printf("SQL Error: %s.\n", $stmt->error);
        }
        $stmt->close();
        $conn->close();

    }


    public static function getMessageById($message_id)
    {
        $message = NULL;
        $conn = DBUtil::getConnection();
        $message_id = mysqli_real_escape_string($conn, $message_id);
        $sql = "select * from tb_message where message_id='$message_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $message = self::fillMessage($row);
            }
        } else {
            echo "No results";
        }//added

        $conn->close();
        return $message;
    }
}

?>