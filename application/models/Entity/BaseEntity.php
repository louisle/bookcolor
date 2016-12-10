<?php
namespace Entity;
class BaseEntity{
  /**
   * @Id
   * @Column(type="integer", nullable=false)
   * @GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @Column(type="integer", nullable=true)
   */
  public $create_at;

  /**
   * @Column(type="integer", nullable=true)
   */
  public $update_at;

  public function __construct(){
    $this->create_at = time();
    $this->update_at = time();
  }

  public function getMid(){
    if($this->id !== NULL){
      $str = (string)(1000000000 + $this->id);
      return substr($str, 1);
    }
    else
      return FALSE;
  }


  function get_time_elapsed_string_3(){
    $current_time   = time();
    $diff           = $current_time - $this->update_at;
    
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    
    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }    

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }        

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }        

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }    

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }    

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }    

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }    

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}
  function get_time_elapsed_string()
  {
      $estimate_time = time() - $this->update_at;

      if( $estimate_time < 1 )
      {
          return 'Vừa mới đây';
      }

      $condition = array( 
                  12 * 30 * 24 * 60 * 60  =>  'năm',
                  30 * 24 * 60 * 60       =>  'tháng',
                  24 * 60 * 60            =>  'ngày',
                  60 * 60                 =>  'giờ',
                  60                      =>  'phút',
                  1                       =>  'giây'
      );

      foreach( $condition as $secs => $str )
      {
          $d = $estimate_time / $secs;

          if( $d >= 1 )
          {
              $r = round( $d );
              return $r . ' ' . $str . ' trước';
          }
      }
  }
  public function get_time_elapsed_string_2() {
      $etime = time() - $this->update_at;

      if ($etime < 1)
      {
          return '0 seconds';
      }

      $a = array( 365 * 24 * 60 * 60  =>  'năm',
                   30 * 24 * 60 * 60  =>  'tháng',
                        24 * 60 * 60  =>  'ngày',
                             60 * 60  =>  'giờ',
                                  60  =>  'phút',
                                   1  =>  'giây'
                  );
      $a_plural = array( 'năm'   => 'năm',
                         'tháng'  => 'tháng',
                         'ngày'    => 'ngày',
                         'giờ'   => 'giờ',
                         'phút' => 'phút',
                         'giây' => 'giây'
                  );

      foreach ($a as $secs => $str)
      {
          $d = $etime / $secs;
          if ($d >= 1)
          {
              $r = round($d);
              return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' trước';
          }
      }
  }
}
?>