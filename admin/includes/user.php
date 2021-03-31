<?php

class User extends Db_object {
  protected static $db_table = "users";
  protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  public $user_image;
  public $tmp_path;
  public $upload_directory = "images";
  public $image_placeholder = "http://placehold.it/150x150&text=image";

  public $custom_errors = array();
  public $upload_errors = array(
    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE => "No file was uploaded.",
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
  );

  public function image_path_and_placeholder() {
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
  }

  public function set_file($file) {
    if (empty($file) || !$file || !is_array($file)) {
      $this->custom_errors[] = "There was no file uploaded here";
      return false;
    } elseif ($file['error'] !== 0) {
      $this->custom_errors[] = $this->upload_errors[$file['error']];
      return false;
    } else {
      $this->user_image = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      return true;
    }
  }

  public function save_user_and_image() {
    global $database;
    $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $database->escape_string($this->user_image);
    if ($this->id && file_exists($target_path)) {
      $this->update();
    } elseif ($this->id && !file_exists($target_path)) {
      if (move_uploaded_file($this->tmp_path, $target_path)) {
        $this->update();
        unset($this->tmp_path);
      } else {
        $this->custom_errors[] = "The file directory does not have proper permissions";
      }
    } else {
      if (!empty($this->custom_errors)) {
        return false;
      }
      if (empty($this->user_image) || empty($this->tmp_path)) {
        $this->custom_errors[] = "The file was not available";
        return false;
      }
      if (file_exists($target_path)) {
        $this->custom_errors[] = "The file {$this->user_image} already exists";
        return false;
      }
      if (move_uploaded_file($this->tmp_path, $target_path)) {
        if ($this->create()) {
          unset($this->tmp_path);
          return true;
        }
      } else {
        $this->custom_errors[] = "The file directory does not have proper permissions";
      }
    }
  }


  public static function verify_user($username, $password) {
    global $database;
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
    $the_result_array = self::find_by_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

  public function ajax_save_user_image($user_image) {
    global $database;
    $this->user_image = $database->escape_string(str_replace('%20', ' ', $user_image));
    $sql = "UPDATE users SET user_image = '{$this->user_image}' WHERE id = {$this->id}";
    $database->query($sql);
    return $database->connection->affected_rows === 1 ? true : false;
  }
}




?>