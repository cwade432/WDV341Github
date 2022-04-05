<?php

class Event {
    public $eventName;
    public $eventDescription;
    public $eventPresenter;
    public $eventDate;
    public $eventTime;
    
    // function __construct($name, $description, $presenter, $date, $time) {
    //     $this-> name = $eventName;
    //     $this-> description = $eventDescription;
    //     $this-> presenter = $eventPresenter;
    //     $this-> date = $eventDate;
    //     $this-> time = $eventTime;
    // }

    function __construct($eventName, $eventDescription, $eventPresenter, $eventDate) {
        $this-> eventName = $eventName;
        $this-> eventDescription = $eventDescription;
        $this-> eventPresenter = $eventPresenter;
        $this-> eventDate = $eventDate;
    }

    function set_name($eventName) {
        $this->eventName = $eventName;
    }

    function getEventName() {
        return $this->eventName;
    }

    function getEventDescription() {
        return $this-> eventDescription;
    }

    function getEventPresenter() {
        return $this-> eventPresenter;
    }

    function getEventDate() {
        return $this-> eventDate;
    }

    function getEventTime() {
        return $this-> time;
    }

}

?>