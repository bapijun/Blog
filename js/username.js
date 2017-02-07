window.onload = function() {
            var childs = document.getElementById("loginname").childNodes;
            for (var i = 0;i < childs.length;i++) {
              if (childs[i].tagName == "LI") {
                addEvent(childs[i]);
              }
            }
          }
function addEvent(o) {
            var as = o.getElementsByTagName("a");
            as[0].onclick = function(e){
              var theEvent = window.event || e;
              var link = theEvent.srcElement ? theEvent.srcElement : theEvent.target;
              var uls  = link.parentNode.childNodes;
              for (var i = 0;i < uls.length;i++) {
                if (uls[i].tagName == "UL") {
                  if (uls[i].style.display == "none") {
                    uls[i].style.display = "";
                  } else {
                    uls[i].style.display = "none";
                  }
                }
              }
            }
          }