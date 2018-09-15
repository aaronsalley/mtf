<?php
class Eventbrite {

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

  public function get_events_list( $n = 4 ) {
    $opts[CURLOPT_URL] = $this->baseURL . '/organizers/15023933479/events/';
    $response = json_decode($this->curl_exec($opts), true);

    $events = [];

    for( $i = 0; $i < $n; $i++){
      $event = $response['events'][$i];
      $date = date_create($event['start']['local']);
      // $venue = $this->get_venue($event['venue_id']);
      $venue["name"] = $event['venue_id'];
      $image = $this->get_image($event['logo_id']);

      $events[] = '<article class="event ' . $event['status'] . '">
        <img class="image" src="' . $event['logo_id'] . '" />
        <h5 class="title">' . $event['name']['text'] . '</h2>
        <p class="date">' . date_format($date, 'F j') . ' at ' . date_format($date, 'Y') . '</p>
        <p class="location">' . $venue['name'] . '</p>
      </article>';
    }
    $events = implode($events);

    return $events;
  }

  public function events_list($n = 4){
    echo $this->get_events_list($n);
  }

  private function get_venue( $venue_id = '' ) {
    $response = [
      'name' => 'Venue'
    ];
    // $opts[CURLOPT_URL] = $this->baseURL . '/venues/' . $venue_id;
    // $response = json_decode($this->curl_exec($opts), true);

    return $response;
  }

  private function get_image( $logo_id = '' ) {
    $opts[CURLOPT_URL] = $this->baseURL . '/media/' . $logo_id;
    $response = json_decode($this->curl_exec($opts), true);

    return $response;
  }
}
// $events = new Eventbrite();
