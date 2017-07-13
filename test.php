<?php
namespace Paradox;

use Paradox\Enums\ParadoxFieldTypes;

//Include the composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

$pdx = new Paradox(__DIR__ . '/Data/PracticeCompets.DB');

if($pdx)
{
  $pdx->defaultFieldValue = "?";//" ";

  $schema = $pdx->getSchema();
  if(is_array($schema))
  {
    foreach($schema as $fieldName => $fieldDetails)
    {
      echo $fieldName . ' - Type ' . ParadoxFieldTypes::getDisplayValue(
          $fieldDetails['type']
        ) . PHP_EOL;
    }
  }

  $totalRecords = $pdx->getNumRecords();
  if($totalRecords)
  {
    for($record = 0; $record < $totalRecords; $record++)
    {
      echo $record . PHP_EOL;
      $pdx->getRecord($record);
      foreach($schema as $fieldName => $fieldDetails)
      {
        echo "\t" . $fieldName . " " . $pdx->getFieldValue(
            $fieldName
          ) . PHP_EOL;
      }
      echo PHP_EOL;
    }
  }

  $pdx->select('PRAC_COMPET_ID, MEETING_ID')->where('MEETING_ID', '=', '3')
    ->limit(10);
  $results = $pdx->get();
  var_dump($results);
}
