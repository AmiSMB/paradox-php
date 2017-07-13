<?php
namespace Paradox\Enums;

/**
 * Class ParadoxFieldTypes
 *
 * Defines field type constants for a Paradox database
 * Contains function to make turn these constants into human readable strings
 *
 * @link http://pxlib.sourceforge.net/
 */
class ParadoxFieldTypes
{
  /** Paradox field types as returned from pxlib-0.6.7
   *
   *  These are defined in pxlib-0.6.7/include/paradox.h
   */
  const PX_FIELD_ALPHA = 0x01;
  const PX_FIELD_DATE = 0x02;
  const PX_FIELD_SHORT = 0x03;
  const PX_FIELD_LONG = 0x04;
  const PX_FIELD_CURRENCY = 0x05;
  const PX_FIELD_NUMBER = 0x06;
  const PX_FIELD_LOGICAL = 0x09;
  const PX_FIELD_MEMOBLOB = 0x0C;
  const PX_FIELD_BLOB = 0x0D;
  const PX_FIELD_FMTMEMOBLOB = 0x0E;
  const PX_FIELD_OLE = 0x0F;
  const PX_FIELD_GRAPHIC = 0x10;
  const PX_FIELD_TIME = 0x14;
  const PX_FIELD_TIMESTAMP = 0x15;
  const PX_FIELD_AUTOINC = 0x16;
  const PX_FIELD_BCD = 0x17;
  const PX_FIELD_BYTES = 0x18;

  /**
   * Gets the string value for a given constant value defined above for human
   * readable display
   *
   * @param $value
   *
   * @return string
   */
  public static function getDisplayValue($value)
  {
    switch($value)
    {
      case self::PX_FIELD_ALPHA:
        return 'Alpha';
      case self::PX_FIELD_DATE:
        return 'Date';
      case self::PX_FIELD_SHORT:
        return 'Short';
      case self::PX_FIELD_LONG:
        return 'Long';
      case self::PX_FIELD_CURRENCY:
        return 'Currency';
      case self::PX_FIELD_NUMBER:
        return 'Number';
      case self::PX_FIELD_LOGICAL:
        return 'Logical';
      case self::PX_FIELD_MEMOBLOB:
        return 'Memo Blob';
      case self::PX_FIELD_BLOB:
        return 'Blob';
      case self::PX_FIELD_FMTMEMOBLOB:
        return 'Format Memo Blob';
      case self::PX_FIELD_OLE:
        return 'OLE';
      case self::PX_FIELD_GRAPHIC:
        return 'Graphic';
      case self::PX_FIELD_TIME:
        return 'Time';
      case self::PX_FIELD_TIMESTAMP:
        return 'Timestamp';
      case self::PX_FIELD_AUTOINC:
        return 'Autoinc';
      case self::PX_FIELD_BCD:
        return 'BCD';
      case self::PX_FIELD_BYTES:
        return 'Bytes';
      default:
        return 'Unknown field type ' . $value;
    }
  }
}
