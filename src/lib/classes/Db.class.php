<?php

/**
 * Database connector and queries.
 *
 * @author Scott Haefner <shaefner@usgs.gov>
 */
class Db {
  private $_db;

  public function __construct() {
    global $DB_DSN, $DB_PASS, $DB_USER;

    try {
      $this->_db = new PDO($DB_DSN, $DB_USER, $DB_PASS);
      $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      print '<p class="alert error">ERROR: ' . $e->getMessage() . '</p>';
    }
  }

  /**
   * Perform db query
   *
   * @param $sql {String}
   *     SQL query
   * @param $params {Array} default is NULL
   *     key-value substitution params for SQL query
   *
   * @return $stmt {Object}
   *     PDOStatement object upon success
   */
  private function _execQuery ($sql, $params=NULL) {
    try {
      $stmt = $this->_db->prepare($sql);

      // bind sql params
      if (is_array($params)) {
        foreach ($params as $key => $value) {
          $type = $this->_getType($value);

          $stmt->bindValue($key, $value, $type);
        }
      }

      $stmt->execute();

      return $stmt;
    } catch(Exception $e) {
      print '<p class="alert error">ERROR: ' . $e->getMessage() . '</p>';
    }
  }

  /**
   * Get the data type for a sql parameter (PDO::PARAM_* constant).
   *
   * @param $var {?}
   *     variable to identify type of
   *
   * @return $type {Integer}
   */
  private function _getType ($var) {
    $pdoTypes = [
      'boolean' => PDO::PARAM_BOOL,
      'integer' => PDO::PARAM_INT,
      'NULL' => PDO::PARAM_NULL,
      'string' => PDO::PARAM_STR
    ];
    $type = $pdoTypes['string']; // default
    $varType = gettype($var);

    if (isset($pdoTypes[$varType])) {
      $type = $pdoTypes[$varType];
    }

    return $type;
  }

  /**
   * Query the db to get arrays. Listing columns explicitly so 'cosmoscode'
   * is the first column in the result.
   *
   * @return {Function}
   */
  public function queryArrays () {
    $sql = 'SELECT `cosmoscode`, `stacode`, `agency`, `lat`, `lon`, `name`,
      `city`, `state`, `channels`, `station`, `data`
      FROM nsmp_structures ORDER BY cosmoscode ASC, stacode ASC';

    return $this->_execQuery($sql);
  }

  /**
   * Query the db to get buildings.
   *
   * @return {Function}
   */
  public function queryBuildings () {
    $sql = 'SELECT * FROM nsmp_buildings';

    return $this->_execQuery($sql);
  }

  /**
   * Query the db to get stations.
   *
   * @return {Function}
   */
  public function queryStations () {
    $sql = 'SELECT * FROM nsmp_stations';

    return $this->_execQuery($sql);
  }

}
