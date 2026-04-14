import axios from "axios";
import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", async function () {
    var calendarEl = document.getElementById("calendar");
    let nowDate = new Date()

    let response = await axios.get('/events');
    const events = response.data.events

    
    
    var calendar = new FullCalendar.Calendar(calendarEl, {

        //* here you can customize ur calendar

        //! custimize header of callendar
        headerToolbar: {
            start: 'prev,next',
            center: 'title',
            end: 'timeGridWeek,dayGridMonth,timeGridDay'
        },
        //! customize elements 
        views: {
            timeGridWeek: {
                buttonText: 'This Week',
                titleFormat: { year: 'numeric', month: 'long' }
            },
            dayGridMonth: {
                buttonText: 'This Month'
            },
            timeGridDay: {
                buttonText: 'This Day'
            }
        },
        nowIndicator: true, //* marks the now time
        slotMinTime: "09:00:00", //* to set start of time like mn 9 d sbah
        slotMaxTime:  "19:00:00", //* set end time like hta 6 dl3chiya
        initialView: 'timeGridWeek', //* l view li kaybna par defaut once the page is rendered can be changer from header buttons
        selectable : true,
        selectMirror: true,
        selectOverlap: false,
        editable: true,
        selectAllow : (info) => {
            return info.start >= nowDate 
        },
        select: (info) => {
            let startTime = info.startStr.slice(0, info.startStr.length - 6)
            let endTime = info.endStr.slice(0, info.endStr.length - 6)

            start.value = startTime
            end.value = endTime
            submitBtn.click()
 
            
        },
        eventAllow: (info) => {
            return info.start >= nowDate 

        },
        eventClick: (info) => {
            // delete l clicked event 
            // before deleting , check the owner of hadik l event
            if(validateOwner(info)){
                // send a delete requeste
                let eventId = info.event._def.publicId             
                deleteForm.action = `/event/delete/${eventId}`
                deleteBtn.click()
            }else{
                alert('You are not allowed to delete this event')
            }
           
        },
        eventDrop: (info) => {
           updateEvent(info)
        },
        eventResize: (info) => {
            updateEvent(info)
        },
        
        events: events
        
    
    });

    function validateOwner(info){
        /**
         * validate the owner of the event
         * if owner == auth allow delete or update
         * else not allowed
         * return true or false
         */
        let eventOwner = info.event._def.extendedProps.owner
        let auth = authUser.value
        return eventOwner == auth   
    }
    function updateEvent(info){
         if(validateOwner(info)){
                // yes you can update

                
                let start = info.event.startStr.slice(0, info.event.startStr.length - 6)
               let end = info.event.endStr.slice(0, info.event.endStr.length - 6)
               
               updatedStart.value = start
               updatedEnd.value = end
               let eventId = info.event._def.publicId              
               updateForm.action = `events/update/${eventId}`
               updateBtn.click()
                
            }else{
                alert('you are not allowed to update this event')
            }
    }
    calendar.render();
});
