$(function() {
    // Inicializa os eventos externos
    function ini_events(ele) {
      ele.each(function() {
        // Cria um objeto de evento com o título do texto
        var eventObject = {
          title: $.trim($(this).text())
        };
        // Armazena o objeto de evento no elemento DOM
        $(this).data('eventObject', eventObject);
        // Torna o evento arrastável usando jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // faz o evento voltar à posição original se não for colocado no calendário
          revertDuration: 0
        });
      });
    }
  
    // Chama a função ini_events para inicializar os eventos externos
    ini_events($('#external-events div.external-event'));
  
    // Obtém a data atual
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
  
    // Configurações do FullCalendar
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;
  
    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');
  
    // Torna os eventos externos arrastáveis usando FullCalendar
    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color')
        };
      }
    });
  
    // Inicializa o calendário com as configurações necessárias
    var calendar = new Calendar(calendarEl, {
      plugins: ['interaction', 'dayGrid', 'timeGrid'],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      events: [
        {
          title: 'All Day Event',
          start: new Date(y, m, 1),
          backgroundColor: '#f56954',
          borderColor: '#f56954',
          allDay: true
        },
        {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2),
          backgroundColor: '#f39c12',
          borderColor: '#f39c12'
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          backgroundColor: '#0073b7',
          borderColor: '#0073b7'
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          backgroundColor: '#00c0ef',
          borderColor: '#00c0ef'
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          backgroundColor: '#00a65a',
          borderColor: '#00a65a'
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/',
          backgroundColor: '#3c8dbc',
          borderColor: '#3c8dbc'
        }
      ],
      editable: true,
      droppable: true,
      drop: function(info) {
        // Remove o evento da lista externa se a caixa de seleção estiver marcada
        if (checkbox.checked) {
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });
  
    // Renderiza o calendário
    calendar.render();
  
    // Variável para armazenar a cor atual
    var currColor = '#3c8dbc';
    // Altera a cor do novo evento quando uma cor é escolhida
    $('#color-chooser > li > a').click(function(e) {
      e.preventDefault();
      currColor = $(this).css('color');
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color': currColor
      });
    });
  
    // Adiciona um novo evento à lista de eventos externos
    $('#add-new-event').click(function(e) {
      e.preventDefault();
      var val = $('#new-event').val();
      if (val.length == 0) {
        return;
      }
      var event = $('<div />');
      event.css({
        'background-color': currColor,
        'border-color': currColor,
        'color': '#fff'
      }).addClass('external-event');
      event.html(val);
      $('#external-events').prepend(event);
      ini_events(event);
      $('#new-event').val('');
    });
  });
  