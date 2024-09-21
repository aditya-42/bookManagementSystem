<?php
// Book class definition
class Book {

    // Class variables
    private $title;
    private $author;
    private $year;

    // Class constructor
    public function __construct($title, $author, $year) {
        if (empty($title) || empty($author) || empty($year)) {
            throw new Exception("All fields are required.");
        }
        if (!is_numeric($year) || $year < 0) {
            throw new Exception("Year must be greater than zero");
        }
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    // Class getter functions

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getYear() {
        return $this->year;
    }

    public function display(){
           return "<td>" . htmlspecialchars($this->title) . "</td>
                    <td>" . htmlspecialchars($this->author) . "</td>
                    <td>" . htmlspecialchars($this->year) . "</td>";
    }
}
?>