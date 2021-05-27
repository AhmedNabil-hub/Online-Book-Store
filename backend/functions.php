<?php

  function get_data($table, $fields, $parameters=null, $condition=null, $limit=null, $order=null) {
    global $db_connect;

    $query = "SELECT $fields
              FROM $table
              $condition
              $limit
              $order";

    $query = $db_connect->prepare($query);

    if($parameters != null) {
      $parameters = explode(',', $parameters);

      foreach($parameters as $parameter) {
        $temp = explode('=', $parameter);
        $query->bindParam(':'.$temp[0], $temp[1]);
      }
    }

    $query->execute();

    return $query->fetchAll();
  }

  function add_data($table, $fields, $values, $parameters) {
    global $db_connect;

    $query = "INSERT INTO $table
              ($fields)
              VALUES
              ($values)";

    $query = $db_connect->prepare($query);

    if($parameters != null) {
      $parameters = explode(',', $parameters);
  
      foreach($parameters as $parameter) {
        $temp = explode('=', $parameter);
        $query->bindParam(':'.$temp[0], $temp[1]);
      }
    }

    $query->execute();

    if ($query->rowCount() > 0) {
      return true;
    } else {
      return false;
    }

  }

  function edit_data($table, $fields, $parameters, $condition=null) {
    global $db_connect;

    $query = "UPDATE $table
              SET $fields
              $condition";

    $query = $db_connect->prepare($query);

    if($parameters != null) {
      $parameters = explode(',', $parameters);
  
      foreach($parameters as $parameter) {
        $temp = explode('=', $parameter);
        $query->bindParam(':'.$temp[0], $temp[1]);
      }
    }

    $query->execute();

    if ($query->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  function delete_data($table, $parameters, $condition=null) {
    global $db_connect;

    $query = "DELETE FROM $table
              $condition";

    $query = $db_connect->prepare($query);

    if($parameters != null) {
      $parameters = explode(',', $parameters);
  
      foreach($parameters as $parameter) {
        $temp = explode('=', $parameter);
        $query->bindParam(':'.$temp[0], $temp[1]);
      }
    }

    $query->execute();

    if ($query->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  function redirect($url)
  {
    if(headers_sent())
    {
      echo "<script>document.location.href='".$url."'</script>";
    }
    else
    {
      header("location: ".$url);
    }
  }

?>
