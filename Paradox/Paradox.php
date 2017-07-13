<?php

namespace Paradox;

use Paradox\Enums\ParadoxFieldTypes;

class Paradox
{
  // Private Members
  private $_pxdoc = null;
  private $_fp = null;
  private $_record = null;

  // Private query values
  private $_select = [];
  private $_where = [];
  private $_limit = 0;
  private $_offset = 0;

  // Public changeable values
  public $defaultFieldValue = "";
  public $useFieldSlashes = false;
  public $useFieldTrim = false;

  /**
   * Paradox constructor.
   *
   * @param $name
   *
   * @throws \Exception
   */
  public function __construct($name)
  {
    // If we have been given the filename then the tableName will be before the . extension
    if(strstr($name, '.'))
    {
      $pathInfo = pathinfo($name);
      $tableName = $pathInfo['filename'];
      $path = $pathInfo['dirname'];
    }
    else
    {
      $tableName = $name;
      $path = getcwd();
    }

    $fileName = $path . '/' . $tableName . '.DB';

    // Create a new paradox object
    $this->_pxdoc = px_new();

    // Could we create the Paradox object?
    if(!$this->_pxdoc)
    {
      throw new \Exception("Paradox Error: px_new() failed");
    }

    // If the file exists try and open it for reading
    if(file_exists($fileName))
    {
      $this->_fp = fopen($fileName, "r");
    }
    else
    {
      throw new \Exception(
        "Paradox Error: Database file " . $fileName . " does not exist!"
      );
    }

    // Could we open the file?
    if(!$this->_fp)
    {
      px_delete($this->_pxdoc);
      throw new \Exception(
        "Paradox Error: fopen failed. Filename: " . $fileName
      );
    }

    // Get pxlib to read this paradox database file
    if(!px_open_fp($this->_pxdoc, $this->_fp))
    {
      px_delete($this->_pxdoc);
      throw new \Exception("Paradox Error: px_open_fp failed.");
    }

    // If a memo blob file exists then set this so we can get data from records
    $memoBlobFilename = $path . '/' . $tableName . '.MB';
    if(file_exists($memoBlobFilename))
    {
      px_set_blob_file($this->_pxdoc, $memoBlobFilename);
    }

    return true;
  }

  /**
   * Paradox destructor closes down any opened objects and closes file
   */
  public function __destruct()
  {
    if($this->_pxdoc)
    {
      px_close($this->_pxdoc);
      px_delete($this->_pxdoc);
    }

    if($this->_fp)
    {
      fclose($this->_fp);
    }
  }

  /**
   * Gets the total number of records in the Paradox database
   *
   * @return int
   */
  public function getNumRecords()
  {
    return px_numrecords($this->_pxdoc);
  }

  /**
   * Gets a record form the Paradox database
   *
   * @param $id
   *
   * @return array|null
   * @throws \Exception
   */
  public function getRecord($id)
  {
    try
    {
      $this->_record = px_get_record($this->_pxdoc, $id, PX_KEYTOUPPER);
    }
    catch(\Exception $e)
    {
      throw $e;
    }
    if(is_array($this->_record))
    {
      return $this->_record;
    }
    else
    {
      throw new \Exception('Paradox: No record for row ' . $id);
    }
  }

  /**
   * Gets multiple records from the Paradox database
   *
   * @param int $num
   *
   * @return array
   * @throws \Exception
   */
  public function getRows($num = 0)
  {
    if(function_exists('px_retrieve_record'))
    {
      return px_retrieve_record($this->_pxdoc, $num);
    }
    else
    {
      throw new \Exception(
        "Unsupported function (px_retrieve_record) in Paradox extension"
      );
    }
  }

  /**
   * Gets the schema of the Paradox database
   *
   * @return array
   */
  public function getSchema()
  {
    return px_get_schema($this->_pxdoc, PX_KEYTOUPPER);
  }

  /**
   * Gets info about the current Paradox database
   *
   * @return array
   */
  public function getInfo()
  {
    return px_get_info($this->_pxdoc);
  }

  /**
   * Returns a string from a given date
   *
   * @param        $date
   * @param string $format
   *
   * @return string
   */
  public function getStringfromDate(
    $date, $format = "d.m.Y"
  )
  {
    return px_date2string($this->_pxdoc, $date, $format);
  }

  /**
   * Get string from a timestamp in a Paradox database
   *
   * @param        $date
   * @param string $format
   *
   * @return string
   */
  public function getStringFromTimestamp($date, $format = "d.m.Y H:i:s")
  {
    return px_timestamp2string($this->_pxdoc, $date, $format);
  }

