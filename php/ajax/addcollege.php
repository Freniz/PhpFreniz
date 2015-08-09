<?php  
require_once ('json/JSON.php');
if(isset($_REQUEST['pageid']) && isset($_SESSION['userid'])){
        List pages=(List)((HashMap)((HashMap)application.getAttribute("users")).get(session.getAttribute("userid"))).get("pages");
        List books=(List)session.getAttribute("college");
        if(!books.contains(request.getParameter("pageid"))){
            pages.add(request.getParameter("pageid"));
            books.add(request.getParameter("pageid"));
            obj.updateCollege((String)session.getAttribute("userid"), books);
            json.put("status", "page successfully added to college ");
        }
        else
            json.put("status", "already in your college");
    }
    else
        json.put("status", "please provide valid informations");
    out.print(json);
?>