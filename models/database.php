<?php
class Database
{
  private $host = "localhost";
  private $user = "root";
  private $pwd = "";
  private $dbName = "pet_shop";

  protected function connect() // MySQL Connection
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
    $pdo = new PDO($dsn, $this->user, $this->pwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }

  protected function checkUserName($data) // Check if username is valid
  {
    $sql = "SELECT * FROM users WHERE userName = :user";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['user' => $data['user']]);

    return $stmt->rowCount() > 0 ? true : false;
  }

  protected function checkPassword($data) // Check if password is valid
  {
    $sql = "SELECT * FROM users WHERE userName = :user AND password = :password";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['user' => $data['user'], 'password' => $data['password']]);

    return $stmt->rowCount() > 0 ? true : false;
  }

  protected function loginUser($data, $type = 0)
  {
    // Type = 0 -> Used to Login the User
    // Type = 1 -> Get User Data

    $user = [];

    $sql = "SELECT * FROM users";

    if ($type == 0)
    {
      $sql .= " WHERE userName = :user AND password = :password";
    }
    else if ($type == 1)
    {
      $sql .= " WHERE randomId = :randomId";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute(['user' => $data['user'], 'password' => $data['password']]);
    }
    else if ($type == 1)
    {
      $stmt->execute(['randomId' => $data['randomId']]);
    }

    while ($row = $stmt->fetch()) 
    {
      $user[] = $row;
    }

    return $user;
  }

  protected function employeeDetails($userId = "", $type = 0) // Query to get the employee details
  {
    $data = [];

    if ($type == 0)
    {
      $sql = "SELECT * FROM employeedetails WHERE id = :userId";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(['userId' => $userId]);
    }
    else if ($type = 1)
    {
      $sql = "SELECT 
              e.firstName, 
              e.middleName, 
              e.lastName,
              e.gender,
              e.emailAddress,
              e.phoneNumber,
              e.hiredDate,
              e.location,
              p.positionName
              FROM employeedetails e
              LEFT JOIN position p ON p.id = e.positionId";

      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
    }
    
    while ($row = $stmt->fetch()) 
    {
      $data[] = $row;
    }

    return $data;
  }

  protected function userTable() // Query to get the user's table
  {
    $data = [];

    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) 
    {
      $data[] = $row;
    }

    return $data;
  }

  protected function position($posId, $type) // Query to get the user's position
  {
    $data = [];

    $sql = "SELECT * FROM position";

    if ($type == 0)
    {
      $sql .= " WHERE id = :posId";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute(['posId' => $posId]);

      return $stmt->fetch()['positionName'];
    }
    else if ($type == 1)
    {
      $stmt->execute();

      while ($row = $stmt->fetch()) 
      {
        $data[] = $row;
      }

      return $data;
    }
  }

  protected function accessFields($typeId) // Query to get the user's access fields
  {
    $sql = "SELECT type, accessType FROM type WHERE id = :typeId";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['typeId' => $typeId]);

    return $stmt->fetchAll();
  }
}
