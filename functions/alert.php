<?php



function print_alert(){
    $types = ['message','info','error'];
    $colors = ['green','blue','red'];
      
    for($i = 0; $i < count($types); $i++){
        
        if( isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]]) ) {
            echo "<span style='color:".$colors[$i]."'>" . $_SESSION[$types[$i]] . "</span>";
            session_unset();
        }

    }

}


function set_alert($type = "message", $content = "")
{
    switch ($type) {
        case 'message':
            $_SESSION['message'] = $content;
            break;
        case 'error':
            $_SESSION['error'] = $content;
            break;
        case 'info':
            $_SESSION['info'] = $content;
            break;
        default:
            $_SESSION['message'] = $content;
            break;
    }
}
