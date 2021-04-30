<?php

class Pagination {

  public $current_page;
  public $per_page;
  public $total_count;

  public function __construct($total_count=0, $page=1, $per_page=20) {
    $this->per_page = (int) $per_page;
    $this->total_count = (int) $total_count;
    $this->current_page = (int) $page;
    if($this->current_page < 1 || $this->current_page > $this->total_pages()) {
      $this->current_page = 1;
    }
  }

  public function offset() {
    return $this->per_page * ($this->current_page - 1);
  }

  public function total_pages() {
    return ceil($this->total_count / $this->per_page);
  }

}

?>
