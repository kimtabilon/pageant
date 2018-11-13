<?php
    mysqli_query($GLOBALS['connection'], "DELETE FROM major_result WHERE score='0'");
    mysqli_query($GLOBALS['connection'], "DELETE FROM save_result WHERE score='0'");
    
function canNum($type)
{
    $q = mysqli_query($GLOBALS['connection'], "SELECT * FROM pair WHERE type='{$type}'");
    if ($q && mysqli_num_rows($q)) {
        $canNum=mysqli_fetch_array($q);
        return $canNum[1];
    }
    return false;
}

function judge()
{
    $judge=mysqli_fetch_array(mysqli_query($GLOBALS['connection'], "SELECT * FROM judge"));
    return $judge[1];
}

    $canNumMs=canNum("ms");
    $canNumMr=canNum("mr");
    $judge=judge();

function select($statement)
{
    $sql="SELECT * FROM {$statement}";
    $query=mysqli_query($GLOBALS['connection'], $sql);
    return $query;
}
    
function del($table, $id)
{
    $sql1="DELETE FROM {$table} WHERE id='{$id}' ";
    $query1=mysqli_query($GLOBALS['connection'], $sql1);
    return $query1;
}
    
function findData($table, $key = false, $value = false, $key2 = false, $value2 = false, $key3 = false, $value3 = false, $key4 = false, $value4 = false, $sort = false, $sortType = false)
{
    $sql="SELECT * FROM {$table}";
    if ($value!=false) {
        $sql.=" WHERE {$key}='{$value}'";
    }if ($value2!=false) {
        $sql.=" AND {$key2}='{$value2}'";
    }if ($value3!=false) {
        $sql.=" AND {$key3}='{$value3}'";
    }if ($value4!=false) {
        $sql.=" AND {$key4}='{$value4}'";
    }if ($sort!=false) {
        $sql.=" ORDER BY {$sort} {$sortType}";
    }$query=mysqli_query($GLOBALS['connection'], $sql);
    return $query;
}
function getCategory()
{
    $getcat_sql = "SELECT * FROM categories ORDER BY  `categories`.`sort` ASC";
    $getcat_query = query($getcat_sql);
    return $getcat_query;
}
    
function saveScore($category, $judge, $candidate, $score, $sqlTable)
{
    $savescore_sql = "INSERT INTO ";
    $savescore_sql .= "{$sqlTable}(category, judge, candidate, score)";
    $savescore_sql .= "VALUES('$category', '$judge', '$candidate', '$score')";
    $save_query = query($savescore_sql);
    return $save_query;
}
    
function majorScore($category, $judge, $candidate, $score)
{
    $majorscore_sql = "INSERT INTO ";
    $majorscore_sql .= "major_result(category, judge, candidate, score)";
    $majorscore_sql .= "VALUES('$category', '$judge', '$candidate', '$score')";
    $major_query = query($majorscore_sql);
    return $major_query;
}
    
function updateScore($score, $category, $judge, $candidate, $sql)
{
    $updatescore_sql = "UPDATE {$sql} SET score='{$score}' WHERE category='{$category}' AND judge='{$judge}' AND candidate='{$candidate}'";
    $query_updatescore = query($updatescore_sql);
    return $query_updatescore;
}
    
function score($category, $judge, $can = "", $sql)
{
    $read_sql = "SELECT * FROM ".$sql." WHERE category='".$category."' AND judge='".$judge."' ";
    if ($can != "") {
        $read_sql .= "AND candidate='$can'";
    }
    $query_read = query($read_sql);
    $data = fetch($query_read);
    return $data['score'];
}
    
function find($category, $judge, $sql)
{
    $read_sql = "SELECT * FROM $sql WHERE judge='$judge' ";
    if ($category != "") {
        $read_sql .= "AND category='$category' ";
    }
    $query_read = query($read_sql);
    return $query_read;
}
    
function getScore($table, $judge, $candidate, $category, $field)
{
    $query = mysqli_query($GLOBALS['connection'], "SELECT score FROM ".$table." WHERE candidate='".$candidate."' AND ".$field."='".$category."' AND judge='".$judge."'");
    if ($query && mysqli_num_rows($query)) {
        $score = mysql_fetch_assoc($query);
        return $score['score'];
    } else {
        return 0;
    }
}
    
function autoSaveScore($table, $candidate, $category, $score, $judge)
{
    $deleteExisting = mysqli_query($GLOBALS['connection'], "DELETE FROM ".$table." WHERE category='".$category."' AND judge='".$judge."' AND candidate='".$candidate."'");
    $autoSaveScore = mysqli_query($GLOBALS['connection'], "INSERT INTO ".$table." (category, judge, candidate, score)VALUES('".$category."', '".$judge."', '".$candidate."', '".$score."')");
    if ($autoSaveScore) {
        return true;
    } else {
        return false;
    }
}
    
function clear($sql)
{
    $clear_sql = "DELETE FROM $sql";
    $query_clear = query($clear_sql);
    return $query_clear;
}
    
function query($sql)
{
    $query = mysqli_query($GLOBALS['connection'], $sql);
    return $query;
}
    
function fetch($query)
{
    $data = mysqli_fetch_array($query);
    return $data;
}
    
function num($query)
{
    $num = mysqli_num_rows($query);
    return $num;
}
