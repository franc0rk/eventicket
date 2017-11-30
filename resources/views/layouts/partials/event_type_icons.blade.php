@if($event->event_type_id == 1) <i class="fa fa-users"></i>
@elseif($event->event_type_id == 2) <i class="fa fa-futbol-o"></i>
@else <i class="fa fa-music"></i>
@endif