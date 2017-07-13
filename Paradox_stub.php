<?php

/**
 * Helper autocomplete for php paradox extension
 *
 * @author Grant Fribbens <grant.fribbens@gmail.com>
 * @link https://github.com/AmiSMB/paradox-php
 */

const PX_KEYTOLOWER = 1;
const PX_KEYTOUPPER = 2;

/**
 * Creates a new paradox object
 *
 * @return resource
 *
 * @link http://php.net/manual/en/function.px-new.php
 */
function px_new() { }

/**
 * Open paradox database
 *
 * @param resource $pxdoc
 * @param resource $file
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-open_fp.php
 */
function px_open_fp($pxdoc, $file) { }

/**
 * Create a new paradox database
 *
 * @param resource $pxdoc
 * @param resource $file
 * @param array    $fielddesc
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-create_fp.php
 */
function px_create_fp($pxdoc, $file, $fielddesc) { }

/**
 * Closes a paradox database
 *
 * @param resource $pxdoc
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-close.php
 */
function px_close($pxdoc) { }

/**
 * Deletes resource of paradox database
 *
 * @param resource $pxdoc
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-delete.php
 */
function px_delete($pxdoc) { }

/**
 * Reduce paradox database to smallest possible size
 *
 * @param resource $pxdoc
 *
 * @return bool
 *
 * @link
 */
function px_pack($pxdoc) { }

/**
 * Returns record of paradox database
 *
 * @param resource $pxdoc
 * @param int      $num
 * @param int      $mode
 *
 * @return array
 *
 * @link http://php.net/manual/en/function.px-get-record.php
 */
function px_get_record($pxdoc, $num, $mode = 0) { }

/**
 * Stores record into paradox database
 *
 * @param resource $pxdoc
 * @param array    $record
 * @param int      $recpos
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-put-record.php
 */
function px_put_record($pxdoc, $record, $recpos = -1) { }

/**
 * Deletes record from paradox database
 *
 * @param resource $pxdoc
 * @param int      $num
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-delete-record.php
 */
function px_delete_record($pxdoc, $num) { }

/**
 * Inserts record into paradox database
 *
 * @param resource $pxdoc
 * @param array    $data
 *
 * @return int
 *
 * @link http://php.net/manual/en/function.px-insert-record.php
 */
function px_insert_record($pxdoc, $data) { }

/**
 * Updates a record in paradox database
 *
 * @param resource $pxdoc
 * @param array    $data
 * @param int      $num
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-update-record.php
 */
function px_update_record($pxdoc, $data, $num) { }

/**
 * Returns record of paradox database
 *
 * @param resource $pxdoc
 * @param int      $num
 * @param int      $mode
 *
 * @return array
 *
 * @link http://php.net/manual/en/function.px-retrieve-record.php
 */
function px_retrieve_record($pxdoc, $num, $mode = 0) { }

/**
 * Returns number of records in a database
 *
 * @param resource $pxdoc
 *
 * @return int
 *
 * @link http://php.net/manual/en/function.px-numrecords.php
 */
function px_numrecords($pxdoc) { }

/**
 * Returns number of fields in a database
 *
 * @param resource $pxdoc
 *
 * @return int
 *
 * @link http://php.net/manual/en/function.px-numfields
 */
function px_numfields($pxdoc) { }

/**
 * Returns the specification of a single field
 *
 * @param resource $pxdoc
 * @param int      $fieldno
 *
 * @return array
 *
 * @link http://php.net/manual/en/function.px-get-field.php
 */
function px_get_field($pxdoc, $fieldno) { }

/**
 * Returns the database schema
 *
 * @param resource $pxdoc
 * @param int      $mode
 *
 * @return array
 *
 * @link http://php.net/manual/en/function.px-get-schema.php
 */
function px_get_schema($pxdoc, $mode = 0) { }

/**
 * Return lots of information about a paradox file
 *
 * @param resource $pxdoc
 *
 * @return array
 *
 * @link http://php.net/manual/en/function.px-get-info.php
 */
function px_get_info($pxdoc) { }

/**
 * Sets a parameter
 *
 * @param resource $pxdoc
 * @param string   $name
 * @param string   $value
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-set-parameter.php
 */
function px_set_parameter($pxdoc, $name, $value) { }

/**
 * Gets a parameter
 *
 * @param resource $pxdoc
 * @param string   $name
 *
 * @return string
 *
 * @link http://php.net/manual/en/function.px-get-parameter.php
 */
function px_get_parameter($pxdoc, $name) { }

/**
 * Sets a value
 *
 * @param resource $pxdoc
 * @param string   $name
 * @param float    $value
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-set-value.php
 */
function px_set_value($pxdoc, $name, $value) { }

/**
 * Gets a value
 *
 * @param resource $pxdoc
 * @param string   $name
 *
 * @return float
 *
 * @link http://php.net/manual/en/function.px-get-value.php
 */
function px_get_value($pxdoc, $name) { }

/**
 * Sets the encoding for character fields
 *
 * @param resource $pxdoc
 * @param string   $encoding
 *
 * @retun bool
 *
 * @deprecated
 *
 * @link http://php.net/manual/en/function.px-set-targetencoding.php
 */
function px_set_targetencoding($pxdoc, $encoding) { }

/**
 * Sets the name of a table
 *
 * @param resource $pxdoc
 * @param string   $name
 *
 * @return void
 *
 * @deprecated
 *
 * @link http://php.net/manual/en/function.px-set-tablename.php
 */
function px_set_tablename($pxdoc, $name) { }

/**
 * Sets the file where blobs are read from
 *
 * @param resource $pxdoc
 * @param string   $filename
 *
 * @return bool
 *
 * @link http://php.net/manual/en/function.px-set-blob-file.php
 */
function px_set_blob_file($pxdoc, $filename) { }

/**
 * Converts the timestamp into a string
 *
 * @param resource $pxdoc
 * @param float    $value
 * @param string   $format
 *
 * @return string
 *
 * @link http://php.net/manual/en/function.px-timestamp2string.php
 */
function px_timestamp2string($pxdoc, $value, $format) { }

/**
 * Converts a date into a string
 *
 * @param resource $pxdoc
 * @param int      $value
 * @param string   $format
 *
 * @return string
 *
 * @link http://php.net/manual/en/function.px-date2string.php
 */
function px_date2string($pxdoc, $value, $format) { }
