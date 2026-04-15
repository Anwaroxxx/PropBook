import axios from "axios";
import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", async function () {
    // Load properties into dropdown
    const propertySelect = document.getElementById('propertySelect')
    console.log('Property select element:', propertySelect)
    console.log('Properties data:', window.properties)
    
    if (!propertySelect) {
        console.error('propertySelect element not found!')
        return
    }
    
    // Clear existing options except the first one
    propertySelect.innerHTML = '<option value="">Choose a property...</option>'
    
    if (window.properties && Array.isArray(window.properties)) {
        window.properties.forEach(property => {
            const option = document.createElement('option')
            option.value = property.id
            option.innerText = property.title || property.name || 'Property ' + property.id
            console.log('Adding option:', option.innerText, 'value:', option.value)
            propertySelect.appendChild(option)
        })
        console.log('Loaded', window.properties.length, 'properties')
    } else {
        console.warn('No properties found or not an array')
    }
    
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
            let startStr = info.startStr.slice(0, info.startStr.length - 6)
            let endStr = info.endStr.slice(0, info.endStr.length - 6)

            document.getElementById('modalStartTime').value = startStr
            document.getElementById('modalEndTime').value = endStr
            document.getElementById('visitModal').classList.remove('hidden')
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
                // yes n9der n updatiiii

                
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
    
    // Handle Schedule Visit button
    document.getElementById('saveVisitBtn').addEventListener('click', async function() {
        const propertySelect = document.getElementById('propertySelect')
        const modalStartTime = document.getElementById('modalStartTime')
        const modalEndTime = document.getElementById('modalEndTime')
        
        if (!propertySelect.value) {
            alert('Please select a property first')
            return
        }
        
        if (!modalStartTime.value) {
            alert('Start time is required')
            return
        }
        
        try {
            const data = {
                property_id: parseInt(propertySelect.value),
                start_time: modalStartTime.value,
                end_time: modalEndTime.value || modalStartTime.value
            }
            
            console.log('Submitting:', data)
            
            const response = await axios.post(
                '/visits',
                data,
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }
            )
            
            console.log('Success:', response.data)
            // Success - close modal and refresh
            document.getElementById('visitModal').classList.add('hidden')
            
            // Clear the form
            propertySelect.value = ''
            modalStartTime.value = ''
            modalEndTime.value = ''
            
            alert('Visit scheduled successfully!')
            location.reload()
        } catch (error) {
            console.error('Full error:', error)
            console.error('Response data:', error.response?.data)
            
            if (error.response?.data?.errors) {
                const errors = Object.entries(error.response.data.errors)
                    .map(([field, messages]) => `${field}: ${messages.join(', ')}`)
                    .join('\n')
                alert('Validation Error:\n' + errors)
            } else {
                alert('Failed to schedule visit: ' + (error.response?.data?.message || error.message))
            }
        }
    })
    
    calendar.render();
});
