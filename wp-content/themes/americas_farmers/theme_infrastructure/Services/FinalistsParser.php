<?php
namespace AmericasFarmers;

class FinalistsParser
{
  private static $all_finalists;
  private static $current_program;

  /*
  for now assume column values are as follows:
  0 -> District Name
  1 -> County
  2 -> State
  can expand on this later if necessary
  */
  public static function parseUpload ($program_id) {
    $finalists = get_field('program_finalists', $program_id);
    $parsed_finalists = [];
    try{
      if(!empty($finalists) && !empty($finalists['finalists_upload'])){
        $attachment = get_attached_file($finalists['finalists_upload']);
        $csv_file = file($attachment);
        foreach ($csv_file as $index => $line) {
          //assume first line will be headers
          if($index !== 0){
            $csv_row = str_getcsv($line);
            $finalist = array('district' => $csv_row[0], 'county' => $csv_row[1], 'state' => $csv_row[2]);
            array_push($parsed_finalists, $finalist);
          }
        }
      }
    } catch (\Exception $e) {
      //do something nice
    } 

    return $parsed_finalists;
  }

  //State should be the state abbreviation, will be selected from values generated by the getStateArray() function
  public static function getFinalists($program_id, $state = null){
    //build our finalists if we don't already have a list or we're switching programs
    if(empty(self::$all_finalists) || self::$current_program !== $program_id){
      self::$current_program = $program_id;
      self::$all_finalists = self::parseUpload($program_id);
    }

    $filtered_finalists = array();
    if(!empty($state)){
      //var_dump($state);
      foreach(self::$all_finalists as $finalist){
        if(strtolower($finalist['state']) === strtolower($state)){
          $filtered_finalists[] = $finalist;
        }
      }
    } else {
      $filtered_finalists = self::$all_finalists;
    }
    //var_dump($filtered_finalists); die;

    return $filtered_finalists;
  }

}

?>