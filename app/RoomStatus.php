<?php

namespace App;


    enum RoomStatus: string {
        case Available = 'available';
        case Booked = 'booked';
        case Maintenance = 'maintenance';
    }
    

