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

  public function previous_page() {
    $prev = $this->current_page - 1;
    return ($prev > 0) ? $prev : false;
  }

  public function previous_link($url='') {
    $link = '';
    if($this->previous_page() != false) {
      $link .= "<a href=\"{$url}?page={$this->previous_page()}\">";
      $link .= "&larr; Previous</a> ";
    }
    return $link;
  }

  public function next_page() {
    $next = $this->current_page + 1;
    return ($next <= $this->total_pages()) ? $next : false;
  }

  public function next_link($url='') {
    $link = '';
    if($this->next_page() != false) {
      $link .= "<a href=\"{$url}?page={$this->next_page()}\">";
      $link .= "Next &rarr;</a> ";
    }
    return $link;
  }

  public function number_links($url='', $window=2) {
    $output = '';
    $win = (int) $window;
    $gap = false;
    for($i=1; $i <= $this->total_pages(); $i++) {
      if($win > 0 && $i > 1 + $win && $i < $this->total_pages() - $win && abs($i - $this->current_page) > $win) {
        if(!$gap) {
          $output .= "... ";
          $gap = true;
        }
        continue;
      }
      $gap = false;
      if($this->current_page == $i) {
        $output .= "<strong>{$i}</strong> ";
      } else {
        $output .= "<a href=\"{$url}?page={$i}\">{$i}</a> ";
      }
    }
    return $output;
  }

  public function page_links($url="") {
    $output = '';
    if($this->total_pages() > 1) {
      $output .= "<p class=\"pagination\">";
      $output .= $this->previous_link('customers_oo.php');
      $output .= $this->number_links('customers_oo.php');
      $output .= $this->next_link('customers_oo.php');
      $output .= "</p>";
    }
    return $output;
  }

}

?>
