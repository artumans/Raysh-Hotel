const nav = document.getElementById('admin-nav');
function setActive(id) {
    var thisMenu = document.getElementById(`${id}`);
    if (!thisMenu.classList.contains('.active-menu')) {
        const activeMenu = nav.querySelector('.active-menu');
        activeMenu.classList.remove('active-menu');
        thisMenu.classList.add('active-menu');
        $.ajax({
            type: "GET",
            url: thisMenu.getAttribute('data-bs-value'),
            success: function (response) {
                const main_content = document.getElementById('scrollspace');
                main_content.innerHTML = response;
                if (id == "menuReservation") {
                    window[id]();
                }
            }
        });
    }
}


function menuReservation() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    var prajuritReservationTimeline = document.getElementById('prajurit-reservation-tl');
    if (prajuritReservationTimeline) {
        prajuritReservationTimeline.addEventListener("mousewheel", prajuritMouseWheelHandler, false);
        prajuritReservationTimeline.addEventListener("DOMMouseScroll", prajuritMouseWheelHandler, false);
    } else prajuritReservationTimeline.attachEvent("onmousewheel", prajuritMouseWheelHandler);
    
    function prajuritMouseWheelHandler(e) {
      // cross-browser wheel delta
      var e = window.event || e;
      var delta = -30 * Math.max(-1, Math.min(1, e.wheelDelta || -e.detail));
    
      var pst = $("#prajurit-reservation-tl").scrollLeft() + delta;
    
      if (pst < 0) {
        pst = 0;
      } else if (pst > $(".parjurit-table-tl").width()) {
        pst = $(".parjurit-table-tl").width();
      }
    
      $("#prajurit-reservation-tl").scrollLeft(pst);
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
    
    $("#prajurit-reservation-tl").off("mousewheel").on("mousewheel", function(ev) {
      var el = $(ev.currentTarget);
      return ev.originalEvent.deltaY > 0
        ? el[0].scrollWidth - el.scrollLeft() <= el.innerWidth()
        : el.scrollLeft() === 0;
    });
    
    
    
    
    var panglimaReservationTimeline = document.getElementById('panglima-reservation-tl');
    if (panglimaReservationTimeline) {
        panglimaReservationTimeline.addEventListener("mousewheel", panglimaMouseWheelHandler, false);
        panglimaReservationTimeline.addEventListener("DOMMouseScroll", panglimaMouseWheelHandler, false);
    } else panglimaReservationTimeline.attachEvent("onmousewheel", panglimaMouseWheelHandler);
    
    function panglimaMouseWheelHandler(e) {
      // cross-browser wheel delta
      var e = window.event || e;
      var delta = -30 * Math.max(-1, Math.min(1, e.wheelDelta || -e.detail));
    
      var pst = $("#panglima-reservation-tl").scrollLeft() + delta;
    
      if (pst < 0) {
        pst = 0;
      } else if (pst > $(".panglima-table-tl").width()) {
        pst = $(".panglima-table-tl").width();
      }
    
      $("#panglima-reservation-tl").scrollLeft(pst);
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
    
    $("#panglima-reservation-tl").off("mousewheel").on("mousewheel", function(ev) {
      var el = $(ev.currentTarget);
      return ev.originalEvent.deltaY > 0
        ? el[0].scrollWidth - el.scrollLeft() <= el.innerWidth()
        : el.scrollLeft() === 0;
    });
    
    
    
    var bagindaReservationTimeline = document.getElementById('baginda-reservation-tl');
    if (bagindaReservationTimeline) {
        bagindaReservationTimeline.addEventListener("mousewheel", bagindaMouseWheelHandler, false);
        bagindaReservationTimeline.addEventListener("DOMMouseScroll", bagindaMouseWheelHandler, false);
    } else bagindaReservationTimeline.attachEvent("onmousewheel", bagindaMouseWheelHandler);
    
    function bagindaMouseWheelHandler(e) {
      // cross-browser wheel delta
      var e = window.event || e;
      var delta = -30 * Math.max(-1, Math.min(1, e.wheelDelta || -e.detail));
    
      var pst = $("#baginda-reservation-tl").scrollLeft() + delta;
    
      if (pst < 0) {
        pst = 0;
      } else if (pst > $(".baginda-table-tl").width()) {
        pst = $(".baginda-table-tl").width();
      }
    
      $("#baginda-reservation-tl").scrollLeft(pst);
      e.preventDefault();
      e.stopPropagation();
      return false;
    }
    
    $("#baginda-reservation-tl").off("mousewheel").on("mousewheel", function(ev) {
      var el = $(ev.currentTarget);
      return ev.originalEvent.deltaY > 0
        ? el[0].scrollWidth - el.scrollLeft() <= el.innerWidth()
        : el.scrollLeft() === 0;
    });


}
function findTlByMonth(id) {
    const btnFind = document.getElementById(id);
    if (btnFind) {
        const roomType = btnFind.getAttribute('data-bs-roomtype');
        const monthYear = document.getElementById('monthYear_'.concat(roomType));
        const currentMonth = new Date(monthYear.getAttribute('data-bs-monthyear'));

        const exe = btnFind.getAttribute('data-bs-find');
        if (exe == "0") {
            var prevMonth = currentMonth.setMonth(currentMonth.getMonth()-1);
        } else {
            var prevMonth = currentMonth.setMonth(currentMonth.getMonth()+1);
        }

        var setFindMonth = new Date(prevMonth);

        var getYear = new String(setFindMonth.getFullYear());
        var getMonth = new String(setFindMonth.getMonth() + 1);
        console.log(getMonth, getYear);
        $.ajax({
            type: "POST",
            url: btnFind.getAttribute('data-bs-action'),
            data: {
                month: getMonth,
                year: getYear,
                room_type: roomType
            },
            success: function (response) {
                const reservation_tl_card = document.getElementById(roomType.concat('_reservation-tl-card'));
                reservation_tl_card.innerHTML = response;
                menuReservation();
            }
        });
    }
}