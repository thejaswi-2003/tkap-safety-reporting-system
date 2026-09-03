<?php
function statusColor($status) {
    switch ($status) {
        case 'Open':          return 'danger';
        case 'Under Review':  return 'warning';
        case 'Action Taken':  return 'info';
        case 'Closed':        return 'success';
        default:              return 'secondary';
    }
}
?>