<?php
namespace classes\data;

use classes\entity\Forum;
use classes\util\DBUtil;

class ForumManagerDB
{
    public static function fillForum($row)
    {
        $forum = new forum();
        $forum->forum_id = $row["forum_id"];
        $forum->from_id = $row["from_id"];
        $forum->title = $row["title"];
        $forum->post = $row["post"];
        $forum->time_sent = $row["time_sent"];
        return $forum;
    }

//
//    public static function deleteforum($id){
//        $conn=DBUtil::getConnection();
//        $sql="DELETE from tb_forum WHERE id='$id';";
//        $stmt = $conn->prepare($sql);
//        if ($conn->query($sql) === TRUE) {
//            echo "<script>alert(Record deleted successfully)</script>";
//        } else {
//            echo "Error updating record: " . $conn->error;
//        }
//        $conn->close();
//
//    }

    public static function getReceiveById($from_id)
    { //Display receive forums based on to id so current user viewing inbox
        $forum[] = array();
        $forums[] = array();
        $conn = DBUtil::getConnection();
        $sql = "select * from tb_forum where from_id='$from_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $forum = self::fillForum($row);
                $forums[] = $forum;
            }
        } else {
            echo "No results";
        } //added

        $conn->close();
        return $forums;
    }


    public static function getAllForum()
    {
        $users[] = array();
        $conn = DBUtil::getConnection();
        $sql = "select * from tb_forum";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $forum = self::fillForum($row);
                $forums[] = $forum;
            }
        }
        $conn->close();
        return $forums;
    }

    public static function insertForum(forum $forum)
    {
        $conn = DBUtil::getConnection();
        $sql = "INSERT INTO tb_forum (from_id, title , post ,time_sent) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $forum->from_id,  $forum->title, $forum->post, $forum->time_sent);
        $stmt->execute();
        if ($stmt->errno != 0) {
            printf("SQL Error: %s.\n", $stmt->error);
        }
        $stmt->close();
        $conn->close();

    }


    public static function getForumById($forum_id)
    {
        $forum = NULL;
        $conn = DBUtil::getConnection();
        $forum_id = mysqli_real_escape_string($conn, $forum_id);
        $sql = "select * from tb_forum where forum_id='$forum_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $forum = self::fillForum($row);
            }
        } else {
            echo "No results";
        }//added

        $conn->close();
        return $forum;
    }
}

?>