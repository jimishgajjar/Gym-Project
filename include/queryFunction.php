<?php
function getData($tablename, $where = array(), $limit = null)
{
    include 'dbConfig.php';

    if (!empty($where)) {
        $wherestr = "";
        foreach ($where as $field => $condition) {
            $wherestr = $wherestr . $field . " = '" . $condition . "' And ";
        }
        $wherestr = preg_replace('/\W\w+\s*(\W*)$/', '$1', $wherestr);

        if (!empty($limit)) {
            $query = "SELECT * FROM " . $tablename . " WHERE " . $wherestr . " limit " . $limit;
        } else {
            $query = "SELECT * FROM " . $tablename . " WHERE " . $wherestr;
        }

        $result = $conn->query($query);
    }

    if (empty($where)) {
        if (!empty($limit)) {
            $query = "SELECT * FROM " . $tablename . " limit " . $limit;
        } else {
            $query = "SELECT * FROM " . $tablename;
        }
        $result = $conn->query($query);
    }

    // echo $query . "<br>";
    return $result;
    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         echo "id: " . $row["shop_id"] . " - Name: " . $row["shop_name"] . "<br>";
    //     }
    // }
}

function insertData($tablename, $input)
{
    include 'dbConfig.php';
    $column = "";
    $values = "";
    foreach ($input as $field => $value) {
        $column = $column . $field . ", ";
        $values = $values . "'" . $value . "', ";
    }
    $column = rtrim($column, ', ');
    $values = rtrim($values, ', ');

    $query = "INSERT INTO " . $tablename . " (" . $column . ") VALUES (" . $values . ")";
    echo $query . "<br>";
    if ($conn->query($query) === TRUE) {
        return $tablename . " inserted successfully";
    }
    // else {
    //     echo "Error: " . $query . "<br>" . $conn->error;
    // }
}
function updateData($tablename, $input, $where = array())
{
    include 'dbConfig.php';
    $wherestr = "";
    $set = "";
    foreach ($where as $field => $condition) {
        $wherestr = $wherestr . $field . " = '" . $condition . "' And ";
    }
    $wherestr = preg_replace('/\W\w+\s*(\W*)$/', '$1', $wherestr);

    foreach ($input as $ifield => $ivalue) {
        $set = $set . $ifield . " = '" . $ivalue . "', ";
    }
    $set = rtrim($set, ', ');

    $query = "UPDATE " . $tablename . " SET " . $set . " WHERE " . $wherestr;
    if ($conn->query($query) === TRUE) {
        return $tablename . " updated successfully";
    }
    // else {
    //     echo "Error updating record: " . $conn->error;
    // }
}
function deleteData($tablename, $where = array())
{
    include 'dbConfig.php';
    $wherestr = "";
    foreach ($where as $field => $condition) {
        $wherestr = $wherestr . $field . " = '" . $condition . "' And ";
    }
    $wherestr = preg_replace('/\W\w+\s*(\W*)$/', '$1', $wherestr);

    $query = "DELETE FROM " . $tablename . " WHERE " . $wherestr;
    if ($conn->query($query) === TRUE) {
        return $tablename . " deleted successfully";
    }
}


function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
