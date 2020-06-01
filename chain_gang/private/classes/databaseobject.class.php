<?php


class DatabaseObject
{
  static protected $database;
  static protected $table_name;
  static protected $columns = [];


    public $errors =[];



    static public function set_database($database) {
        self::$database = $database;
    }

    static public function find_by_sql($sql) {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database query failed.");
        }
        // result into objects
        $object_array = [];
        while($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }
        $result->free();

        return $object_array;
    }

    static public function find_all() {
        $sql = "SELECT * FROM " . static::$table_name;
        return static::find_by_sql($sql);
    }

    static public function count_all() {
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }


    static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name. " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }


    static protected function instantiate($record) {
        $object = new static;
        // could manually assign values to properteies
        // but automatic easier
        foreach($record as $property => $value) {
            if(property_exists($object,$property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    protected function validate() {
        $this->errors = [];

// add custom validations
/*        if(is_blank($this->brand)) {
            $this->errors[] = "Brand cannot be blank.";
        }
        if(is_blank($this->model)) {
            $this->errors[] = "Model cannot be blank.";
        }*/
        return $this->errors;
    }


    protected function create() {
        $this->validate();
        if(!empty($this->errors)) { return false;}

        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
//    $sql .= "brand, model, year, category, color, gender, price, weight_kg, condition_id, description";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        /*    $sql .= "'" . $this->brand . "', ";
            $sql .= "'" . $this->model . "', ";
            $sql .= "'" . $this->year . "', ";
            $sql .= "'" . $this->category . "', ";
            $sql .= "'" . $this->color . "', ";
            $sql .= "'" . $this->gender . "', ";
            $sql .= "'" . $this->price . "', ";
            $sql .= "'" . $this->weight_kg . "', ";
            $sql .= "'" . $this->condition_id. "', ";
            $sql .= "'" . $this->description . "'";*/
        $sql .= "')";
        $result = self::$database->query($sql);
        if($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }


    protected function update() {
        $this->validate();
        if(!empty($this->errors)) { return false;}

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE ". static::$table_name . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

    public function save() {
        // A new record will not have an ID yet
        if(isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }


    public function merge_attributes($args=[]) {
        foreach ($args as $key => $value) {
            if(property_exists($this,$key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }



    public function attributes() {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if($column=='id') {continue;}
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        $sanitized = [];
        foreach($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

    public function delete() {
        $sql = "DELETE FROM ". static::$table_name ." ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) ."' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }




//end of active record code



}

?>