  /**
   * Gets the value from a specific field in the Paradox database
   *
   * @param     $field
   * @param int $trim
   * @param int $slash
   *
   * @return bool|string
   */
  public function getFieldValue($field, $trim = 0, $slash = 0)
  {
    if(!$this->_record)
    {
      return false;
    }
    $value = isset($this->_record[$field]) ? $this->_record[$field] :
      $this->defaultFieldValue;
    if($this->useFieldSlashes or $slash)
    {
      $value = addslashes($value);
    }
    if($this->useFieldTrim or $trim)
    {
      $value = trim($value);
    }
    return $value;
  }

  /**
   *
   * Gets the type of field in a Paradox database
   *
   * @param $field
   *
   * @return bool|string
   */
  public function getFieldType($field)
  {
    if(!$this->_record)
    {
      return false;
    }
    $type = isset($this->_record[$field]['type']) ?:
      $this->_record[$field]['type'];
    return ParadoxFieldTypes::getDisplayValue($type);
  }

  public function getFieldInfo($id = 0)
  {
    return px_get_field($this->_pxdoc, $id);
  }

  /**
   * Private function to run the operators in the where statement
   * This currently only does AND where
   *
   * @param $row
   *
   * @return bool
   */
  private function _where($row)
  {
    $test = true;

    if(is_array($this->_where) && !empty($this->_where))
    {
      foreach($this->_where as $where)
      {
        if(isset($where['field']))
        {
          if(isset($row[$where['field']]))
          {
            $sourceValue = $row[$where['field']];
            $expectedValue = $where['value'];
            switch($where['operator'])
            {
              case '=':
                $test = ($sourceValue == $expectedValue);
                break;
              case '<>':
              case '!=':
                $test = ($sourceValue != $expectedValue);
                break;
              case '==':
                $test = ($sourceValue == $expectedValue);
                break;
              case '>':
                $test = ($sourceValue > $expectedValue);
                break;
              case '<':
                $test = ($sourceValue < $expectedValue);
                break;
              case '>=':
                $test = ($sourceValue >= $expectedValue);
                break;
              case '<=':
                $test = ($sourceValue <= $expectedValue);
                break;
              default:
                $test = false;
            }

            // If this test fails do not try the others
            if(!$test)
            {
              break;
            }
          }
        }
      }
    }

    return $test;
  }

  /**
   * Get all matching records
   *
   * @return array
   */
  public function get()
  {
    $matchedRecords = [];

    $totalRecords = $this->getNumRecords();

    // Loop through all records in the database adhering to the limit
    for($x = 0; ($x < $totalRecords
      && count($matchedRecords) < $this->_limit); $x++)
    {
      $row = $this->getRecord($x);

      if($this->_where($row))
      {
        foreach($row as $key => $val)
        {
          // Find all fields not in the select array
          if(!in_array($key, $this->_select) && !empty($this->_select))
          {
            unset($row[$key]);
          }
        }

        $matchedRecords[] = $row;
      }
    }

    return $matchedRecords;
  }

  /**
   * Select which fields to return
   *
   * @param array|string $selectedFields
   *
   * @return Paradox
   */
  public function select($selectedFields)
  {
    // Was an array of fields supplied?
    if(is_array($selectedFields))
    {
      foreach($selectedFields as $field)
      {
        // CHeck that the field given is a string and not already in the list
        if(is_string($field) && !in_array($field, $this->_select))
        {
          $this->_select[] = $field;
        }
      }
    }
    // Support comma separated list?
    else if(is_string($selectedFields))
    {
      $fields = explode(', ', $selectedFields);

      foreach($fields as $field)
      {
        $field = trim($field);

        // If the field is not in the list then add it
        if(!in_array($field, $this->_select))
        {
          $this->_select[] = $field;
        }
      }
    }

    return $this;
  }

  /**
   * Filter rows like where in SQL
   *
   * @param array|string $args
   *
   * @return Paradox
   */
  public function where($args)
  {
    if(is_array($args))
    {
        $this->_where[] = [
          'field'    => $args[0],
          'operator' => $args[1],
          'value'    => $args[2],
        ];
    }
    else if(is_string($args))
    {
      $parts = explode(',',$args);
      $this->_where[] = [
        'field'    => $parts[0],
        'operator' => $parts[1],
        'value'    => $parts[2],
      ];
    }

    return $this;
  }

  /**
   * Limit number of returned results
   *
   * @param int $value
   *
   * @return Paradox
   */
  public function limit($value)
  {
    if(isset($value) && is_numeric($value))
    {
      $this->_limit = (int)$value;
    }

    if(is_array($value))
    {
      $this->_offset = $value[0];
      $this->_limit = $value[1];
    }

    return $this;
  }
}
