$(document).ready(function(){
    const measure = $('input#measure')
    const ammount = $('input#num')
    const timer = $('#timer')
    const s = $(timer).find('.seconds')
    const m = $(timer).find('.minutes')
    const h = $(timer).find('.hours')

    var seconds = 0
    var minutes = 0
    var hours = 0

    var interval = null;

    var clockType = undefined;

    $('a#start-countdown').on('click', function(){
        if($(ammount).val() != '' && $(ammount).val() > 0 && $(measure).val() != 0) {
            clockType = 'countdown'
            startClock()
        }
        else if ($(ammount).val() == '') {
            alert('Type in the Ammount')
        }
        else if ($(measure).val() == 0) {
            alert('Select the Unit')
        }
    })

    $('button#start-cronometer').on('click', function(){
        clockType = 'cronometer'
        if ($(ammount).val() != '' && $(measure).val() == 0) {
            alert('Select the Unit')
        } else if ($(ammount).val() > -1) {
            startClock()
        }
    })

    $('button#stop-timer').on('click', function() {
        pauseClock()
    })

    $('button#reset-timer').on('click', function() {
        restartClock()
    })

    $('button#resume-timer').on('click', function() {
      $('button#resume-timer').fadeOut(100)
      $('button#reset-timer').fadeOut(100)
      switch (clockType) {
          case 'countdown':
               countdown()
               break
           case 'cronometer':
               cronometer()
               break
          default:
              break;
      }
    })

    function pad(d) {
        return (d < 10) ? '0' + d.toString() : d.toString()
    }

    function startClock() {
        hasStarted = false
        hasEnded = false

        seconds = 0
        minutes = 0
        hours = 0

        switch ($(measure).val()) {
            case 's':
                if ($(ammount).val() > 3599) {
                    let hou = Math.floor($(ammount).val() / 3600)
                    hours = hou
                    let min = Math.floor(($(ammount).val() - (hou * 3600)) / 60)
                    minutes = min;
                    let sec = ($(ammount).val() - (hou * 3600)) - (min * 60)
                    seconds = sec
                }
                else if ($(ammount).val() > 59) {
                    let min = Math.floor($(ammount).val() / 60)
                    minutes = min
                    let sec = $(ammount).val() - (min * 60)
                    seconds = sec
                }
                else {
                    seconds = $(ammount).val()
                }
                break
            case 'm':
                if ($(ammount).val() > 59) {
                    let hou = Math.floor($(ammount).val() / 60)
                    hours = hou
                    let min = $(ammount).val() - (hou * 60)
                    minutes = min
                }
                else {
                    minutes = $(ammount).val()
                }
                break
            case 'h':
                hours = $(ammount).val()
                break
            default:
                break
        }

        if (seconds <= 10 && clockType == 'countdown' && minutes == 0 && hours == 0) {
          $(timer).find('span').addClass('red')
        }

        refreshClock()

        $('.input-wrapper').slideUp(350)
        setTimeout(function(){
            $('#timer').fadeIn(350)
            $('#stop-timer').fadeIn(350)

        }, 350)

       switch (clockType) {
           case 'countdown':
                countdown()
                break
            case 'cronometer':
                cronometer()
                break
           default:
               break;
       }
    }

    function restartClock() {
        clear(interval)
        hasStarted = false
        hasEnded = false

        seconds = 0
        minutes = 0
        hours = 0

        $(s).text('00')
        $(m).text('00')
        $(h).text('00')

        $(timer).find('span').removeClass('red')

        $('#timer').fadeOut(350)
        $('#stop-timer').fadeOut(100)
        $('button#resume-timer').fadeOut(100)
        $('button#reset-timer').fadeOut(100)
        setTimeout(function(){
            $('.input-wrapper').slideDown(350)
        },350)
    }

    function pauseClock() {
      clear(interval)
      $('#resume-timer').fadeIn()
      $('#reset-timer').fadeIn()
    }

    var hasStarted = false
    var hasEnded = false
    if (hours == 0 && minutes == 0 && seconds == 0 && hasStarted == true) {
        hasEnded = true
    }

    function countdown() {
        hasStarted = true
        interval = setInterval(() => {
            if(hasEnded == false) {
                if (seconds <= 11 && minutes == 0 && hours == 0) {
                  $(timer).find('span').addClass('red')
                }

                if(seconds == 0 && minutes == 0 || (hours > 0  && minutes == 0 && seconds == 0)) {
                    hours--
                    minutes = 59
                    seconds = 60
                    refreshClock()
                }

                if(seconds > 0) {
                    seconds--
                    refreshClock()
                }
                else if (seconds == 0) {
                    minutes--
                    seconds = 59
                    refreshClock()
                }
            }
            else {
                restartClock()
            }

        }, 1000)
    }

    function cronometer() {
        hasStarted = true
        interval = setInterval(() => {
            if (seconds < 59) {
                seconds++
                refreshClock()
            }
            else if (seconds == 59) {
                minutes++
                seconds = 0
                refreshClock()
            }

            if (minutes == 60) {
                hours++
                minutes = 0
                seconds = 0
                refreshClock()
            }

        }, 1000)
    }

    function refreshClock() {
        $(s).text(pad(seconds))
        $(m).text(pad(minutes))
        if (hours < 0) {
            $(s).text('00')
            $(m).text('00')
            $(h).text('00')
        } else {
            $(h).text(pad(hours))
        }

        if (hours == 0 && minutes == 0 && seconds == 0 && hasStarted == true) {
            hasEnded = true
              //form submit atomatically when time elapsed
            $('form#ResForm').submit();
            //disable the cancell button
            $('button#noSubmit').attr('disabled','disabled');
        }
    }

    function clear(intervalID) {
        clearInterval(intervalID)
        console.log('cleared the interval called ' + intervalID)
    }
})
