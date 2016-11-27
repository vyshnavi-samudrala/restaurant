<?php

function copy_value($v) {
    return $v;
}

class fetcher {
function fetch_assoc_stmt(mysqli_stmt $stmt, $buffer = true) {

    if ($buffer) {
        $stmt->store_result();
    }
    $fields = $stmt->result_metadata()->fetch_fields();

    $args = array();
    foreach($fields AS $field) {
        $key = str_replace(' ', '_', $field->name); // space may be valid SQL, but not PHP
        $args[$key] = &$field->name; // this way the array key is also preserved
    }
    call_user_func_array(array($stmt, "bind_result"), $args);
    $results = array();
    while($stmt->fetch()) {
       $results[] = array_map("copy_value", $args);
	   $p[] =$results;
	  // print_r($p);
    }
	//print_r($results);	
    if ($buffer) {
        $stmt->free_result();
    }
	//print_r($p);
    return $results;
}
};
?>
