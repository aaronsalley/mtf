<?php
class Instagram {
  public function __construct() {
    $this->baseURL = 'https://www.eventbriteapi.com/v3';
    $this->curl = curl_init();
    $this->curl_init_opts();
    curl_exec($this->curl);
  }

  private function curl_init_opts() {
    curl_setopt_array($this->curl, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => array('Authorization: Bearer 3JSRJ377WXSE67S5QWI6')
    ]);
  }

  private function curl_exec($opts) {
      curl_reset($this->curl); // clears all old options
      $this->curl_init_opts(); // sets base options again
      curl_setopt_array($this->curl, $opts); // sets your new options
      return curl_exec($this->curl);
  }

  public function get_instagram_posts($n = 35) {
    $opts[CURLOPT_URL] = $this->baseURL . '/venues/' . $venue_id;
    $response = json_decode($this->curl_exec($opts), true);

    $posts = [];

    for($i = 0; $i < $n; $i++){
      $posts[] = '<div class="post">
        <img class="image" src="#" />
      </div>';
    }
    $posts = implode($posts);

    return $posts;
  }

  public function instagram_posts($n = 40){
    echo $this->get_instagram_posts($n);
  }
}
$instagram = new Instagram();
