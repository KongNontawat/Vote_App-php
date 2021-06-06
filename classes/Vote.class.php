<?php
require 'Db_conn.class.php';
class Vote extends Db_conn
{
  public function upload_img($path)
  {
    $sql = "INSERT INTO User (path_img) VALUES (:path_img)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':path_img', $path['path_img']);
    $result = $stmt->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public function show_img($path)
  {
    $sql = "SELECT id, path_img FROM User WHERE path_img = :path_img";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':path_img', $path['path_img']);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $data = $result[0];
    if ($data) {
      return $data;
    } else {
      return false;
    }
  }

  public function login($data)
  {
    $sql = "UPDATE User SET name = :name WHERE id = :id AND path_img = :path_img";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute($data);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public function show_my_info($id)
  {
    $sql = "SELECT id, name, path_img, status FROM User WHERE id = :id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $data = $result[0];
    if ($data) {
      return $data;
    } else {
      return false;
    }
  }

  public function all_user()
  {
    $sql = "SELECT * FROM User";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  public function up_vote($id)
  {
    $sql = "UPDATE User SET vote_score = vote_score + 1
            WHERE id = :id;";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':id', $id['vote_id']);
    $result = $stmt->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public function my_status($id)
  {
    $sql = "UPDATE User SET status = 1 WHERE id = :my_id;";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':my_id', $id['my_id']);
    $result = $stmt->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public function get_result()
  {
    $sql = "SELECT name, path_img, MAX(vote_score) AS 'Vote_Score'
FROM User WHERE (SELECT MAX(vote_score) FROM User)=Vote_Score";
$stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $data = $result[0];
    if ($data) {
      return $data;
    } else {
      return false;
    }
  }

  public function get_all_status()
  {
    $sql = "SELECT COUNT(status) FROM User WHERE status = 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  public function clear_table() {
    $sql = "DELETE FROM user";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }
  }
}
